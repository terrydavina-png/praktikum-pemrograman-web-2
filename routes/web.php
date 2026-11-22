<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Buku
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

    // SEO: daftar buku dan detail buku (alamat memakai slug)
    Route::get('/list-buku', [BukuController::class, 'listBuku'])->name('buku.list');
    Route::get('/detail-buku/{title}', [BukuController::class, 'galbuku'])->name('galeri.buku');

    // Gallery: semua user login boleh melihat
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

    // Khusus admin
    Route::middleware('admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

        Route::resource('gallery', GalleryController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class)->except('show');
    });
});

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');