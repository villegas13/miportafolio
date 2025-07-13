<?php

use App\Http\Controllers\Dashboard\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Mostrar todos los posts

Route::resource('post', PostController::class);


//Route::get('/post', [PostController::class, 'index'])->name('post.index');



Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
// Crear un nuevo post
//Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/post', [PostController::class, 'store'])->name('posts.store');