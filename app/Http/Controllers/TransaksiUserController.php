<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ItemTransaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiUserController extends Controller
{
    // Method untuk menampilkan halaman checkout
    public function checkout()
    {
        // Ambil semua item keranjang untuk user yang login
        $cartItems = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();
        
        // Jika keranjang kosong, redirect ke keranjang
        if ($cartItems->isEmpty()) {
            return redirect()->route('keranjang')->with('error', 'Keranjang kosong! Silakan tambahkan produk terlebih dahulu.');
        }
        
        // Hitung subtotal untuk setiap item
        $cartItems = $cartItems->map(function ($item) {
            // Pastikan duration ada dan tidak null
            $durasi = $item->duration ?? 1; // Gunakan duration, fallback ke 1
            
            if ($durasi <= 0) {
                // Hitung durasi dari tanggal jika duration kosong/0
                $tanggalMulai = Carbon::parse($item->tanggal_mulai);
                $tanggalSelesai = Carbon::parse($item->tanggal_selesai);
                $durasi = $tanggalSelesai->diffInDays($tanggalMulai);
                
                // Minimal 1 hari
                if ($durasi <= 0) {
                    $durasi = 1;
                }
            }
            
            // Set durasi untuk compatibility dengan view
            $item->durasi = $durasi;
            
            // Hitung subtotal
            $item->subtotal = $item->produk->harga * $item->jumlah * $durasi;
            
            return $item;
        });
        
        // Hitung total keseluruhan
        $total = $cartItems->sum('subtotal');
        
        // Return ke view checkout dengan data (BUKAN membuat transaksi)
        return view('checkout', compact('cartItems', 'total'));
    }

    // Method untuk memproses checkout (form submission)
    public function processCheckout(Request $request)
    {
        try {
            // Debug: Log semua input yang diterima
            \Log::info('=== MULAI PROCESS CHECKOUT ===');
            \Log::info('All request input:', $request->all());
            \Log::info('User ID:', ['user_id' => Auth::id()]);

            // 1. Ambil isi keranjang user terlebih dahulu
            $cartItems = Keranjang::with('produk')->where('user_id', Auth::id())->get();
            
            if ($cartItems->isEmpty()) {
                return redirect()->route('keranjang')->with('error', 'Keranjang kosong!');
            }

            // 2. Ambil tanggal dari keranjang (bukan dari form)
            $firstItem = $cartItems->first();
            $tanggalMulai = $firstItem->tanggal_mulai;
            $tanggalKembali = $firstItem->tanggal_selesai;

            // 3. Validasi input dari form (tanpa validasi tanggal yang ketat)
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telepon' => 'required|string|max:20',
                'ktp' => 'required|string|max:20',
                'alamat' => 'required|string',
                'metode_pembayaran' => 'required|in:qris,cod',
                'catatan' => 'nullable|string'
            ]);

            // Debug: Log validated data
            \Log::info('Validated data:', $validated);

            // 4. Hitung total dan set durasi untuk setiap item
            $cartItems = $cartItems->map(function ($item) {
                // Hitung durasi berdasarkan tanggal dari keranjang
                $tanggalMulai = Carbon::parse($item->tanggal_mulai ?? now());  
                $tanggalSelesai = Carbon::parse($item->tanggal_selesai ?? now()->addDay());
                $durasi = $tanggalMulai->diffInDays($tanggalSelesai);
                
                // Minimal 1 hari
                if ($durasi <= 0) {
                    $durasi = 1;
                }
                
                $item->durasi = $durasi;
                $item->subtotal = $item->produk->harga * $item->jumlah * $durasi;
                
                return $item;
            });

            // Hitung total keseluruhan
            $total = $cartItems->sum('subtotal');

            // Debug: Log total
            \Log::info('Total calculated:', ['total' => $total]);

            // 5. Generate kode transaksi unik
            $kodeTransaksi = 'TRX-' . substr($validated['ktp'], -4) . substr($validated['telepon'], -3) . '-' . strtoupper(Str::random(4));

            // Debug: Log kode transaksi
            \Log::info('Kode transaksi generated:', ['kode' => $kodeTransaksi]);

            // 6. Simpan data ke tabel transaksi utama
            $transaksiData = [
                'user_id' => Auth::id(),
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'ktp' => $validated['ktp'],
                'alamat' => $validated['alamat'],
                'tanggal_sewa' => $tanggalMulai, // Dari keranjang
                'tanggal_kembali' => $tanggalKembali, // Dari keranjang
                'catatan' => $validated['catatan'] ?? '',
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'total_harga' => $total,
                'KODE_TRANSAKSI' => $kodeTransaksi,
            ];

            // Debug: Log data yang akan disimpan
            \Log::info('Data transaksi yang akan disimpan:', $transaksiData);

            // 7. Coba buat transaksi dengan error handling yang lebih detail
            try {
                \Log::info('Mencoba membuat transaksi...');
                
                // Cek apakah model Transaksi ada dan accessible
                \Log::info('Model Transaksi exists:', ['exists' => class_exists('App\Models\Transaksi')]);
                
                // Test database connection
                \Log::info('Database connection test:', [
                    'can_connect' => \DB::connection()->getPdo() ? 'YES' : 'NO'
                ]);
                
                // Test dengan query builder terlebih dahulu
                $testInsert = \DB::table('transaksis')->insertGetId($transaksiData);
                \Log::info('Insert dengan DB::table berhasil:', ['id' => $testInsert]);
                
                // Ambil data yang baru diinsert untuk memastikan
                $insertedData = \DB::table('transaksis')->find($testInsert);
                \Log::info('Data yang berhasil diinsert:', ['data' => $insertedData]);
                
                // Buat object transaksi dari data yang sudah diinsert
                $transaksi = Transaksi::find($testInsert);
                
                if (!$transaksi) {
                    throw new \Exception('Transaksi berhasil diinsert tapi tidak bisa diambil melalui model');
                }
                
                \Log::info('Transaksi berhasil dibuat:', ['id' => $transaksi->id]);
            } catch (\Exception $e) {
                \Log::error('Error creating transaksi:', [
                    'message' => $e->getMessage(),
                    'data' => $transaksiData,
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]);
                throw $e;
            }

            // 8. Simpan item satu per satu ke transaksi_items
            foreach ($cartItems as $item) {
                $itemData = [
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_per_hari' => $item->produk->harga,
                    'durasi' => $item->durasi,
                    'subtotal' => $item->subtotal,
                ];

                // Debug: Log item data
                \Log::info('Item transaksi data:', $itemData);

                try {
                    ItemTransaksi::create($itemData);
                } catch (\Exception $e) {
                    \Log::error('Error creating item transaksi:', [
                        'message' => $e->getMessage(),
                        'data' => $itemData
                    ]);
                    throw $e;
                }
            }

            // 9. Hapus isi keranjang user
            Keranjang::where('user_id', Auth::id())->delete();

            // Debug: Log success
            \Log::info('Checkout process completed successfully');

            // 10. Redirect ke halaman sukses
            return redirect()->route('checkout.sukses', ['kode' => $kodeTransaksi])
                            ->with('success', 'Transaksi berhasil diproses!');

        } catch (\Exception $e) {
            // Debug: Log error
            \Log::error('Error in processCheckout:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['items.produk'])->findOrFail($id);
        return view('checkout-sukses', compact('transaksi'));
    }

    public function checkoutSukses($kode)
    {
        $transaksi = Transaksi::where('KODE_TRANSAKSI', $kode)->with('items.produk')->firstOrFail();
        return view('checkout-sukses', compact('transaksi'));
    }
}