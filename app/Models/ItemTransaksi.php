<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi_items'; // Sesuai dengan nama tabel di database

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah',
        'harga_per_hari',
        'durasi',
        'subtotal'
    ];

    protected $casts = [
        'harga_per_hari' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    // Relasi dengan transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    // Relasi dengan produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}