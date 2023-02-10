<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
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
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

//Adverts
Route::get('/какой-то роут', [AdvertController::class, 'index'])->name('adverts_board');
Route::get('/какой-то роут', [AdvertController::class, 'show'])->name('adverts_board');


//Users
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/home', [UserController::class, 'show'])->name('profile');


//Categories

