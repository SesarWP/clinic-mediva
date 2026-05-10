<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboardController;
use App\Http\Controllers\Bidan\PatientController as BidanPatientController;
use App\Http\Controllers\Bidan\AncExaminationController;
use App\Http\Controllers\Bidan\AnemiaScreeningController;
use App\Http\Controllers\Bidan\HealthUpdateController as BidanHealthUpdateController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\ProfileController;
use App\Http\Controllers\Pasien\HealthUpdateController as PasienHealthUpdateController;

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
    Route::get('/anc/select-patient', [AncExaminationController::class, 'selectPatient'])->name('anc.select-patient');
    Route::get('/patients/{patient}/anc/create', [AncExaminationController::class, 'create'])->name('anc.create');
    Route::post('/patients/{patient}/anc', [AncExaminationController::class, 'store'])->name('anc.store');
    Route::get('/anc/{anc}', [AncExaminationController::class, 'show'])->name('anc.show');
    Route::get('/anc/{anc}/edit', [AncExaminationController::class, 'edit'])->name('anc.edit');
    Route::put('/anc/{anc}', [AncExaminationController::class, 'update'])->name('anc.update');
    Route::delete('/anc/{anc}', [AncExaminationController::class, 'destroy'])->name('anc.destroy');

    // Screening Anemia
    Route::get('/screening/select-patient', [AnemiaScreeningController::class, 'selectPatient'])->name('screening.select-patient');
    Route::get('/patients/{patient}/screening/create', [AnemiaScreeningController::class, 'create'])->name('screening.create');
    Route::post('/patients/{patient}/screening', [AnemiaScreeningController::class, 'store'])->name('screening.store');
    Route::get('/screening/{screening}', [AnemiaScreeningController::class, 'show'])->name('screening.show');
    Route::get('/screening/{screening}/edit', [AnemiaScreeningController::class, 'edit'])->name('screening.edit');
    Route::put('/screening/{screening}', [AnemiaScreeningController::class, 'update'])->name('screening.update');
    Route::delete('/screening/{screening}', [AnemiaScreeningController::class, 'destroy'])->name('screening.destroy');

    // Update Kesehatan Harian/Mingguan
    Route::get('/patients/{patient}/health-updates', [BidanHealthUpdateController::class, 'index'])->name('health-updates.index');
    Route::get('/patients/{patient}/health-updates/create', [BidanHealthUpdateController::class, 'create'])->name('health-updates.create');
    Route::post('/patients/{patient}/health-updates', [BidanHealthUpdateController::class, 'store'])->name('health-updates.store');
    Route::get('/health-updates/{update}', [BidanHealthUpdateController::class, 'show'])->name('health-updates.show');
    Route::get('/health-updates/{update}/edit', [BidanHealthUpdateController::class, 'edit'])->name('health-updates.edit');
    Route::put('/health-updates/{update}', [BidanHealthUpdateController::class, 'update'])->name('health-updates.update');
    Route::delete('/health-updates/{update}', [BidanHealthUpdateController::class, 'destroy'])->name('health-updates.destroy');
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
    Route::get('/riwayat/anc/{anc}', [PasienDashboardController::class, 'ancDetail'])->name('riwayat.anc');

    // Screening Anemia
    Route::get('/screening', [PasienDashboardController::class, 'screening'])->name('screening');
    Route::get('/screening/{screening}', [PasienDashboardController::class, 'screeningDetail'])->name('screening.detail');

    // Update Kesehatan Harian/Mingguan
    Route::get('/health-updates', [PasienHealthUpdateController::class, 'index'])->name('health-updates.index');
    Route::get('/health-updates/create', [PasienHealthUpdateController::class, 'create'])->name('health-updates.create');
    Route::post('/health-updates', [PasienHealthUpdateController::class, 'store'])->name('health-updates.store');
    Route::get('/health-updates/{update}', [PasienHealthUpdateController::class, 'show'])->name('health-updates.show');
});