<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function katalog()
    {
        $produks = Produk::latest()->paginate(8);
        return view('katalog', compact('produks'));
    }

    public function detailproduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail-produk', compact('produk'));
    }
}
