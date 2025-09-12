<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class,'index'])->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'signup')->name('signup.front');
    Route::post('/signup', 'register')->name('signup.store');

    Route::get('/login', 'signin')->name('signin.front');
    Route::post('/login', 'login')->name('signin.store');

    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('categories', CategoryController::class)->except('show');
Route::resource('levels', LevelController::class)->except('show');