<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\NotifController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
    Route::get('dashboard/revenue-chart', [DashboardController::class, 'getRevenueChartData'])->name('dashboard.revenue_chart');

    // Mobil Routes
    Route::resource('mobils', MobilController::class);
    Route::delete('mobils/gambar/{mobilGambar}', [MobilController::class, 'deleteGambar'])->name('mobils.deleteGambar');
    Route::put('mobils/gambar/reorder', [MobilController::class, 'reorderGambar'])->name('mobils.reorderGambar');

    // Pelanggan Routes
    Route::post('pelanggans/store-ajax', [PelangganController::class, 'storeAjax'])->name('pelanggans.storeAjax');
    Route::resource('pelanggans', PelangganController::class)->except(['create', 'store']);
    Route::get('pelanggans-data', [PelangganController::class, 'getPelanggansData'])->name('pelanggans.data');

    // Penyewaan Routes
    Route::resource('penyewaans', PenyewaanController::class);
    Route::get('penyewaans-data', [PenyewaanController::class, 'getPenyewaansData'])->name('penyewaans.data');

    // Perawatan Routes
    Route::get('perawatans/{perawatan}/complete', [PerawatanController::class, 'showCompleteForm'])->name('perawatans.completeForm');
    Route::put('perawatans/{perawatan}/complete', [PerawatanController::class, 'complete'])->name('perawatans.complete');
    Route::resource('perawatans', PerawatanController::class);

    // Pengembalian Routes
    Route::get('pengembalian', [PenyewaanController::class, 'showPengembalianForm'])->name('pengembalian.index');
    Route::post('pengembalian/{penyewaan}', [PenyewaanController::class, 'prosesPengembalian'])->name('pengembalian.store');

    // Report Routes
    Route::get('reports/monthly', [DashboardController::class, 'report'])->name('dashboard.report');
    Route::get('reports/export', [DashboardController::class, 'export'])->name('reports.export');

    // Notification Routes
    Route::post('notifications/{notification}/mark-as-read', [NotifController::class, 'markAsRead'])->name('notifications.markAsRead');
});

// Temporary route for testing notification URL
Route::get('/test-notification', function() {
    Log::info('Test notification route hit!');
    $mobil = App\Models\Mobil::first(); // Ambil mobil pertama untuk pengujian
    if ($mobil) {
        $user = App\Models\User::first(); // Ambil user pertama untuk pengujian
        if ($user) {
            $user->notify(new App\Notifications\MaintenanceReminder($mobil));
            return 'Notifikasi terkirim. Cek database.';
        }
        return 'Tidak ada user ditemukan.';
    }
    return 'Tidak ada mobil ditemukan.';
})->name('test.notification');