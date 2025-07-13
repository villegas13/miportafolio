<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Mostrar todos los posts

// Route::resource('post', PostController::class);
// Route::resource('category', CategoryController::class);
//Rutas agrupadas
Route::group( ['prefix' => 'dashboard', ], function () {
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
});

//Route::get('/post', [PostController::class, 'index'])->name('post.index');



Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post', [CategoryController::class, 'index'])->name('category.index');
Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
// Crear un nuevo post
//Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/post', [PostController::class, 'store'])->name('posts.store');