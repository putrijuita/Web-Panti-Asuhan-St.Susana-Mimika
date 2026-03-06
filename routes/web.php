<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\JasaController as AdminJasaController;
use App\Http\Controllers\Admin\KunjunganController as AdminKunjunganController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Admin subdomain (admin.pantisusana.web.id): / = dashboard, /login = login — didaftar dulu agar / tidak ambil beranda
$adminDomain = config('admin.domain');
if ($adminDomain) {
    Route::domain($adminDomain)->name('admin.')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);

        Route::middleware('admin')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

            Route::get('donasi', [AdminDonasiController::class, 'index'])->name('donasi.index');
            Route::get('donasi/{donasi}', [AdminDonasiController::class, 'show'])->name('donasi.show');
            Route::post('donasi/{donasi}/status', [AdminDonasiController::class, 'status'])->name('donasi.status');
            Route::delete('donasi/{donasi}', [AdminDonasiController::class, 'destroy'])->name('donasi.destroy');

            Route::get('kunjungan', [AdminKunjunganController::class, 'index'])->name('kunjungan.index');
            Route::get('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'show'])->name('kunjungan.show');
            Route::post('kunjungan/{kunjungan}/status', [AdminKunjunganController::class, 'status'])->name('kunjungan.status');
            Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

            Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
            Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
            Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
            Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');
        });
    });
}

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/program', [PageController::class, 'program'])->name('program');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
Route::get('/donasi/keuangan', [DonasiController::class, 'keuangan'])->name('donasi.keuangan');
Route::post('/donasi/keuangan', [DonasiController::class, 'keuanganStore'])->name('donasi.keuangan.store');
Route::post('/donasi/keuangan/midtrans-token', [DonasiController::class, 'midtransToken'])->name('donasi.midtrans.token');
Route::get('/donasi/midtrans/status/{orderId}', [DonasiController::class, 'midtransStatus'])->name('donasi.midtrans.status');
Route::post('/donasi/midtrans/notification', [DonasiController::class, 'midtransNotification'])->name('donasi.midtrans.notification');
Route::get('/donasi/jasa', [DonasiController::class, 'jasa'])->name('donasi.jasa');
Route::post('/donasi/jasa', [DonasiController::class, 'jasaStore'])->name('donasi.jasa.store');
Route::get('/donasi/terima-kasih', [DonasiController::class, 'terimaKasih'])->name('donasi.terima-kasih');

Route::get('/kunjungan', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
Route::get('/kunjungan/terima-kasih', [KunjunganController::class, 'terimaKasih'])->name('kunjungan.terima-kasih');

// Admin (path: /admin/*) — untuk akses lewat domain utama
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('donasi', [AdminDonasiController::class, 'index'])->name('donasi.index');
        Route::get('donasi/{donasi}', [AdminDonasiController::class, 'show'])->name('donasi.show');
        Route::post('donasi/{donasi}/status', [AdminDonasiController::class, 'status'])->name('donasi.status');
        Route::delete('donasi/{donasi}', [AdminDonasiController::class, 'destroy'])->name('donasi.destroy');

        Route::get('kunjungan', [AdminKunjunganController::class, 'index'])->name('kunjungan.index');
        Route::get('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'show'])->name('kunjungan.show');
        Route::post('kunjungan/{kunjungan}/status', [AdminKunjunganController::class, 'status'])->name('kunjungan.status');
        Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

        Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
        Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
        Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
        Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');
    });
});

