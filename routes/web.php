<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\DonasiPengeluaranController as AdminDonasiPengeluaranController;
use App\Http\Controllers\Admin\JasaController as AdminJasaController;
use App\Http\Controllers\Admin\KunjunganController as AdminKunjunganController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\VideoDokumentasiController;
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
            Route::post('kunjungan/{kunjungan}/email', [AdminKunjunganController::class, 'sendEmail'])->name('kunjungan.email');
            Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

            Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
            Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
            Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
            Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');

            // Galeri Foto
            Route::get('galeri', [AdminGaleriController::class, 'index'])->name('galeri.index');
            Route::get('galeri/create', [AdminGaleriController::class, 'create'])->name('galeri.create');
            Route::post('galeri', [AdminGaleriController::class, 'store'])->name('galeri.store');
            Route::get('galeri/{galeri}/edit', [AdminGaleriController::class, 'edit'])->name('galeri.edit');
            Route::put('galeri/{galeri}', [AdminGaleriController::class, 'update'])->name('galeri.update');
            Route::delete('galeri/{galeri}', [AdminGaleriController::class, 'destroy'])->name('galeri.destroy');

            // Kategori Galeri
            Route::get('galeri/kategori/create', [AdminGaleriController::class, 'categoryCreate'])->name('galeri.categories.create');
            Route::post('galeri/kategori', [AdminGaleriController::class, 'categoryStore'])->name('galeri.categories.store');

            // Struktur Organisasi
            Route::get('struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur.index');
            Route::get('struktur-organisasi/create', [StrukturOrganisasiController::class, 'create'])->name('struktur.create');
            Route::post('struktur-organisasi', [StrukturOrganisasiController::class, 'store'])->name('struktur.store');
            Route::get('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'show'])->name('struktur.show');
            Route::get('struktur-organisasi/{struktur}/edit', [StrukturOrganisasiController::class, 'edit'])->name('struktur.edit');
            Route::put('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');
            Route::delete('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur.destroy');

            // Pengelolaan Donasi (pengeluaran donasi)
            Route::get('pengelolaan-donasi', [AdminDonasiPengeluaranController::class, 'index'])->name('pengelolaan-donasi.index');
            Route::get('pengelolaan-donasi/create', [AdminDonasiPengeluaranController::class, 'create'])->name('pengelolaan-donasi.create');
            Route::post('pengelolaan-donasi', [AdminDonasiPengeluaranController::class, 'store'])->name('pengelolaan-donasi.store');
            Route::get('pengelolaan-donasi/{pengelolaan_donasi}/edit', [AdminDonasiPengeluaranController::class, 'edit'])->name('pengelolaan-donasi.edit');
            Route::put('pengelolaan-donasi/{pengelolaan_donasi}', [AdminDonasiPengeluaranController::class, 'update'])->name('pengelolaan-donasi.update');
            Route::delete('pengelolaan-donasi/{pengelolaan_donasi}', [AdminDonasiPengeluaranController::class, 'destroy'])->name('pengelolaan-donasi.destroy');

            // Manajemen Kegiatan / Program
            Route::get('kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan.index');
            Route::get('kegiatan/create', [AdminKegiatanController::class, 'create'])->name('kegiatan.create');
            Route::post('kegiatan', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
            Route::get('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'show'])->name('kegiatan.show');
            Route::get('kegiatan/{kegiatan}/edit', [AdminKegiatanController::class, 'edit'])->name('kegiatan.edit');
            Route::put('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
            Route::delete('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

            Route::get('kegiatan/kategori', [AdminKegiatanController::class, 'categories'])->name('kegiatan.categories.index');
            Route::post('kegiatan/kategori', [AdminKegiatanController::class, 'categoryStore'])->name('kegiatan.categories.store');
            Route::get('kegiatan/kategori/{category}/edit', [AdminKegiatanController::class, 'categoryEdit'])->name('kegiatan.categories.edit');
            Route::put('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryUpdate'])->name('kegiatan.categories.update');
            Route::delete('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryDestroy'])->name('kegiatan.categories.destroy');

            // Dokumentasi Video
            Route::get('dokumentasi-video', [VideoDokumentasiController::class, 'index'])->name('dokumentasi-video.index');
            Route::get('dokumentasi-video/create', [VideoDokumentasiController::class, 'create'])->name('dokumentasi-video.create');
            Route::post('dokumentasi-video', [VideoDokumentasiController::class, 'store'])->name('dokumentasi-video.store');
            Route::get('dokumentasi-video/{video}/edit', [VideoDokumentasiController::class, 'edit'])->name('dokumentasi-video.edit');
            Route::put('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'update'])->name('dokumentasi-video.update');
            Route::delete('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'destroy'])->name('dokumentasi-video.destroy');

            // Manajemen Admin (hanya super_admin)
            Route::middleware('super_admin')->group(function () {
                Route::get('admins', [AdminManagementController::class, 'index'])->name('admins.index');
                Route::get('admins/create', [AdminManagementController::class, 'create'])->name('admins.create');
                Route::post('admins', [AdminManagementController::class, 'store'])->name('admins.store');
                Route::get('admins/{admin}/edit', [AdminManagementController::class, 'edit'])->name('admins.edit');
                Route::put('admins/{admin}', [AdminManagementController::class, 'update'])->name('admins.update');
                Route::delete('admins/{admin}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');
            });
        });
    });
}

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/program', [PageController::class, 'program'])->name('program');
Route::get('/program-unggulan', [PageController::class, 'programUnggulan'])->name('program.unggulan');
Route::get('/program-lainnya', [PageController::class, 'programLainnya'])->name('program.lainnya');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/laporan', [DonasiController::class, 'laporanDonasi'])->name('donasi.laporan');
Route::get('/donasi/laporan-pengeluaran', [DonasiController::class, 'laporanPengeluaranDonasi'])->name('donasi.laporan-pengeluaran');
Route::get('/donasi/qr-image/{transactionId}', [DonasiController::class, 'qrImage'])->name('donasi.qr-image');
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
        Route::post('kunjungan/{kunjungan}/email', [AdminKunjunganController::class, 'sendEmail'])->name('kunjungan.email');
        Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

        Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
        Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
        Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
        Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');

        // Galeri Foto
        Route::get('galeri', [AdminGaleriController::class, 'index'])->name('galeri.index');
        Route::get('galeri/create', [AdminGaleriController::class, 'create'])->name('galeri.create');
        Route::post('galeri', [AdminGaleriController::class, 'store'])->name('galeri.store');
        Route::get('galeri/{galeri}/edit', [AdminGaleriController::class, 'edit'])->name('galeri.edit');
        Route::put('galeri/{galeri}', [AdminGaleriController::class, 'update'])->name('galeri.update');
        Route::delete('galeri/{galeri}', [AdminGaleriController::class, 'destroy'])->name('galeri.destroy');

        // Kategori Galeri
        Route::get('galeri/kategori/create', [AdminGaleriController::class, 'categoryCreate'])->name('galeri.categories.create');
        Route::post('galeri/kategori', [AdminGaleriController::class, 'categoryStore'])->name('galeri.categories.store');

        // Struktur Organisasi
        Route::get('struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur.index');
        Route::get('struktur-organisasi/create', [StrukturOrganisasiController::class, 'create'])->name('struktur.create');
        Route::post('struktur-organisasi', [StrukturOrganisasiController::class, 'store'])->name('struktur.store');
        Route::get('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'show'])->name('struktur.show');
        Route::get('struktur-organisasi/{struktur}/edit', [StrukturOrganisasiController::class, 'edit'])->name('struktur.edit');
        Route::put('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');
        Route::delete('struktur-organisasi/{struktur}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur.destroy');

        // Pengelolaan Donasi (pengeluaran donasi)
        Route::get('pengelolaan-donasi', [AdminDonasiPengeluaranController::class, 'index'])->name('pengelolaan-donasi.index');
        Route::get('pengelolaan-donasi/create', [AdminDonasiPengeluaranController::class, 'create'])->name('pengelolaan-donasi.create');
        Route::post('pengelolaan-donasi', [AdminDonasiPengeluaranController::class, 'store'])->name('pengelolaan-donasi.store');
        Route::get('pengelolaan-donasi/{pengelolaan_donasi}/edit', [AdminDonasiPengeluaranController::class, 'edit'])->name('pengelolaan-donasi.edit');
        Route::put('pengelolaan-donasi/{pengelolaan_donasi}', [AdminDonasiPengeluaranController::class, 'update'])->name('pengelolaan-donasi.update');
        Route::delete('pengelolaan-donasi/{pengelolaan_donasi}', [AdminDonasiPengeluaranController::class, 'destroy'])->name('pengelolaan-donasi.destroy');

        // Manajemen Kegiatan / Program
        Route::get('kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/create', [AdminKegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('kegiatan', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'show'])->name('kegiatan.show');
        Route::get('kegiatan/{kegiatan}/edit', [AdminKegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

        Route::get('kegiatan/kategori', [AdminKegiatanController::class, 'categories'])->name('kegiatan.categories.index');
        Route::post('kegiatan/kategori', [AdminKegiatanController::class, 'categoryStore'])->name('kegiatan.categories.store');
        Route::get('kegiatan/kategori/{category}/edit', [AdminKegiatanController::class, 'categoryEdit'])->name('kegiatan.categories.edit');
        Route::put('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryUpdate'])->name('kegiatan.categories.update');
        Route::delete('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryDestroy'])->name('kegiatan.categories.destroy');

        // Manajemen Admin (hanya super_admin)
        Route::middleware('super_admin')->group(function () {
            Route::get('admins', [AdminManagementController::class, 'index'])->name('admins.index');
            Route::get('admins/create', [AdminManagementController::class, 'create'])->name('admins.create');
            Route::post('admins', [AdminManagementController::class, 'store'])->name('admins.store');
            Route::get('admins/{admin}/edit', [AdminManagementController::class, 'edit'])->name('admins.edit');
            Route::put('admins/{admin}', [AdminManagementController::class, 'update'])->name('admins.update');
            Route::delete('admins/{admin}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');
        });
    });
});
