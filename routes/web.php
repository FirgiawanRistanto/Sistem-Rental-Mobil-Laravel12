<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mobil Routes
    Route::resource('mobils', MobilController::class);

    // Pelanggan Routes
    Route::resource('pelanggans', PelangganController::class)->only(['index', 'show']);

    // Penyewaan Routes
    Route::resource('penyewaans', PenyewaanController::class);

    // Pengembalian Routes
    Route::get('pengembalian', [PenyewaanController::class, 'showPengembalianForm'])->name('pengembalian.index');
    Route::post('pengembalian/{penyewaan}', [PenyewaanController::class, 'prosesPengembalian'])->name('pengembalian.store');

    // Report Routes
    Route::get('reports/monthly', [DashboardController::class, 'report'])->name('dashboard.report');
    Route::get('reports/export', [DashboardController::class, 'export'])->name('reports.export');
});
