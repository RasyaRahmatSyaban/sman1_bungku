<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [AuthController::class, 'login'])->name('auth.login');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    // User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    
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
    
    // Mapel
    Route::prefix('mata-pelajaran')->name('mata-pelajaran.')->group(function () {
        Route::get('/', [MataPelajaranController::class, 'index'])->name('index');
        Route::get('/create', [MataPelajaranController::class, 'create'])->name('create');
        Route::post('/', [MataPelajaranController::class, 'store'])->name('store');
        Route::get('/{id}', [MataPelajaranController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MataPelajaranController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MataPelajaranController::class, 'update'])->name('update');
        Route::delete('/{id}', [MataPelajaranController::class, 'destroy'])->name('destroy');
    });
    
    // Jadwal
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [JadwalController::class, 'index'])->name('index');
        Route::get('/create', [JadwalController::class, 'create'])->name('create');
        Route::post('/', [JadwalController::class, 'store'])->name('store');
        Route::get('/{id}', [JadwalController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [JadwalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JadwalController::class, 'update'])->name('update');
        Route::delete('/{id}', [JadwalController::class, 'destroy'])->name('destroy');
    });

    // Absensi
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('index');
    });
});

Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    // Nilai
    Route::prefix('nilai')->name('nilai.')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('index');
        Route::get('/create/{jadwal_id}', [NilaiController::class, 'create'])->name('create');
        Route::post('/', [NilaiController::class, 'store'])->name('store');
        Route::get('/edit', [NilaiController::class, 'edit'])->name('edit');
        Route::get('/daftar-nilai', [NilaiController::class, 'daftarNilai'])->name('daftar-nilai');
        Route::put('/', [NilaiController::class, 'update'])->name('update');
        Route::delete('/', [NilaiController::class, 'destroy'])->name('destroy');
    });
    
    // Absensi
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('index');
        Route::get('/create/{jadwal_id}', [AbsensiController::class, 'create'])->name('create');
        Route::post('/', [AbsensiController::class, 'store'])->name('store');
        Route::get('/edit', [AbsensiController::class, 'edit'])->name('edit');
        Route::get('/daftar-absensi', [AbsensiController::class, 'daftarAbsensi'])->name('daftar-absensi');
        Route::put('/update', [AbsensiController::class, 'update'])->name('update');
        Route::delete('/', [AbsensiController::class, 'destroy'])->name('destroy');
    });
    
    // Kelas
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('index');
    });

    // Jadwal
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [JadwalController::class, 'index'])->name('index');
    });
});

Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    // Nilai
    Route::prefix('nilai')->name('nilai.')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('index');
    });

    // Kelas
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('index');
    });

    // Jadwal
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [JadwalController::class, 'index'])->name('index');
    });
    
    // Absensi
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('index');
    });
});