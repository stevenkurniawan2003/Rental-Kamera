<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function detail($id)
    {
        $transaksi = Transaksi::with(['items.produk', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id()) // Pastikan user hanya bisa lihat transaksi sendiri
            ->firstOrFail();

        return view('transaksi.detail', compact('transaksi'));
    }

    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }
}