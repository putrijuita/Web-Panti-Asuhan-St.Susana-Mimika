<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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
Route::get('/donasi/jasa', [DonasiController::class, 'jasa'])->name('donasi.jasa');
Route::post('/donasi/jasa', [DonasiController::class, 'jasaStore'])->name('donasi.jasa.store');
Route::get('/donasi/terima-kasih', [DonasiController::class, 'terimaKasih'])->name('donasi.terima-kasih');

Route::get('/kunjungan', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
Route::get('/kunjungan/terima-kasih', [KunjunganController::class, 'terimaKasih'])->name('kunjungan.terima-kasih');
