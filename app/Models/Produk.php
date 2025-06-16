<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'kategori',
        'merek',
        'kondisi',
        'deskripsi',
        'gambar'
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }

    protected static function booted()
{
    static::creating(function ($produk) {
        if (empty($produk->slug)) {
            $slugDasar = Str::slug($produk->nama);
            $slug = $slugDasar;
            $counter = 1;

            while (Produk::where('slug', $slug)->exists()) {
                $slug = $slugDasar . '-' . $counter++;
            }

            $produk->slug = $slug;
        }
    });
}
}
