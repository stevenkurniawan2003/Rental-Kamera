<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('nama');
        $table->string('email');
        $table->string('telepon');
        $table->string('ktp');
        $table->text('alamat');
        $table->date('tanggal_sewa');
        $table->date('tanggal_kembali');
        $table->text('catatan')->nullable();
        $table->enum('metode_pembayaran', ['qris', 'cod']);
        $table->integer('total_harga');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
