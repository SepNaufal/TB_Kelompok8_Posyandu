<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\CatatanKesehatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Balita CRUD
    Route::resource('balita', BalitaController::class)->parameters([
        'balita' => 'balita'
    ]);

    // Ibu Hamil CRUD
    Route::resource('ibu-hamil', IbuHamilController::class)->parameters([
        'ibu-hamil' => 'ibuHamil'
    ]);

    // Lansia CRUD
    Route::resource('lansia', LansiaController::class)->parameters([
        'lansia' => 'lansia'
    ]);

    // Kader CRUD
    Route::resource('kader', KaderController::class)->parameters([
        'kader' => 'kader'
    ]);

    // Jadwal Posyandu CRUD
    Route::resource('jadwal', JadwalPosyanduController::class)->parameters([
        'jadwal' => 'jadwal'
    ]);

    // Catatan Kesehatan CRUD
    Route::resource('catatan', CatatanKesehatanController::class)->parameters([
        'catatan' => 'catatan'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
