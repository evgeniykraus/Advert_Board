<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['categories'])->group(function () {
//Home_Page
    Route::get('/', [AdvertController::class, 'index'])->name('home');
    Route::get('/search', [AdvertController::class, 'search'])->name('search');

//Auth
    Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

//Adverts
    Route::get('/advert/{id}', [AdvertController::class, 'show'])->name('advert')->whereNumber('id');
    Route::get('/advert/add', [AdvertController::class, 'create'])->middleware('auth')->name('add_advert');
    Route::post('/advert/add', [AdvertController::class, 'store'])->middleware('auth')->name('add_advert');

//Categories
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');

//Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/home', [UserController::class, 'show'])->name('profile')->middleware('auth');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/home/admin_panel', [AdvertController::class, 'advertsToCheck'])->name('admin_panel');
        Route::post('/home/admin_panel', [AdvertController::class, 'approve'])->name('admin_panel');
    });


});




