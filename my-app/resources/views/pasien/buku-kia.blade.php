@extends('layouts.pasien')

@section('title', 'Buku KIA Interaktif - Trimester 1')
@section('page-title', 'Buku KIA Interaktif')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Header Buku KIA -->
        <div class="d-flex justify-content-between align-items-center mb-4 kia-header">
            <div>
                <h4 class="fw-bold mb-1" style="color: #0b4d75;">Buku KIA Interaktif</h4>
                <span class="badge rounded-pill text-white px-3 py-2" style="background:#0375C4;">Trimester 1</span>
            </div>
            <div class="user-info text-end">
                <div class="fw-semibold text-dark">{{ auth()->user()->name }} - Pasien</div>
            </div>
        </div>

        <!-- Navigasi Antar Trimester -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <a href="{{ route('pasien.buku-kia.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-house me-1"></i> Beranda KIA
            </a>
            <span class="btn btn-sm rounded-pill px-3 text-white fw-semibold" style="background:#0375C4; cursor:default;">
                Trimester 1 (Bulan 1–3)
            </span>
            <a href="{{ route('pasien.buku-kia.trimester2') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                Trimester 2 <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Main Card Container -->
        <div class="card custom-card bg-off-white shadow-soft rounded-2xl border-0 mb-4">
            <div class="card-body p-3 p-md-4 p-lg-5">
                
                <!-- Horizontal Scrollable Tabs Navigation -->
                <ul class="nav nav-pills kia-tabs mb-4" id="kia-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="janin-tab" data-bs-toggle="pill" data-bs-target="#janin" type="button" role="tab" aria-controls="janin" aria-selected="true">
                            <i class="bi bi-heart-pulse me-1 me-md-2"></i>Perkembangan Janin
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="nutrisi-tab" data-bs-toggle="pill" data-bs-target="#nutrisi" type="button" role="tab" aria-controls="nutrisi" aria-selected="false">
                            <i class="bi bi-egg-fried me-1 me-md-2"></i>Nutrisi & Perawatan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="bahaya-tab" data-bs-toggle="pill" data-bs-target="#bahaya" type="button" role="tab" aria-controls="bahaya" aria-selected="false">
                            <i class="bi bi-exclamation-triangle me-1 me-md-2"></i>Tanda Bahaya & Jurnal
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="mental-tab" data-bs-toggle="pill" data-bs-target="#mental" type="button" role="tab" aria-controls="mental" aria-selected="false">
                            <i class="bi bi-flower1 me-1 me-md-2"></i>Mental & Kelas KIA
                        </button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content kia-tab-content mt-3" id="kia-tabs-content">
                <div class="tab-content kia-tab-content mt-3" id="kia-tabs-content">
                    
                    <!-- TAB 1: Perkembangan Janin -->
                    <div class="tab-pane fade show active" id="janin" role="tabpanel" aria-labelledby="janin-tab">

                        <!-- Banner Ringkasan Fase Trimester 1 -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #e0f2fe, #f0fdff);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:#0375C4;">
                                        <span style="font-size:1.5rem;line-height:1;">🧬</span>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color:#0375C4;">Masa Penting Pembentukan Bagian Tubuh Janin</h5>
                                </div>
                                <p class="text-muted mb-3">Trimester 1 (Bulan 1–3) adalah masa krusial di mana organ penting bayi, termasuk otak, mulai terbentuk. Ibu mungkin mengalami mual, muntah, dan mudah lelah, yang merupakan adaptasi normal tubuh.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background:#dbeafe;color:#1d4ed8;font-size:0.78rem;">
                                        <i class="bi bi-arrow-up-circle me-1"></i>Target Kenaikan BB Ibu: 1–3 kg
                                    </span>
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background:#dcfce7;color:#15803d;font-size:0.78rem;">
                                        <i class="bi bi-rulers me-1"></i>Panjang Janin: ~10 cm
                                    </span>
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background:#fef9c3;color:#854d0e;font-size:0.78rem;">
                                        <i class="bi bi-speedometer2 me-1"></i>Berat Janin: ~28 gram
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold text-dark mb-4">Ukuran Janin Anda (Bulan 1–3)</h5>
                        <!-- Grid Ukuran Janin -->
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🍚</div>
                                    <h6 class="fw-bold text-dark">Bulan 1</h6>
                                    <p class="text-muted small mb-0">Sebesar biji beras. Sistem saraf dan jantung mulai terbentuk.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🫐</div>
                                    <h6 class="fw-bold text-dark">Bulan 2</h6>
                                    <p class="text-muted small mb-0">Sebesar buah blueberry. Detak jantung janin sudah bisa terdengar lewat USG.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🍋</div>
                                    <h6 class="fw-bold text-dark">Bulan 3</h6>
                                    <p class="text-muted small mb-0">Sebesar jeruk nipis. Organ utama sudah terbentuk lengkap.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Perkembangan Otak Anak -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 bg-white">
                                <div class="card-body p-4 text-center">
                                    <h5 class="fw-bold text-dark mb-4">Perkembangan Otak Anak</h5>
                                    <div class="row align-items-center justify-content-center g-4">
                                        <div class="col-sm-4">
                                            <div class="circular-progress" data-percentage="25">
                                                <span class="progress-value">25%</span>
                                            </div>
                                            <div class="mt-3 fw-semibold">Saat Lahir</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="circular-progress" data-percentage="70">
                                                <span class="progress-value">70%</span>
                                            </div>
                                            <div class="mt-3 fw-semibold">Usia 1 Tahun</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="circular-progress" data-percentage="85">
                                                <span class="progress-value">85%</span>
                                            </div>
                                            <div class="mt-3 fw-semibold">Usia 3 Tahun</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: Nutrisi & Perawatan -->
                    <div class="tab-pane fade" id="nutrisi" role="tabpanel" aria-labelledby="nutrisi-tab">
                        <!-- Alert Garam -->
                        <div class="alert alert-warning alert-nutrisi border-warning border-start border-4 rounded-3 d-flex align-items-center mb-4 px-2 px-md-3 py-2 py-md-3">
                            <i class="bi bi-exclamation-circle-fill fs-3 text-warning me-3" style="color:#FFC107 !important;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Peringatan Nutrisi!</h6>
                                <p class="mb-0">Batasi konsumsi garam paling banyak <strong>1 sendok teh/hari</strong> untuk mencegah tekanan darah tinggi selama kehamilan.</p>
                            </div>
                        </div>

                        <!-- Porsi Makan -->
                        <h5 class="fw-bold text-dark mb-3">Porsi Makan Harian yang Dianjurkan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🍚</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Nasi / Karbohidrat</h6>
                                    <span class="badge rounded-pill" style="background:#F0B429;color:#fff;">5 porsi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🥚🍗</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Protein Hewani & Nabati</h6>
                                    <span class="badge rounded-pill" style="background:#0375C4;">4 porsi Hewani + 4 porsi Nabati</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🥦</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Sayuran</h6>
                                    <span class="badge rounded-pill" style="background:#28A745;">4 porsi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🍎</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Buah-buahan</h6>
                                    <span class="badge rounded-pill" style="background:#DC3545;">4 porsi</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jurnal TTD -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bandaid-fill text-success me-2"></i>Perawatan Sehari-hari</h5>
                                <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="bi bi-check-circle-fill mt-1 flex-shrink-0" style="color:#28A745;"></i>
                                        <span>Menjaga kebersihan diri: mandi 2x sehari dan ganti pakaian dalam secara rutin.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="bi bi-check-circle-fill mt-1 flex-shrink-0" style="color:#28A745;"></i>
                                        <span>Cuci tangan dengan sabun dan air mengalir sebelum makan, setelah ke toilet, dan setelah beraktivitas.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="bi bi-check-circle-fill mt-1 flex-shrink-0" style="color:#28A745;"></i>
                                        <span>Hubungan suami istri boleh dilakukan selama kondisi kehamilan sehat dan tidak ada larangan dari bidan/dokter.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Jurnal TTD -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-capsule text-danger me-2"></i>Jurnal Minum TTD (Mingguan)</h5>
                                <p class="text-muted small mb-3">Ceklis jika Ibu sudah meminum Tablet Tambah Darah (TTD) hari ini.</p>
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle">
                                        <thead>
                                            <tr class="text-center text-muted small border-bottom">
                                                <th>Senin</th>
                                                <th>Selasa</th>
                                                <th>Rabu</th>
                                                <th>Kamis</th>
                                                <th>Jumat</th>
                                                <th>Sabtu</th>
                                                <th>Minggu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Do not do -->
                        <h5 class="fw-bold text-dark mb-3">Yang Harus Dihindari</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Minum obat tanpa resep dokter</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Merokok & terpapar asap rokok</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Minum minuman beralkohol</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Aktivitas fisik terlalu berat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: Tanda Bahaya & Jurnal -->
                    <div class="tab-pane fade" id="bahaya" role="tabpanel" aria-labelledby="bahaya-tab">
                        <div class="alert-banner mb-4 rounded-4 shadow-sm text-center">
                            <i class="bi bi-exclamation-triangle-fill display-5 mb-2 d-block text-white"></i>
                            <h4 class="fw-bold mb-2 text-white">TANDA BAHAYA TRIMESTER 1</h4>
                            <p class="mb-0 text-white-50 fs-6">Segera periksa ke klinik jika mengalami Demam Tinggi, Mual/Muntah Hebat, Perdarahan, atau Nyeri Perut Hebat!</p>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-3 p-md-4 p-lg-5">
                                <h5 class="fw-bold text-dark border-bottom pb-3 mb-4"><i class="bi bi-journal-medical text-primary me-2"></i>Formulir Jurnal Kesehatan Harian</h5>
                                
                                <form action="{{ route('pasien.buku-kia.store') }}" method="POST">
                                    @csrf
                                    <!-- Menyesuaikan dengan KiaCheckinController logic (mengirim flag_x) -->
                                    <input type="hidden" name="from_buku_kia" value="1">
                                    
                                    <div class="mb-4">
                                        <!-- Tanda Bahaya Switches -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_0">Apakah ibu mengalami pandangan kabur?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_0" id="flag_0" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_1">Keluar cairan berbau dari jalan lahir?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_1" id="flag_1" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_2">Pusing/sakit kepala berat?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_2" id="flag_2" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_3">Mual dan muntah hebat?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_3" id="flag_3" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_4">Perdarahan?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_4" id="flag_4" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_5">Demam Tinggi?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_5" id="flag_5" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_6">Nyeri perut hebat?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_6" id="flag_6" value="1">
                                            </div>
                                        </div>

                                        <div class="mt-2 mb-3 px-1">
                                            <span class="text-muted fw-semibold" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.8px;">Masalah Lain Pada Kehamilan</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_7">
                                                Batuk lama (lebih dari 2 minggu)?
                                                <span class="badge ms-2 rounded-pill" style="background:#0375C4;font-size:0.68rem;">Masalah Lain</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_7" id="flag_7" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_8">
                                                Diare berulang?
                                                <span class="badge ms-2 rounded-pill" style="background:#0375C4;font-size:0.68rem;">Masalah Lain</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_8" id="flag_8" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_9">
                                                Jantung berdebar-debar atau nyeri di dada?
                                                <span class="badge ms-2 rounded-pill" style="background:#0375C4;font-size:0.68rem;">Masalah Lain</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_9" id="flag_9" value="1">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="flag_10">
                                                Sulit tidur dan cemas berlebihan?
                                                <span class="badge ms-2 rounded-pill" style="background:#0375C4;font-size:0.68rem;">Masalah Lain</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_10" id="flag_10" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-lg fw-bold text-white shadow-sm" style="background: linear-gradient(135deg, #0375C4, #0ea5e9); border-radius: 12px;">
                                            <i class="bi bi-save me-2"></i> Simpan Catatan Hari Ini
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: Mental & Kelas KIA -->
                    <div class="tab-pane fade" id="mental" role="tabpanel" aria-labelledby="mental-tab">
                        <h5 class="fw-bold text-dark mb-4">Tips Menjaga Kesehatan Jiwa</h5>
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #f3e8ff;">
                                    <i class="bi bi-moon-stars-fill mb-3 fs-2 d-block" style="color: #9333ea;"></i>
                                    <h6 class="fw-bold text-dark">Tidur Cukup</h6>
                                    <p class="small text-muted mb-0">Pastikan kualitas tidur Anda terjaga. Istirahat 7-8 jam sangat dianjurkan.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fce7f3;">
                                    <i class="bi bi-cup-hot-fill mb-3 fs-2 d-block" style="color: #db2777;"></i>
                                    <h6 class="fw-bold text-dark">Makan Bergizi</h6>
                                    <p class="small text-muted mb-0">Bukan tentang seberapa banyak porsi, tetapi keseimbangan gizinya.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fee2e2;">
                                    <i class="bi bi-people-fill mb-3 fs-2 d-block" style="color: #e11d48;"></i>
                                    <h6 class="fw-bold text-dark">Dukungan Suami & Keluarga</h6>
                                    <p class="small text-muted mb-0">Komunikasikan perasaan Anda, dukungan keluarga sangat penting di masa ini.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-card-checklist text-primary me-2"></i>Absensi Kelas Ibu Hamil</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-modern">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="text-center">No</th>
                                                <th width="30%">Tanggal Pertemuan</th>
                                                <th width="40%">Materi Utama</th>
                                                <th width="20%" class="text-center">Paraf Kader</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>-</td>
                                                <td>Perawatan Trimester 1</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>-</td>
                                                <td>Nutrisi & ASI Eksklusif</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>-</td>
                                                <td>Adaptasi Tubuh &amp; Mengatasi Mual Muntah (Emesis)</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Circular Progress Animation
        document.querySelectorAll('.circular-progress').forEach(function (circle) {
            const percentage = circle.getAttribute('data-percentage');
            circle.style.background = `conic-gradient(#0ea5e9 ${percentage * 3.6}deg, #e2e8f0 0deg)`;
        });
    });
</script>
@endpush

