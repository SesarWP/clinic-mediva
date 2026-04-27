<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboardController;
use App\Http\Controllers\Bidan\PatientController as BidanPatientController;
use App\Http\Controllers\Bidan\AncExaminationController;
use App\Http\Controllers\Bidan\AnemiaScreeningController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\ProfileController;

// ============================================
// HALAMAN UTAMA - Pilih Login
// ============================================
Route::get('/', [AuthController::class, 'showLoginChoice'])->name('home');

// ============================================
// AUTHENTICATION ROUTES
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login/bidan', [AuthController::class, 'showBidanLogin'])->name('login.bidan');
    Route::post('/login/bidan', [AuthController::class, 'loginBidan']);
    Route::get('/login/pasien', [AuthController::class, 'showPasienLogin'])->name('login.pasien');
    Route::post('/login/pasien', [AuthController::class, 'loginPasien']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// BIDAN ROUTES (Protected)
// ============================================
Route::prefix('bidan')->middleware(['auth', 'role:bidan'])->name('bidan.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [BidanDashboardController::class, 'index'])->name('dashboard');

    // CRUD Pasien
    Route::resource('patients', BidanPatientController::class);

    // Pemeriksaan ANC
    Route::get('/patients/{patient}/anc/create', [AncExaminationController::class, 'create'])->name('anc.create');
    Route::post('/patients/{patient}/anc', [AncExaminationController::class, 'store'])->name('anc.store');
    Route::get('/anc/{anc}/edit', [AncExaminationController::class, 'edit'])->name('anc.edit');
    Route::put('/anc/{anc}', [AncExaminationController::class, 'update'])->name('anc.update');
    Route::delete('/anc/{anc}', [AncExaminationController::class, 'destroy'])->name('anc.destroy');

    // Screening Anemia
    Route::get('/patients/{patient}/screening/create', [AnemiaScreeningController::class, 'create'])->name('screening.create');
    Route::post('/patients/{patient}/screening', [AnemiaScreeningController::class, 'store'])->name('screening.store');
    Route::get('/screening/{screening}/edit', [AnemiaScreeningController::class, 'edit'])->name('screening.edit');
    Route::put('/screening/{screening}', [AnemiaScreeningController::class, 'update'])->name('screening.update');
});

// ============================================
// PASIEN ROUTES (Protected)
// ============================================
Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->name('pasien.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

    // Riwayat Pemeriksaan
    Route::get('/riwayat', [PasienDashboardController::class, 'riwayat'])->name('riwayat');

    // Screening Anemia
    Route::get('/screening', [PasienDashboardController::class, 'screening'])->name('screening');
});