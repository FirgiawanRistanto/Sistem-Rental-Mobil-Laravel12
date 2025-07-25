<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {


    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::put('penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('log.visitor');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('products/{product:slug}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('products.show')->middleware('log.visitor');
Route::get('products/category/{category}', [App\Http\Controllers\HomeController::class, 'productsByCategory'])->name('products.byCategory');

// Cart Routes
Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::patch('cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('checkout/place-order', [App\Http\Controllers\CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::get('order-success', function() {
    return view('order.success');
})->name('order.success');
