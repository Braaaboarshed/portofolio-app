<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


Route::get('login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/delete-all-posts', [PostController::class, 'deleteAllPosts'])->name('deleteAllPosts');

Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::middleware('auth')->resource('posts', PostController::class);

Route::middleware('auth')->resource('users', UserController::class);

