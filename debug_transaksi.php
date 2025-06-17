<?php
// Buat file ini di root Laravel atau jalankan di php artisan tinker

// 1. Cek struktur tabel
echo "=== STRUKTUR TABEL TRANSAKSIS ===\n";
$columns = DB::select("DESCRIBE transaksis");
foreach($columns as $column) {
    echo "- {$column->Field} ({$column->Type}) - {$column->Null} - {$column->Key}\n";
}

echo "\n=== CEK DATA EXISTING ===\n";
$count = DB::table('transaksis')->count();
echo "Jumlah data di tabel transaksis: {$count}\n";

echo "\n=== TEST INSERT MANUAL ===\n";
try {
    $testData = [
        'user_id' => 1,
        'nama' => 'Test User',
        'email' => 'test@example.com',
        'telepon' => '08123456789',
        'ktp' => '1234567890123456',
        'alamat' => 'Test Address',
        'tanggal_sewa' => '2024-01-01',
        'tanggal_kembali' => '2024-01-02',
        'catatan' => 'Test Note',
        'metode_pembayaran' => 'qris',
        'total_harga' => 100000,
        'KODE_TRANSAKSI' => 'TEST-123',
        'created_at' => now(),
        'updated_at' => now()
    ];
    
    $id = DB::table('transaksis')->insertGetId($testData);
    echo "Test insert berhasil dengan ID: {$id}\n";
    
    // Hapus data test
    DB::table('transaksis')->where('id', $id)->delete();
    echo "Data test berhasil dihapus\n";
    
} catch(\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}  

echo "\n=== CEK MODEL TRANSAKSI ===\n";
try {
    $model = new App\Models\Transaksi();
    echo "Model Transaksi exists: YES\n";
    echo "Table name: " . $model->getTable() . "\n";
    echo "Fillable fields: " . implode(', ', $model->getFillable()) . "\n";
} catch(\Exception $e) {
    echo "Error dengan model: " . $e->getMessage() . "\n";
}