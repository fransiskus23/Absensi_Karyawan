<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalKerjaController;
// Halaman login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

// Logout
Route::get('/logout', [LoginController::class, 'actionlogout'])->name('actionlogout');

// Middleware auth untuk membatasi akses hanya bagi user yang login
Route::middleware(['auth'])->group(function () {

    // Dashboard / Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin Dashboard (optional jika berbeda dari home)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');


    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/check-in', [AbsensiController::class, 'checkIn'])->name('absensi.checkIn');
    Route::post('/absensi/check-out', [AbsensiController::class, 'checkOut'])->name('absensi.checkOut');
    Route::post('/absensi/tidak-hadir', [AbsensiController::class, 'markTidakHadir'])->name('absensi.tidakHadir');


    Route::get('/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('/absensi/{absensi}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');


    // Jadwal Kerja
    Route::get('jadwal-kerja/read', [JadwalKerjaController::class, 'read'])->name('jadwal.read');

});
