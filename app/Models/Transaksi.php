<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Pastikan nama tabel benar

    protected $guarded = []; // Izinkan semua field untuk debug

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'telepon',
        'ktp',
        'alamat',
        'tanggal_sewa',
        'tanggal_kembali',
        'catatan',
        'metode_pembayaran',
        'total_harga',
        'KODE_TRANSAKSI',
        'status' // Tambahkan jika ada
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_kembali' => 'date',
        'total_harga' => 'decimal:2'
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan item transaksi
    public function items()
    {
        return $this->hasMany(ItemTransaksi::class);
    }
}