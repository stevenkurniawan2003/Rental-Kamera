<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminAkun extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Rental', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'nomor' => '081234567890',
            'alamat' => 'Jl.Kalimantan No.80, Sumbersari, Kabupaten Jember, Jawa Timur'
        ]);
    }
}
