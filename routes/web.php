<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Models\Sale;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $userCount = User::count();
        $totalSales = Sale::sum(DB::raw('price * quantity'));
        return view('admin.dashboard', compact('userCount', 'totalSales'));
    })->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('sales', [SalesController::class, 'index'])->name('sales');
});