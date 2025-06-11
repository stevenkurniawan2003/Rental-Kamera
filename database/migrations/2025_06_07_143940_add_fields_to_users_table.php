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
       Schema::table('users', function (Blueprint $table) {
        $table->string('nama')->after('id');
        $table->string('role')->default('user')->after('password');
        $table->string('nomor')->after('role');
        $table->text('alamat')->after('nomor');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['nama', 'role', 'nomor', 'alamat']);
    });
    }
};
