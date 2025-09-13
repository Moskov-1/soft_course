<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'signup')->name('signup.front');
    Route::post('/signup', 'register')->name('signup.store');

    Route::get('/login', 'signin')->name('login');
    Route::post('/login', 'login')->name('signin.store');

    Route::post('/logout', 'logout')->name('logout');
});


Route::middleware(['auth','auth.session'])->group(function () {

    Route::get('/', [PageController::class,'index'])->name('home');
    Route::post('courses/toggle/publish', [CourseController::class, 'togglePublish'])->name('courses.toggle.publish');
    Route::resource('courses', CourseController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('levels', LevelController::class)->except('show');
});