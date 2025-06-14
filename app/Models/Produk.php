<?php

namespace App\Models;

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
        'sensor',
        'iso',
        'deskripsi',
        'gambar'
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }
}
