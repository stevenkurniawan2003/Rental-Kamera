<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/katalog', [ProdukController::class, 'katalog'])->name('kataloguser');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/createproduk', [AdminProdukController::class, 'create'])->name('produk.create');
    Route::put('/produk/{id}', [AdminProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [AdminProdukController::class, 'delete'])->name('produk.delete');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
