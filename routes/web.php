<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kelas\KeterlambatanController;
use App\Http\Controllers\Kelas\KeterlambatanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__.'/auth.php';
