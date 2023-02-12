<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Home_Page
Route::get('/', function () {
    return view('layouts.home-page');
})->name('home');

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Adverts
Route::get('/adverts', [AdvertController::class, 'index'])->name('adverts');
Route::get('/advert/{id}', [AdvertController::class, 'show'])->name('advert');

//Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');

//Users
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/home', [UserController::class, 'show'])->name('profile');




