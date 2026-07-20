<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PencariKerja\DashboardController;
use App\Http\Controllers\PencariKerja\LowonganController;
use App\Http\Controllers\PencariKerja\LamaranController;
use App\Http\Controllers\PencariKerja\ProfilController;
use App\Http\Controllers\PencariKerja\PesanController;
use App\Http\Controllers\PencariKerja\LowonganTersimpanController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// GUEST
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegisterChoice'])->name('register');

    Route::get('/register/pemberi-kerja', [AuthController::class, 'showRegisterPemberiKerja'])
        ->name('register.pemberi-kerja');
    Route::post('/register/pemberi-kerja', [AuthController::class, 'registerPemberiKerja'])
        ->name('register.pemberi-kerja.process');

    Route::get('/register/pencari-kerja', [AuthController::class, 'showRegisterPencariKerja'])
        ->name('register.pencari-kerja');
    Route::post('/register/pencari-kerja', [AuthController::class, 'registerPencariKerja'])
        ->name('register.pencari-kerja.process');
});

// AUTH
Route::middleware(['auth', 'cek.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');
});

Route::middleware(['auth', 'cek.pemberi-kerja'])->prefix('pemberi-kerja')->name('pemberi-kerja.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pemberi-kerja.dashboard.index');
    })->name('dashboard');
});


// PENCARI KERJA
Route::middleware(['auth', 'cek.pencari-kerja'])->prefix('pencari-kerja')->name('pencari-kerja.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Lowongan
    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('lowongan.show');

    // Lamaran
    Route::get('/lamaran', [LamaranController::class, 'index'])->name('lamaran.index');
    Route::get('/lamaran/{lamaran}', [LamaranController::class, 'show'])->name('lamaran.show');
    Route::post('/lowongan/{lowongan}/lamar', [LamaranController::class, 'store'])->name('lamaran.store');

    // Profil
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/foto', [ProfilController::class, 'updateFoto'])->name('profil.foto');

    // Lowongan Tersimpan
    Route::get('/lowongan-tersimpan', [LowonganTersimpanController::class, 'index'])->name('lowongan-tersimpan.index');
    Route::post('lowongan/{lowongan}/simpan', [LowonganTersimpanController::class, 'toggle'])->name('lowongan.simpan');
    Route::delete('lowongan-tersimpan/{lowongan}/hapus', [LowonganTersimpanController::class, 'hapus'])->name('lowongan-tersimpan.hapus');

    // Pesan
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{percakapan}', [PesanController::class, 'show'])->name('pesan.show');
    Route::post('pesan/{percakapan}/kirim', [PesanController::class, 'kirim'])->name('pesan.kirim');
    Route::get('pesan/{percakapan}/baru', [PesanController::class, 'ambilBaru'])->name('pesan.baru');

    // Notifikasi (DUMMY - belum ada tabel/logic asli, tunggu keputusan scope resmi)
    Route::get('/notifikasi', function () {
        return view('pencari-kerja.notifikasi');
    })->name('notifikasi');

    // Bantuan (statis)
    Route::get('/bantuan', function () {
        return view('pencari-kerja.bantuan');
    })->name('bantuan');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route dashboard & fitur per role akan ditambahkan bertahap:
// admin.* -> setelah fitur Admin selesai
// pemberi-kerja.* -> setelah fitur Pemberi Kerja selesai
// pencari-kerja.* -> setelah fitur Pencari Kerja selesai