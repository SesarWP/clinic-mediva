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
Route::get('/', [AuthController::class, 'showLoginChoice'])->name('login');

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

    // Update Kesehatan Harian/Mingguan (Old logic fallback if any)
    Route::get('/patients/{patient}/health-updates', [BidanHealthUpdateController::class, 'index'])->name('health-updates.index');
    Route::get('/patients/{patient}/health-updates/create', [BidanHealthUpdateController::class, 'create'])->name('health-updates.create');
    Route::post('/patients/{patient}/health-updates', [BidanHealthUpdateController::class, 'store'])->name('health-updates.store');
    Route::get('/health-updates/{update}', [BidanHealthUpdateController::class, 'show'])->name('health-updates.show');
    Route::get('/health-updates/{update}/edit', [BidanHealthUpdateController::class, 'edit'])->name('health-updates.edit');
    Route::put('/health-updates/{update}', [BidanHealthUpdateController::class, 'update'])->name('health-updates.update');
    Route::delete('/health-updates/{update}', [BidanHealthUpdateController::class, 'destroy'])->name('health-updates.destroy');

    // Gamified KIA Tracking (New)
    Route::post('/kia-alerts/{alert}/resolve', [BidanHealthUpdateController::class, 'resolveAlert'])->name('kia-alerts.resolve');
    Route::get('/patients/{patient}/kia-checkins', [BidanHealthUpdateController::class, 'kiaCheckins'])->name('kia-checkins.index');
    Route::post('/kia-checkins/{checkin}/note', [BidanHealthUpdateController::class, 'storeKiaNote'])->name('kia-checkins.note');
    Route::post('/patients/{patient}/consultations', [BidanHealthUpdateController::class, 'replyConsultation'])->name('consultations.reply');
    Route::post('/patients/{patient}/require-visit', [BidanHealthUpdateController::class, 'requireClinicVisit'])->name('patients.require-visit');
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

    // Buku KIA Interaktif
    Route::get('/buku-kia', [PasienDashboardController::class, 'bukuKiaIndex'])->name('buku-kia.index');
    Route::get('/buku-kia/trimester1', [PasienDashboardController::class, 'bukuKia'])->name('buku-kia');
    Route::get('/buku-kia/trimester2', [PasienDashboardController::class, 'bukuKiaTrimester2'])->name('buku-kia.trimester2');
    Route::get('/buku-kia/trimester3', [PasienDashboardController::class, 'bukuKiaTrimester3'])->name('buku-kia.trimester3');
    Route::post('/buku-kia/store', [\App\Http\Controllers\Pasien\KiaCheckinController::class, 'store'])->name('buku-kia.store');

    // Update Kesehatan (Menggunakan HealthUpdateController)
    Route::get('/health-updates', [\App\Http\Controllers\Pasien\HealthUpdateController::class, 'index'])->name('health-updates.index');
    Route::get('/health-updates/create', [\App\Http\Controllers\Pasien\HealthUpdateController::class, 'create'])->name('health-updates.create');
    Route::post('/health-updates', [\App\Http\Controllers\Pasien\HealthUpdateController::class, 'store'])->name('health-updates.store');
    Route::get('/health-updates/{update}', [\App\Http\Controllers\Pasien\HealthUpdateController::class, 'show'])->name('health-updates.show');
    
    // Tanya Bidan Chat
    Route::post('/health-updates/chat', [\App\Http\Controllers\Pasien\KiaCheckinController::class, 'storeChat'])->name('health-updates.chat');
});