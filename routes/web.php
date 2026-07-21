<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// PEMBERI KERJA
use App\Http\Controllers\PemberiKerja\DashboardController as PemberiKerjaDashboardController;
use App\Http\Controllers\PemberiKerja\LowonganController as PemberiKerjaLowonganController;
use App\Http\Controllers\PemberiKerja\LamaranController as PemberiKerjaLamaranController;
use App\Http\Controllers\PemberiKerja\KontrakController as PemberiKerjaKontrakController;
use App\Http\Controllers\PemberiKerja\ProfilController as PemberiKerjaProfilController;
use App\Http\Controllers\PemberiKerja\NotifikasiController as PemberiKerjaNotifikasiController;

// PESAN
use App\Http\Controllers\PesanController;

// PENCARI KERJA
use App\Http\Controllers\PencariKerja\DashboardController;
use App\Http\Controllers\PencariKerja\LowonganController;
use App\Http\Controllers\PencariKerja\LamaranController;
use App\Http\Controllers\PencariKerja\ProfilController;
use App\Http\Controllers\PencariKerja\NotifikasiController;
use App\Http\Controllers\PencariKerja\KontrakController as PencariKerjaKontrakController;
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

// PEMBERI KERJA
Route::middleware(['auth', 'cek.pemberi-kerja'])->prefix('pemberi-kerja')->name('pemberi-kerja.')->group(function () {

    Route::get('/dashboard', [PemberiKerjaDashboardController::class, 'index'])->name('dashboard');

    // Lowongan
    Route::get('/lowongan', [PemberiKerjaLowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/tambah', [PemberiKerjaLowonganController::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan', [PemberiKerjaLowonganController::class, 'store'])->name('lowongan.store');
    Route::get('/lowongan/{lowongan}', [PemberiKerjaLowonganController::class, 'show'])->name('lowongan.show');
    Route::get('/lowongan/{lowongan}/edit', [PemberiKerjaLowonganController::class, 'edit'])->name('lowongan.edit');
    Route::put('/lowongan/{lowongan}', [PemberiKerjaLowonganController::class, 'update'])->name('lowongan.update');
    Route::delete('/lowongan/{lowongan}', [PemberiKerjaLowonganController::class, 'destroy'])->name('lowongan.destroy');
    Route::patch('/lowongan/{lowongan}/toggle-status', [PemberiKerjaLowonganController::class, 'toggleStatus'])->name('lowongan.toggle-status');

    // Lamaran
    Route::post('/lamaran/{lamaran}/terima', [PemberiKerjaLamaranController::class, 'terima'])->name('lamaran.terima');
    Route::post('/lamaran/{lamaran}/tolak', [PemberiKerjaLamaranController::class, 'tolak'])->name('lamaran.tolak');

    // Kontrak
    Route::get('/kontrak', [PemberiKerjaKontrakController::class, 'index'])->name('kontrak.index');
    Route::get('/kontrak/{kontrak}', [PemberiKerjaKontrakController::class, 'show'])->name('kontrak.show');
    Route::post('/kontrak/{kontrak}/selesai', [PemberiKerjaKontrakController::class, 'tandaiSelesai'])->name('kontrak.selesai');
    Route::post('/kontrak/{kontrak}/bukti', [PemberiKerjaKontrakController::class, 'unggahBukti'])->name('kontrak.bukti');

    // Profil
    Route::get('/profil', [PemberiKerjaProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [PemberiKerjaProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/foto', [PemberiKerjaProfilController::class, 'updateFoto'])->name('profil.foto');

    // Pesan
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{percakapan}', [PesanController::class, 'show'])->name('pesan.show');
    Route::post('/pesan/{percakapan}/kirim', [PesanController::class, 'kirim'])->name('pesan.kirim');
    Route::get('/pesan/{percakapan}/baru', [PesanController::class, 'ambilBaru'])->name('pesan.baru');

    // Notifikasi
    Route::get('/notifikasi', [PemberiKerjaNotifikasiController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{notifikasi}/baca', [PemberiKerjaNotifikasiController::class, 'baca'])->name('notifikasi.baca');
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
    Route::delete('/lamaran/{lamaran}/batalkan', [LamaranController::class, 'batalkan'])->name('lamaran.batalkan');

    // Kontrak
    Route::post('/kontrak/{kontrak}/dibayar', [PencariKerjaKontrakController::class, 'konfirmasiDibayar'])->name('kontrak.dibayar');
    Route::post('/kontrak/{kontrak}/sengketa', [PencariKerjaKontrakController::class, 'ajukanSengketa'])->name('kontrak.sengketa');

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
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{notifikasi}/baca', [NotifikasiController::class, 'baca'])->name('notifikasi.baca');

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