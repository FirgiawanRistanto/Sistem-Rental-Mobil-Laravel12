<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Models\Sale;
use App\Models\User;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::put('penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Google Socialite Routes
Route::get('auth/google', [App\Http\Controllers\Auth\SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'handleGoogleCallback']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
