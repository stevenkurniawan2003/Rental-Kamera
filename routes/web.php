<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;

// ==========================
// GUEST - Login & Register
// ==========================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==========================
// LANDING PAGE
// ==========================
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// ==========================
// PRODUK (Public)
// ==========================
Route::get('/katalog', [ProdukController::class, 'katalog'])->name('kataloguser');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('detail.produk');

// ==========================
// ADMIN (Middleware: auth + admin)
// ==========================
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/createproduk', [AdminProdukController::class, 'create'])->name('produk.create');
    Route::put('/produk/{id}', [AdminProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [AdminProdukController::class, 'delete'])->name('produk.delete');
});

// ==========================
// USER (Middleware: auth)
// ==========================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // CHECKOUT - PERBAIKAN ROUTE
    Route::get('/checkout', [TransaksiUserController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [TransaksiUserController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/sukses/{kode}', [TransaksiUserController::class, 'checkoutSukses'])->name('checkout.sukses');
});

Route::get('/riwayat-sewa', [App\Http\Controllers\TransaksiUserController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat.sewa');


Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

Route::get('/katalog', [ProdukController::class, 'katalog'])->name('kataloguser');

