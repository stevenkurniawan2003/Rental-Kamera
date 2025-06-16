<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function create(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric|between:0,99999999.99',
        'stok' => 'required|integer|min:0',
        'kategori' => 'required|string',
        'merek' => 'required|string',
        'kondisi' => 'required|string',
        'deskripsi' => 'required|string',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Upload gambar
    $pathGambar = $request->file('gambar')->store('produk', 'public');
    $namaGambar = basename($pathGambar);

    // Buat slug unik
    $slugDasar = Str::slug($validated['nama']);
    $slug = $slugDasar;
    $counter = 1;
    while (Produk::where('slug', $slug)->exists()) {
        $slug = $slugDasar . '-' . $counter++;
    }

    // Simpan produk
    Produk::create([
        'nama' => $validated['nama'],
        'harga' => $validated['harga'],
        'stok' => $validated['stok'],
        'kategori' => $validated['kategori'],
        'merek' => $validated['merek'],
        'kondisi' => $validated['kondisi'],
        'deskripsi' => $validated['deskripsi'],
        'gambar' => $namaGambar,
        'status' => $validated['stok'] > 0 ? 'Tersedia' : 'Habis',
        'slug' => $slug,
    ]);

    return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|between:0,99999999.99',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'merek' => 'required|string',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $produk = Produk::findOrfail($id);

        if ($request->hasFile('gambar')) {

            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $pathGambar = $request->file('gambar')->store('produk', 'public');
             $validated['gambar'] = basename($pathGambar);;
        }

        $produk->update([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'kategori' => $validated['kategori'],
            'merek' => $validated['merek'],
            'kondisi' => $validated['kondisi'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $validated['gambar'] ?? $produk->gambar,
            'status' => $validated['stok'] > 0 ? 'Tersedia' : 'Habis'
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);

        if($produk->gambar) {
            Storage::disk('public')->delete('produk/' . $produk->gambar);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    public function show($slug)
    {
        $produk = Produk::where('slug', $slug)->firstOrFail();
        return view('produk.detail', compact('produk'));
    }
}
