<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
