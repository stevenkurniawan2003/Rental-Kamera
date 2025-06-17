<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ItemTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        // Cek jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('keranjang')->with('error', 'Keranjang kosong!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->produk->harga * $item->durasi * $item->jumlah;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'ktp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|in:qris,cod',
            'catatan' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Ambil items dari keranjang
            $cartItems = Keranjang::with('produk')
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang kosong!');
            }

            // Hitung total
            $total = $cartItems->sum(function ($item) {
                return $item->produk->harga * $item->durasi * $item->jumlah;
            });

            // Ambil tanggal dari item pertama (karena semua item punya tanggal yang sama)
            $firstItem = $cartItems->first();

            // Generate kode transaksi
            $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            // Buat transaksi
            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'ktp' => $request->ktp,
                'alamat' => $request->alamat,
                'tanggal_sewa' => $firstItem->tanggal_mulai,
                'tanggal_kembali' => $firstItem->tanggal_selesai,
                'catatan' => $request->catatan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_harga' => $total,
                'KODE_TRANSAKSI' => $kodeTransaksi
            ]);

            // Buat item transaksi untuk setiap produk
            foreach ($cartItems as $item) {
                ItemTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_per_hari' => $item->produk->harga,
                    'durasi' => $item->durasi,
                    'subtotal' => $item->produk->harga * $item->jumlah * $item->durasi
                ]);
            }

            // Hapus items dari keranjang setelah checkout berhasil
            Keranjang::where('user_id', Auth::id())->delete();

            DB::commit();

            // Redirect ke halaman sukses
            return redirect()->route('checkout.success', $transaksi->id)
                ->with('success', 'Checkout berhasil! Kode transaksi: ' . $kodeTransaksi);

        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error untuk debugging
            \Log::error('Checkout Error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $transaksi = Transaksi::with(['items.produk'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('transaksi'));
    }
}