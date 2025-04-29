<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Siswa
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/', [SiswaController::class, 'store'])->name('store');
    Route::get('/{id}', [SiswaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SiswaController::class, 'update'])->name('update');
    Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('destroy');
});

// Kelas
Route::prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/', [KelasController::class, 'index'])->name('index');
    Route::get('/create', [KelasController::class, 'create'])->name('create');
    Route::post('/', [KelasController::class, 'store'])->name('store');
    Route::get('/{id}', [KelasController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [KelasController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KelasController::class, 'update'])->name('update');
    Route::delete('/{id}', [KelasController::class, 'destroy'])->name('destroy');
});

// Guru
Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('index');
    Route::get('/create', [GuruController::class, 'create'])->name('create');
    Route::post('/', [GuruController::class, 'store'])->name('store');
    Route::get('/{id}', [GuruController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [GuruController::class, 'edit'])->name('edit');
    Route::put('/{id}', [GuruController::class, 'update'])->name('update');
    Route::delete('/{id}', [GuruController::class, 'destroy'])->name('destroy');
});