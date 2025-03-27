<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminKamarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HotelController;
use App\Http\Controllers\User\PesananController;
use App\Http\Controllers\User\UserKamarController; // Pastikan ini controller user, bukan admin

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');

    // Hotel Routes (User dapat melihat hotel dan detailnya)
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

    // Booking Routes (User dapat memesan kamar)
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    // Route User untuk melihat dan mencari kamar
    Route::get('/kamars', [UserKamarController::class, 'index'])->name('kamars.index');
    Route::get('/kamars/cari', [UserKamarController::class, 'cariKamar'])->name('kamars.cari');
    Route::get('/kamars/{id}', [UserKamarController::class, 'show'])->name('kamars.show');
    Route::post('/kamars/pesan', [UserKamarController::class, 'pesanKamar'])->name('kamars.pesan');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Manajemen Kamar (Admin Only)
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->group(function () {
    Route::get('/kamar', [AdminKamarController::class, 'index'])->name('admin.kamar.index');
    Route::get('/kamar/create', [AdminKamarController::class, 'create'])->name('admin.kamar.create');
    Route::post('/kamar/store', [AdminKamarController::class, 'store'])->name('admin.kamar.store');
    Route::get('/kamar/{kamar}/edit', [AdminKamarController::class, 'edit'])->name('admin.kamar.edit');
    Route::put('/kamar/{kamar}', [AdminKamarController::class, 'update'])->name('admin.kamar.update');
    Route::delete('/kamar/{kamar}', [AdminKamarController::class, 'destroy'])->name('admin.kamar.destroy');
});
