<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // public function katalog()
    // {
    //     $produks = Produk::latest()->paginate(8);
    //     return view('katalog', compact('produks'));
    // }

    public function detailproduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail-produk', compact('produk'));
    }

    public function show($slug)
    {
        $produk = Produk::where('slug', $slug)->firstOrFail();
        return view('detail-produk', compact('produk'));
    }

    public function katalog(Request $request)
    {
        $produks = Produk::latest()->paginate(8);
        return view('katalog', compact('produks'));
        $query = Produk::query();

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan merek
        if ($request->filled('merek')) {
            $query->where('merek', $request->merek);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            if ($request->status === 'tersedia') {
                $query->where('stok', '>', 0);
            } else {
                $query->where('stok', '<=', 0);
            }
        }

        // Filter berdasarkan keyword pencarian
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Urutan
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'terbaru':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'termurah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('harga', 'desc');
                    break;
            }
        }

        $produks = $query->paginate(9);
        return view('pages.katalog', compact('produks'));
    }

    
}
