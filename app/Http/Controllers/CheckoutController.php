<?php

namespace App\Http\Controllers;


use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {

    public function index()
    {
        $cartItems = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->produk->harga * $item->durasi * $item->jumlah;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        $cartItems = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->produk->harga * $item->durasi * $item->jumlah;
        });

        return view('checkout', compact('cartItems', 'total'));
    }


}