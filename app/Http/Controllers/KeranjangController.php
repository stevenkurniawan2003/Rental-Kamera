<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KeranjangController extends Controller
{
    public function index()
    {
        // Ambil item keranjang milik user yang login
        $cartItems = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($item) {
                // Hitung durasi sewa (dalam hari)
                $startDate = Carbon::parse($item->tanggal_mulai);
                $endDate = Carbon::parse($item->tanggal_selesai);
                $item->duration = $startDate->diffInDays($endDate) + 1;

                // Hitung total harga (harga per hari x durasi x jumlah)
                $item->total_price = $item->produk->harga * $item->duration * $item->jumlah;

                return $item;
            });

        // Hitung total harga semua item di keranjang
        $totalPrice = $cartItems->sum('total_price');

        return view('keranjang', compact('cartItems', 'totalPrice'));
    }

    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'action_type' => 'required|in:add_to_cart,rent_now' // Tambahkan validasi untuk action_type
        ]);

        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($request->product_id);

        // Cek ketersediaan stok
        if ($produk->stok < $request->quantity) {
            return back()->with('error', 'Maaf, stok produk tidak mencukupi');
        }

        // Cek apakah produk sudah ada di keranjang
        $existingCart = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $request->product_id)
            ->first();

        if ($existingCart) {
            // Update item yang sudah ada
            $existingCart->update([
                'jumlah' => $existingCart->jumlah + $request->quantity,
                'tanggal_mulai' => $request->start_date,
                'tanggal_selesai' => $request->end_date
            ]);
        } else {
            // Tambahkan item baru ke keranjang
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $request->product_id,
                'jumlah' => $request->quantity,
                'tanggal_mulai' => $request->start_date,
                'tanggal_selesai' => $request->end_date
            ]);
        }

        // Redirect berdasarkan aksi
        if ($request->action_type == 'rent_now') {
            return redirect()->route('checkout')
                   ->with('success', 'Produk berhasil ditambahkan, silahkan lanjut ke pembayaran');
        }

        return redirect()->route('keranjang')
               ->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Validasi stok
        if ($request->quantity > $cartItem->produk->stok) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah melebihi stok yang tersedia (Stok: '.$cartItem->produk->stok.')'
            ], 422);
        }

        $cartItem->update([
            'jumlah' => $request->quantity
        ]);

        // Hitung ulang durasi dan total harga
        $startDate = Carbon::parse($cartItem->tanggal_mulai);
        $endDate = Carbon::parse($cartItem->tanggal_selesai);
        $duration = $startDate->diffInDays($endDate) + 1;
        $totalPrice = $cartItem->produk->harga * $duration * $request->quantity;

        return response()->json([
            'success' => true,
            'total_price' => 'Rp'.number_format($totalPrice, 0, ',', '.'),
            'subtotal' => 'Rp'.number_format($totalPrice, 0, ',', '.')
        ]);
    }

    public function hapus($id)
    {
        // Cari item keranjang berdasarkan ID dan milik user yang login
        $cartItem = Keranjang::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Hapus item dari keranjang
        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
