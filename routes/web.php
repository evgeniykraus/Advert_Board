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
    Route::group(['prefix' => '/login', 'middleware' => 'guest'], function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Register
    Route::group(['prefix' => '/register'], function () {
        Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/', [AuthController::class, 'register'])->name('register');
    });

//Adverts
    Route::group(['prefix' => '/advert'], function () {
        Route::get('/{id}', [AdvertController::class, 'show'])->whereNumber('id')->name('advert');

        Route::group(['middleware' => 'auth'], function () {
            Route::get('/add', [AdvertController::class, 'create'])->name('add_advert');
            Route::post('/add', [AdvertController::class, 'store'])->name('add_advert');
            Route::post('/sell', [AdvertController::class, 'sell'])->whereNumber('id')->name('sell');
        });
    });

//Categories
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');

//Users
    Route::group(['middleware' => 'auth', 'prefix' => '/home'], function () {
        Route::get('/', [UserController::class, 'show'])->name('profile');

        Route::group(['middleware' => 'admin', 'prefix' => '/admin_panel'], function () {
            Route::get('/', [UserController::class, 'adminPanel'])->name('admin_panel');
            Route::get('/users', [UserController::class, 'usersList'])->name('users');
            Route::post('/users', [UserController::class, 'blockUser'])->name('users');
            Route::get('//edit', [UserController::class, 'edit'])->name('edit');
            Route::post('/edit', [UserController::class, 'update'])->name('update');
            Route::get('/adverts', [AdvertController::class, 'advertsToCheck'])->name('adverts_to_check');
            Route::post('/adverts', [AdvertController::class, 'approve'])->name('advert_approve');
        });
    });
});




