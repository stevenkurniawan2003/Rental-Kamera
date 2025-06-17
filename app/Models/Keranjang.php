<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Keranjang extends Model
{
    protected $fillable = [
        'user_id',
        'produk_id', 
        'jumlah',
        'duration', 
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Accessor untuk durasi
    public function getDurasiAttribute()
    {
        return $this->duration;
    }

    // Accessor untuk subtotal
    public function getSubtotalAttribute()
    {
        return $this->produk->harga * $this->jumlah * $this->durasi;
    }
}