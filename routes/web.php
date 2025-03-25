<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\RoomController;

Route::get('/home', function () {
    return view('admin.dashboard');
})->name('home');

Route::resource('rooms', KamarController::class);


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('kamar', KamarController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
