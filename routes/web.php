<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPasswordResetController;
use App\Http\Controllers\Admin\AdminLoginPageController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AnakAsuhController;
use App\Http\Controllers\Admin\AnakAsuhPageController;
use App\Http\Controllers\Admin\BerandaSiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\DonasiPageController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GaleriPageController;
use App\Http\Controllers\Admin\HeaderSiteController;
use App\Http\Controllers\Admin\JadwalKegiatanAnakController;
use App\Http\Controllers\Admin\JasaController as AdminJasaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\KontakPageController;
use App\Http\Controllers\Admin\KontakPesanController;
use App\Http\Controllers\Admin\KunjunganController as AdminKunjunganController;
use App\Http\Controllers\Admin\KunjunganPageController;
use App\Http\Controllers\Admin\PengelolaanDonasiController;
use App\Http\Controllers\Admin\ProgramPageController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\TentangController as AdminTentangController;
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
        Route::get('forgot-password', [AdminPasswordResetController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password', [AdminPasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('reset-password/{token}', [AdminPasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [AdminPasswordResetController::class, 'reset'])->name('password.update');

        Route::middleware('admin')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

            Route::get('profil', [AdminProfileController::class, 'edit'])->name('profile.edit');
            Route::put('profil', [AdminProfileController::class, 'update'])->name('profile.update');

            Route::get('donasi', [AdminDonasiController::class, 'index'])->name('donasi.index');
            Route::get('donasi/{donasi}', [AdminDonasiController::class, 'show'])->name('donasi.show');
            Route::post('donasi/{donasi}/status', [AdminDonasiController::class, 'status'])->name('donasi.status');
            Route::delete('donasi/{donasi}', [AdminDonasiController::class, 'destroy'])->name('donasi.destroy');

            Route::get('kunjungan', [AdminKunjunganController::class, 'index'])->name('kunjungan.index');
            Route::get('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'show'])->name('kunjungan.show');
            Route::post('kunjungan/{kunjungan}/status', [AdminKunjunganController::class, 'status'])->name('kunjungan.status');
            Route::post('kunjungan/{kunjungan}/respon', [AdminKunjunganController::class, 'sendRespon'])->name('kunjungan.respon');
            Route::post('kunjungan/{kunjungan}/email', [AdminKunjunganController::class, 'sendEmail'])->name('kunjungan.email');
            Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

            Route::get('pesan-kontak', [KontakPesanController::class, 'index'])->name('kontak-pesan.index');
            Route::get('pesan-kontak/{kontakPesan}', [KontakPesanController::class, 'show'])->name('kontak-pesan.show');
            Route::post('pesan-kontak/{kontakPesan}/balas', [KontakPesanController::class, 'balas'])->name('kontak-pesan.balas');
            Route::delete('pesan-kontak/{kontakPesan}', [KontakPesanController::class, 'destroy'])->name('kontak-pesan.destroy');

            Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
            Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
            Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
            Route::post('jasa/{jasa}/send-response', [AdminJasaController::class, 'sendResponse'])->name('jasa.send-response');
            Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');

            // Manajemen Kegiatan
            Route::get('kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan.index');
            Route::get('kegiatan/create', [AdminKegiatanController::class, 'create'])->name('kegiatan.create');
            Route::get('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'show'])->name('kegiatan.show');
            Route::post('kegiatan', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
            Route::get('kegiatan/{kegiatan}/edit', [AdminKegiatanController::class, 'edit'])->name('kegiatan.edit');
            Route::put('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
            Route::delete('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

            Route::get('kegiatan/kategori', [AdminKegiatanController::class, 'categories'])->name('kegiatan.categories.index');
            Route::post('kegiatan/kategori', [AdminKegiatanController::class, 'categoryStore'])->name('kegiatan.categories.store');
            Route::get('kegiatan/kategori/{category}/edit', [AdminKegiatanController::class, 'categoryEdit'])->name('kegiatan.categories.edit');
            Route::put('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryUpdate'])->name('kegiatan.categories.update');
            Route::delete('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryDestroy'])->name('kegiatan.categories.destroy');

            // Data Anak Asuh
            Route::get('anak-asuh', [AnakAsuhController::class, 'index'])->name('anak-asuh.index');
            Route::get('anak-asuh/create', [AnakAsuhController::class, 'create'])->name('anak-asuh.create');
            Route::post('anak-asuh', [AnakAsuhController::class, 'store'])->name('anak-asuh.store');
            Route::get('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'show'])->name('anak-asuh.show');
            Route::get('anak-asuh/{anakAsuh}/edit', [AnakAsuhController::class, 'edit'])->name('anak-asuh.edit');
            Route::put('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'update'])->name('anak-asuh.update');
            Route::delete('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'destroy'])->name('anak-asuh.destroy');

            // Jadwal Kegiatan Anak
            Route::get('jadwal-kegiatan-anak', [JadwalKegiatanAnakController::class, 'index'])->name('jadwal-anak.index');
            Route::get('jadwal-kegiatan-anak/create', [JadwalKegiatanAnakController::class, 'create'])->name('jadwal-anak.create');
            Route::post('jadwal-kegiatan-anak', [JadwalKegiatanAnakController::class, 'store'])->name('jadwal-anak.store');
            Route::get('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'show'])->name('jadwal-anak.show');
            Route::get('jadwal-kegiatan-anak/{jadwal}/edit', [JadwalKegiatanAnakController::class, 'edit'])->name('jadwal-anak.edit');
            Route::put('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'update'])->name('jadwal-anak.update');
            Route::delete('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'destroy'])->name('jadwal-anak.destroy');

            // Dokumentasi Video
            Route::get('dokumentasi-video', [VideoDokumentasiController::class, 'index'])->name('dokumentasi-video.index');
            Route::get('dokumentasi-video/{video}/stream', [VideoDokumentasiController::class, 'stream'])->name('dokumentasi-video.stream');
            Route::get('dokumentasi-video/create', [VideoDokumentasiController::class, 'create'])->name('dokumentasi-video.create');
            Route::post('dokumentasi-video', [VideoDokumentasiController::class, 'store'])->name('dokumentasi-video.store');
            Route::get('dokumentasi-video/{video}/edit', [VideoDokumentasiController::class, 'edit'])->name('dokumentasi-video.edit');
            Route::put('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'update'])->name('dokumentasi-video.update');
            Route::delete('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'destroy'])->name('dokumentasi-video.destroy');

            // Struktur Organisasi
            Route::get('struktur', [StrukturOrganisasiController::class, 'index'])->name('struktur.index');
            Route::get('struktur/create', [StrukturOrganisasiController::class, 'create'])->name('struktur.create');
            Route::post('struktur', [StrukturOrganisasiController::class, 'store'])->name('struktur.store');
            Route::get('struktur/{struktur}', [StrukturOrganisasiController::class, 'show'])->name('struktur.show');
            Route::get('struktur/{struktur}/edit', [StrukturOrganisasiController::class, 'edit'])->name('struktur.edit');
            Route::put('struktur/{struktur}', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');
            Route::delete('struktur/{struktur}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur.destroy');

            // Konten Tentang
            Route::get('tentang', [AdminTentangController::class, 'edit'])->name('tentang.edit');
            Route::put('tentang', [AdminTentangController::class, 'update'])->name('tentang.update');

            // Konten beranda, navigasi & footer (publik)
            Route::get('beranda', [BerandaSiteController::class, 'edit'])->name('beranda.edit');
            Route::put('beranda', [BerandaSiteController::class, 'update'])->name('beranda.update');

            Route::get('header-situs', [HeaderSiteController::class, 'edit'])->name('header-site.edit');
            Route::put('header-situs', [HeaderSiteController::class, 'update'])->name('header-site.update');

            Route::get('halaman-login', [AdminLoginPageController::class, 'edit'])->name('login-page.edit');
            Route::put('halaman-login', [AdminLoginPageController::class, 'update'])->name('login-page.update');

            Route::get('halaman-kegiatan', [ProgramPageController::class, 'edit'])->name('program-page.edit');
            Route::put('halaman-kegiatan', [ProgramPageController::class, 'update'])->name('program-page.update');

            Route::get('halaman-galeri', [GaleriPageController::class, 'edit'])->name('galeri-page.edit');
            Route::put('halaman-galeri', [GaleriPageController::class, 'update'])->name('galeri-page.update');

            Route::get('halaman-kunjungan', [KunjunganPageController::class, 'edit'])->name('kunjungan-page.edit');
            Route::put('halaman-kunjungan', [KunjunganPageController::class, 'update'])->name('kunjungan-page.update');

            Route::get('halaman-donasi', [DonasiPageController::class, 'edit'])->name('donasi-page.edit');
            Route::put('halaman-donasi', [DonasiPageController::class, 'update'])->name('donasi-page.update');

            Route::get('halaman-kontak', [KontakPageController::class, 'edit'])->name('kontak-page.edit');
            Route::put('halaman-kontak', [KontakPageController::class, 'update'])->name('kontak-page.update');

            Route::get('halaman-anak-asuh', [AnakAsuhPageController::class, 'edit'])->name('anak-asuh-page.edit');
            Route::put('halaman-anak-asuh', [AnakAsuhPageController::class, 'update'])->name('anak-asuh-page.update');

            // Galeri Foto
            Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
            Route::get('galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
            Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
            Route::get('galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
            Route::put('galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
            Route::delete('galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
            Route::get('galeri/kategori/create', [GaleriController::class, 'categoryCreate'])->name('galeri.categories.create');
            Route::post('galeri/kategori', [GaleriController::class, 'categoryStore'])->name('galeri.categories.store');

            // Pengelolaan Donasi
            Route::get('pengelolaan-donasi', [PengelolaanDonasiController::class, 'index'])->name('pengelolaan-donasi.index');
            Route::get('pengelolaan-donasi/create', [PengelolaanDonasiController::class, 'create'])->name('pengelolaan-donasi.create');
            Route::post('pengelolaan-donasi', [PengelolaanDonasiController::class, 'store'])->name('pengelolaan-donasi.store');
            Route::get('pengelolaan-donasi/{pengelolaanDonasi}/edit', [PengelolaanDonasiController::class, 'edit'])->name('pengelolaan-donasi.edit');
            Route::put('pengelolaan-donasi/{pengelolaanDonasi}', [PengelolaanDonasiController::class, 'update'])->name('pengelolaan-donasi.update');
            Route::delete('pengelolaan-donasi/{pengelolaanDonasi}', [PengelolaanDonasiController::class, 'destroy'])->name('pengelolaan-donasi.destroy');

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
Route::get('/program/unggulan', [PageController::class, 'programUnggulan'])->name('program.unggulan');
Route::get('/program/lainnya', [PageController::class, 'programLainnya'])->name('program.lainnya');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/dokumentasi-video/stream/{video}', [PageController::class, 'streamVideo'])->name('dokumentasi-video.stream');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/laporan', [DonasiController::class, 'laporanDonasi'])->name('donasi.laporan');
Route::get('/donasi/laporan-pengelolaan', [DonasiController::class, 'laporanPengelolaanDonasi'])->name('donasi.laporan-pengelolaan');
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

// Halaman publik: Data Anak Asuh & Jadwal Kegiatan Anak
Route::get('/anak-asuh', [PageController::class, 'anakAsuh'])->name('anak-asuh');
Route::get('/jadwal-kegiatan-anak', [PageController::class, 'jadwalKegiatanAnak'])->name('jadwal-kegiatan-anak');

// Admin (path: /admin/*) — untuk akses lewat domain utama
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('forgot-password', [AdminPasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('forgot-password', [AdminPasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AdminPasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [AdminPasswordResetController::class, 'reset'])->name('password.update');

    Route::middleware('admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profil', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profil', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('donasi', [AdminDonasiController::class, 'index'])->name('donasi.index');
        Route::get('donasi/{donasi}', [AdminDonasiController::class, 'show'])->name('donasi.show');
        Route::post('donasi/{donasi}/status', [AdminDonasiController::class, 'status'])->name('donasi.status');
        Route::delete('donasi/{donasi}', [AdminDonasiController::class, 'destroy'])->name('donasi.destroy');

        Route::get('kunjungan', [AdminKunjunganController::class, 'index'])->name('kunjungan.index');
        Route::get('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'show'])->name('kunjungan.show');
        Route::post('kunjungan/{kunjungan}/status', [AdminKunjunganController::class, 'status'])->name('kunjungan.status');
        Route::post('kunjungan/{kunjungan}/respon', [AdminKunjunganController::class, 'sendRespon'])->name('kunjungan.respon');
        Route::post('kunjungan/{kunjungan}/email', [AdminKunjunganController::class, 'sendEmail'])->name('kunjungan.email');
        Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('kunjungan.destroy');

        Route::get('pesan-kontak', [KontakPesanController::class, 'index'])->name('kontak-pesan.index');
        Route::get('pesan-kontak/{kontakPesan}', [KontakPesanController::class, 'show'])->name('kontak-pesan.show');
        Route::post('pesan-kontak/{kontakPesan}/balas', [KontakPesanController::class, 'balas'])->name('kontak-pesan.balas');
        Route::delete('pesan-kontak/{kontakPesan}', [KontakPesanController::class, 'destroy'])->name('kontak-pesan.destroy');

        Route::get('jasa', [AdminJasaController::class, 'index'])->name('jasa.index');
        Route::get('jasa/{jasa}', [AdminJasaController::class, 'show'])->name('jasa.show');
        Route::post('jasa/{jasa}/status', [AdminJasaController::class, 'status'])->name('jasa.status');
        Route::post('jasa/{jasa}/send-response', [AdminJasaController::class, 'sendResponse'])->name('jasa.send-response');
        Route::delete('jasa/{jasa}', [AdminJasaController::class, 'destroy'])->name('jasa.destroy');

        // Manajemen Kegiatan
        Route::get('kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/create', [AdminKegiatanController::class, 'create'])->name('kegiatan.create');
        Route::get('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'show'])->name('kegiatan.show');
        Route::post('kegiatan', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('kegiatan/{kegiatan}/edit', [AdminKegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('kegiatan/{kegiatan}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

        Route::get('kegiatan/kategori', [AdminKegiatanController::class, 'categories'])->name('kegiatan.categories.index');
        Route::post('kegiatan/kategori', [AdminKegiatanController::class, 'categoryStore'])->name('kegiatan.categories.store');
        Route::get('kegiatan/kategori/{category}/edit', [AdminKegiatanController::class, 'categoryEdit'])->name('kegiatan.categories.edit');
        Route::put('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryUpdate'])->name('kegiatan.categories.update');
        Route::delete('kegiatan/kategori/{category}', [AdminKegiatanController::class, 'categoryDestroy'])->name('kegiatan.categories.destroy');

        // Data Anak Asuh
        Route::get('anak-asuh', [AnakAsuhController::class, 'index'])->name('anak-asuh.index');
        Route::get('anak-asuh/create', [AnakAsuhController::class, 'create'])->name('anak-asuh.create');
        Route::post('anak-asuh', [AnakAsuhController::class, 'store'])->name('anak-asuh.store');
        Route::get('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'show'])->name('anak-asuh.show');
        Route::get('anak-asuh/{anakAsuh}/edit', [AnakAsuhController::class, 'edit'])->name('anak-asuh.edit');
        Route::put('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'update'])->name('anak-asuh.update');
        Route::delete('anak-asuh/{anakAsuh}', [AnakAsuhController::class, 'destroy'])->name('anak-asuh.destroy');

        // Jadwal Kegiatan Anak
        Route::get('jadwal-kegiatan-anak', [JadwalKegiatanAnakController::class, 'index'])->name('jadwal-anak.index');
        Route::get('jadwal-kegiatan-anak/create', [JadwalKegiatanAnakController::class, 'create'])->name('jadwal-anak.create');
        Route::post('jadwal-kegiatan-anak', [JadwalKegiatanAnakController::class, 'store'])->name('jadwal-anak.store');
        Route::get('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'show'])->name('jadwal-anak.show');
        Route::get('jadwal-kegiatan-anak/{jadwal}/edit', [JadwalKegiatanAnakController::class, 'edit'])->name('jadwal-anak.edit');
        Route::put('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'update'])->name('jadwal-anak.update');
        Route::delete('jadwal-kegiatan-anak/{jadwal}', [JadwalKegiatanAnakController::class, 'destroy'])->name('jadwal-anak.destroy');

        // Dokumentasi Video
        Route::get('dokumentasi-video', [VideoDokumentasiController::class, 'index'])->name('dokumentasi-video.index');
        Route::get('dokumentasi-video/{video}/stream', [VideoDokumentasiController::class, 'stream'])->name('dokumentasi-video.stream');
        Route::get('dokumentasi-video/create', [VideoDokumentasiController::class, 'create'])->name('dokumentasi-video.create');
        Route::post('dokumentasi-video', [VideoDokumentasiController::class, 'store'])->name('dokumentasi-video.store');
        Route::get('dokumentasi-video/{video}/edit', [VideoDokumentasiController::class, 'edit'])->name('dokumentasi-video.edit');
        Route::put('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'update'])->name('dokumentasi-video.update');
        Route::delete('dokumentasi-video/{video}', [VideoDokumentasiController::class, 'destroy'])->name('dokumentasi-video.destroy');

        // Struktur Organisasi
        Route::get('struktur', [StrukturOrganisasiController::class, 'index'])->name('struktur.index');
        Route::get('struktur/create', [StrukturOrganisasiController::class, 'create'])->name('struktur.create');
        Route::post('struktur', [StrukturOrganisasiController::class, 'store'])->name('struktur.store');
        Route::get('struktur/{struktur}', [StrukturOrganisasiController::class, 'show'])->name('struktur.show');
        Route::get('struktur/{struktur}/edit', [StrukturOrganisasiController::class, 'edit'])->name('struktur.edit');
        Route::put('struktur/{struktur}', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');
        Route::delete('struktur/{struktur}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur.destroy');

        // Konten Tentang
        Route::get('tentang', [AdminTentangController::class, 'edit'])->name('tentang.edit');
        Route::put('tentang', [AdminTentangController::class, 'update'])->name('tentang.update');

        // Konten beranda, navigasi & footer (publik)
        Route::get('beranda', [BerandaSiteController::class, 'edit'])->name('beranda.edit');
        Route::put('beranda', [BerandaSiteController::class, 'update'])->name('beranda.update');

        Route::get('header-situs', [HeaderSiteController::class, 'edit'])->name('header-site.edit');
        Route::put('header-situs', [HeaderSiteController::class, 'update'])->name('header-site.update');

        Route::get('halaman-login', [AdminLoginPageController::class, 'edit'])->name('login-page.edit');
        Route::put('halaman-login', [AdminLoginPageController::class, 'update'])->name('login-page.update');

        Route::get('halaman-kegiatan', [ProgramPageController::class, 'edit'])->name('program-page.edit');
        Route::put('halaman-kegiatan', [ProgramPageController::class, 'update'])->name('program-page.update');

        Route::get('halaman-galeri', [GaleriPageController::class, 'edit'])->name('galeri-page.edit');
        Route::put('halaman-galeri', [GaleriPageController::class, 'update'])->name('galeri-page.update');

        Route::get('halaman-kunjungan', [KunjunganPageController::class, 'edit'])->name('kunjungan-page.edit');
        Route::put('halaman-kunjungan', [KunjunganPageController::class, 'update'])->name('kunjungan-page.update');

        Route::get('halaman-donasi', [DonasiPageController::class, 'edit'])->name('donasi-page.edit');
        Route::put('halaman-donasi', [DonasiPageController::class, 'update'])->name('donasi-page.update');

        Route::get('halaman-kontak', [KontakPageController::class, 'edit'])->name('kontak-page.edit');
        Route::put('halaman-kontak', [KontakPageController::class, 'update'])->name('kontak-page.update');

        Route::get('halaman-anak-asuh', [AnakAsuhPageController::class, 'edit'])->name('anak-asuh-page.edit');
        Route::put('halaman-anak-asuh', [AnakAsuhPageController::class, 'update'])->name('anak-asuh-page.update');

        // Galeri Foto
        Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
        Route::get('galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
        Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
        Route::get('galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
        Route::put('galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
        Route::delete('galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
        Route::get('galeri/kategori/create', [GaleriController::class, 'categoryCreate'])->name('galeri.categories.create');
        Route::post('galeri/kategori', [GaleriController::class, 'categoryStore'])->name('galeri.categories.store');

        // Pengelolaan Donasi
        Route::get('pengelolaan-donasi', [PengelolaanDonasiController::class, 'index'])->name('pengelolaan-donasi.index');
        Route::get('pengelolaan-donasi/create', [PengelolaanDonasiController::class, 'create'])->name('pengelolaan-donasi.create');
        Route::post('pengelolaan-donasi', [PengelolaanDonasiController::class, 'store'])->name('pengelolaan-donasi.store');
        Route::get('pengelolaan-donasi/{pengelolaanDonasi}/edit', [PengelolaanDonasiController::class, 'edit'])->name('pengelolaan-donasi.edit');
        Route::put('pengelolaan-donasi/{pengelolaanDonasi}', [PengelolaanDonasiController::class, 'update'])->name('pengelolaan-donasi.update');
        Route::delete('pengelolaan-donasi/{pengelolaanDonasi}', [PengelolaanDonasiController::class, 'destroy'])->name('pengelolaan-donasi.destroy');

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
