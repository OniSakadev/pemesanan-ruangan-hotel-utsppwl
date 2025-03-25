<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KamarController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kamars', [KamarController::class, 'index']);
    Route::post('/kamars', [KamarController::class, 'store']);
    Route::put('/kamars/{kamar}', [KamarController::class, 'update']);
    Route::delete('/kamars/{kamar}', [KamarController::class, 'destroy']);
});
