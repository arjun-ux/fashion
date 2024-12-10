<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukkasirController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

// Redirect ke halaman laporan admin setelah login
Route::get('/dashboard', function () {
    return redirect()->route('admin.laporan.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Email verification route
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Owner Dashboard
Route::get('owner/dashboard', [OwnerController::class,'index']);

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    Route::get('/', function() {
        return redirect()->route('admin.laporan.index');
    })->name('dashboard');
    
    // Product and Category routes
    Route::resource('produk', ProductController::class);
    Route::resource('kategori', KategoriController::class);
    
    // Laporan routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/stats', [LaporanController::class, 'getStats'])->name('laporan.stats');
    
    // Pengguna routes
    Route::resource('pengguna', PenggunaController::class);
    
    // Report generation route
    Route::get('/reports/pdf', [ReportController::class, 'generatePDF'])->name('reports.pdf');
});

require __DIR__.'/auth.php';  // Memuat rute autentikasi dari auth.php

// Kasir routes
Route::middleware(['auth'])->group(function () {
    Route::get('/kasir/dashboard', [OrderController::class, 'index'])->name('kasir.dashboard');
    Route::get('/kasir', [OrderController::class, 'index'])->name('kasir.index');
    
    // Orders routes
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}/print', [OrderController::class, 'print'])->name('order.print');
    Route::get('/kasir/penjualan', [OrderController::class, 'history'])->name('penjualan.index');
    
    // Edit & Delete Orders
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    
    // Produk routes for Kasir
    Route::get('/kasir/produk', [ProdukkasirController::class, 'index'])->name('produk.index');
});

// Owner-specific routes
Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function() {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
    Route::get('/laporan/produk', [OwnerController::class, 'laporanProduk'])->name('laporan.produk');
    Route::get('/laporan/penjualan', [OwnerController::class, 'laporanPenjualan'])->name('laporan.penjualan');
});
