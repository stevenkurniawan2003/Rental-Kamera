<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ItemTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransaksiUserController extends Controller
{
    // Method untuk menampilkan halaman checkout
    public function checkout()
    {
        try {
            // Ambil semua item keranjang untuk user yang login
            $cartItems = Keranjang::with('produk')
                ->where('user_id', Auth::id())
                ->get();
            
            // Jika keranjang kosong, redirect ke keranjang
            if ($cartItems->isEmpty()) {
                return redirect()->route('keranjang')
                    ->with('error', 'Keranjang kosong! Silakan tambahkan produk terlebih dahulu.');
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
            
            // Log untuk debugging
            Log::info('Checkout page loaded', [
                'user_id' => Auth::id(),
                'cart_items_count' => $cartItems->count(),
                'total' => $total
            ]);
            
            // Return ke view checkout dengan data
            return view('checkout', compact('cartItems', 'total'));
            
        } catch (\Exception $e) {
            Log::error('Error loading checkout page: ' . $e->getMessage());
            return redirect()->route('keranjang')
                ->with('error', 'Terjadi kesalahan saat memuat halaman checkout.');
        }
    }

    // Method untuk memproses checkout (form submission)
    public function processCheckout(Request $request)
    {
        try {
            // Log semua request yang masuk
            Log::info('=== CHECKOUT PROCESS STARTED ===');
            Log::info('Request data:', $request->all());
            Log::info('User ID:', ['id' => Auth::id()]);

            // Mulai database transaction
            DB::beginTransaction();

            // 1. Validasi input dari form
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telepon' => 'required|string|max:20',
                'ktp' => 'required|string|min:16|max:16',
                'alamat' => 'required|string',
                'metode_pembayaran' => 'required|in:qris,cod',
                'catatan' => 'nullable|string',
                'tanggal_sewa' => 'required|date',
                'tanggal_kembali' => 'required|date|after:tanggal_sewa'
            ]);

            Log::info('Validation passed:', $validated);

            // 2. Ambil isi keranjang user
            $cartItems = Keranjang::with('produk')->where('user_id', Auth::id())->get();
            
            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang kosong!');
            }

            // 3. Hitung total dan set durasi untuk setiap item
            $cartItems = $cartItems->map(function ($item) {
                // Prioritaskan field duration dari database
                if (!empty($item->duration) && $item->duration > 0) {
                    $durasi = $item->duration;
                } else {
                    // Hitung durasi berdasarkan tanggal
                    $tanggalMulai = Carbon::parse($item->tanggal_mulai ?? now());  
                    $tanggalSelesai = Carbon::parse($item->tanggal_selesai ?? now()->addDay());
                    $durasi = $tanggalSelesai->diffInDays($tanggalMulai);
                }
                
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

            Log::info('Cart processing completed:', [
                'items_count' => $cartItems->count(),
                'total' => $total
            ]);

            // 4. Generate kode transaksi unik
            $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // 5. Simpan data ke tabel transaksi utama
            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'ktp' => $validated['ktp'],
                'alamat' => $validated['alamat'],
                'tanggal_sewa' => $validated['tanggal_sewa'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'catatan' => $validated['catatan'] ?? '',
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'total_harga' => $total,
                'KODE_TRANSAKSI' => $kodeTransaksi
            ]);

            Log::info('Transaksi created successfully:', [
                'id' => $transaksi->id,
                'kode' => $kodeTransaksi
            ]);

            // 6. Simpan item satu per satu ke transaksi_items
            foreach ($cartItems as $item) {
                $itemTransaksi = ItemTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_per_hari' => $item->produk->harga,
                    'durasi' => $item->durasi,
                    'subtotal' => $item->subtotal,
                ]);

                                Log::info('Item transaksi created:', [
                    'id' => $itemTransaksi->id,
                    'produk_id' => $item->produk_id,
                    'subtotal' => $item->subtotal
                ]);
            }

            // 7. Hapus isi keranjang user
            Keranjang::where('user_id', Auth::id())->delete();
            Log::info('Keranjang dikosongkan setelah checkout');

            // 8. Commit transaksi database
            DB::commit();
            Log::info('Checkout berhasil dan disimpan ke database');

            // 9. Redirect ke halaman sukses
            return redirect()->route('checkout.sukses', ['kode' => $kodeTransaksi])
                             ->with('success', 'Transaksi berhasil diproses!');

        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();
            Log::error('Error saat proses checkout:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan saat memproses transaksi: ' . $e->getMessage());
        }
    }

    // Method untuk menampilkan halaman sukses
    public function checkoutSukses($kode)
    {
        $transaksi = Transaksi::where('KODE_TRANSAKSI', $kode)->with('items.produk')->firstOrFail();
        return view('checkout-sukses', compact('transaksi'));
    }


    public function riwayat()
    {
        $transaksis = Transaksi::with('items.produk')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat-sewa', compact('transaksis'));
    }

}
