<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kelas\KeterlambatanController;
use App\Http\Controllers\Kelas\LaporanSampahController;
use App\Http\Controllers\Dev\TimeSimulatorController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:ketua_tingkat'])->prefix('kelas')->name('kelas.')->group(function () {

    Route::prefix('keterlambatan')->name('keterlambatan.')->group(function () {
        // Halaman View
        Route::get('/', [KeterlambatanController::class, 'index'])->name('index');
        Route::get('/buat', [KeterlambatanController::class, 'create'])->name('create');
        Route::post('/', [KeterlambatanController::class, 'store'])->name('store');
        
        // Endpoint AJAX
        Route::get('/jadwal-hari-ini', [KeterlambatanController::class, 'jadwalHariIni'])->name('jadwal-hari-ini');
        Route::get('/asisten/{idJadwal}', [KeterlambatanController::class, 'asisten'])->name('asisten');
    });
});

Route::middleware(['auth', 'role:ketua_tingkat|asisten'])->prefix('kelas')->name('kelas.')->group(function () {
    Route::prefix('sampah')->name('sampah.')->group(function () {
        // Halaman View
        Route::get('/', [\App\Http\Controllers\Kelas\LaporanSampahController::class, 'index'])->name('index');
        Route::get('/buat', [\App\Http\Controllers\Kelas\LaporanSampahController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Kelas\LaporanSampahController::class, 'store'])->name('store');

        // Endpoint AJAX
        Route::get('/ruangan-hari-ini', [\App\Http\Controllers\Kelas\LaporanSampahController::class, 'ruanganHariIni'])->name('ruangan-hari-ini');
    });

    Route::prefix('barang-rusak')->name('barang-rusak.')->group(function () {
        // Halaman View
        Route::get('/', [\App\Http\Controllers\LaporanBarangRusakController::class, 'index'])->name('index');
        Route::get('/buat', [\App\Http\Controllers\LaporanBarangRusakController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\LaporanBarangRusakController::class, 'store'])->name('store');

        // Endpoint AJAX (kita bisa gunakan service dari sampah jika logika jadwalnya sama, atau copy)
        Route::get('/ruangan-hari-ini', [\App\Http\Controllers\LaporanBarangRusakController::class, 'ruanganHariIni'])->name('ruangan-hari-ini');
    });
});

require __DIR__.'/auth.php';
