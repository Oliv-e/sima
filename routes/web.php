<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\JadwalSholatController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KonfigController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/quote', [QuoteController::class, 'index'])->name('quote.index');
    Route::get('/quote/tambah', [QuoteController::class, 'tambah'])->name('quote.tambah');
    Route::post('/quote/tambah', [QuoteController::class, 'insert'])->name('quote.insert');
    Route::get('/quote/edit/{data}', [QuoteController::class, 'edit'])->name('quote.edit');
    Route::post('/quote/update/{data}', [QuoteController::class, 'update'])->name('quote.update');
    Route::post('/quote/delete/{data}', [QuoteController::class, 'delete'])->name('quote.delete');

    Route::get('/jadwal_sholat', [JadwalSholatController::class, 'index'])->name('jadwal_sholat.index');
    Route::get('/jadwal_sholat/tambah', [JadwalSholatController::class, 'tambah'])->name('jadwal_sholat.tambah');
    Route::post('/jadwal_sholat/import', [JadwalSholatController::class, 'import'])->name('jadwal_sholat.import');
    Route::get('/jadwal_sholat/edit/{id}', [JadwalSholatController::class, 'edit'])->name('jadwal_sholat.edit');
    Route::post('/jadwal_sholat/update', [JadwalSholatController::class, 'update'])->name('jadwal_sholat.update');

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.tambah');
    Route::post('/pengumuman/insert', [PengumumanController::class, 'insert'])->name('pengumuman.insert');
    Route::get('/pengumuman/edit/{data}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::post('/pengumuman/update/{data}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/delete/{data}', [PengumumanController::class, 'delete'])->name('pengumuman.delete');

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/{id}/{type}', [PetugasController::class, 'view'])->name('petugas.view');
    Route::POST('/petugas/{id}/{type}', [PetugasController::class, 'update'])->name('petugas.update');

    Route::POST('/config/update', [ConfigurationController::class, 'update'])->name('config.update');

    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/keuangan/tambah', [KeuanganController::class, 'tambah'])->name('keuangan.tambah');
    Route::post('/keuangan/create', [KeuanganController::class, 'create'])->name('keuangan.create');
    Route::get('/keuangan/edit/{id}', [KeuanganController::class, 'edit'])->name('keuangan.edit');
    Route::post('/keuangan/update/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
    Route::post('/keuangan/hapus/{id}', [KeuanganController::class, 'hapus'])->name('keuangan.hapus');

    Route::get('/gambar', [GambarController::class, 'index'])->name('gambar.index');
    Route::get('/gambar/tambah', [GambarController::class, 'tambah'])->name('gambar.tambah');
    Route::post('/gambar/create', [GambarController::class, 'create'])->name('gambar.create');
    Route::get('/gambar/edit/{id}', [GambarController::class, 'edit'])->name('gambar.edit');
    Route::put('/gambar/update/{id}', [GambarController::class, 'update'])->name('gambar.update');
    Route::post('/gambar/hapus/{id}', [GambarController::class, 'hapus'])->name('gambar.hapus');

    Route::get('/konfigurasi', [KonfigController::class,'index'])->name('konfig.index');
    Route::post('/konfigurasi/{id}', [KonfigController::class,'update'])->name('konfig.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/createstrg1', function () {
        Artisan::call('storage:link');
    });
});

require __DIR__.'/auth.php';
