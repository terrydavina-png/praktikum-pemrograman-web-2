<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        'name' => 'Antony Santos',
        'email' => 'elgasing@gmail.com'
    ]);
});

// Route::get('/posts', [PostController::class, 'index']);
Route::resource('/posts', PostController::class);

Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create']) ->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');