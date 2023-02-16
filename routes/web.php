<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['categories', 'user_on_black_list'])->group(function () {

//Home_Page
    Route::get('/', [AdvertController::class, 'index'])->name('home');
    Route::get('/search', [AdvertController::class, 'search'])->name('search');

//Auth
    Route::prefix('/login')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Register
    Route::prefix('/register')->group(function () {
        Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/', [AuthController::class, 'register'])->name('register');
    });

//Adverts
    Route::prefix('/advert')->group(function () {
        Route::get('/{id}', [AdvertController::class, 'show'])->whereNumber('id')->name('advert');
        Route::post('/sell', [AdvertController::class, 'sell'])->whereNumber('id')->name('sell');
        Route::get('/add', [AdvertController::class, 'create'])->middleware('auth')->name('add_advert');
        Route::post('/add', [AdvertController::class, 'store'])->middleware('auth')->name('add_advert');
    });


//Categories
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');

//Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/home', [UserController::class, 'show'])->name('profile')->middleware('auth');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::prefix('/home/admin_panel')->group(function () {
            Route::get('/home/admin_panel', [UserController::class, 'adminPanel'])->name('admin_panel');
            Route::get('/users', [UserController::class, 'usersList'])->name('users');
            Route::post('/users', [UserController::class, 'blockUser'])->name('users');
            Route::get('//edit', [UserController::class, 'edit'])->name('edit');
            Route::post('/edit', [UserController::class, 'update'])->name('update');
            Route::get('/adverts', [AdvertController::class, 'advertsToCheck'])->name('adverts_to_check');
            Route::post('/adverts', [AdvertController::class, 'approve'])->name('advert_approve');
        });
    });
});




