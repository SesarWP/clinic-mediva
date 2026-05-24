@extends('layouts.pasien')

@section('title', 'Buku KIA Interaktif - Trimester 2')
@section('page-title', 'Buku KIA Interaktif')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Header Buku KIA -->
        <div class="d-flex justify-content-between align-items-center mb-4 kia-header">
            <div>
                <h4 class="fw-bold mb-1" style="color: #0b4d75;">Buku KIA Interaktif</h4>
                <span class="badge rounded-pill text-white px-3 py-2" style="background:#00A9BB;">Trimester 2</span>
            </div>
            <div class="user-info text-end">
                <div class="fw-semibold text-dark">{{ auth()->user()->name }} - Pasien</div>
            </div>
        </div>

        <!-- Navigasi Antar Trimester -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <a href="{{ route('pasien.buku-kia') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Trimester 1
            </a>
            <span class="btn btn-sm rounded-pill px-3 text-white fw-semibold" style="background:#00A9BB; cursor:default;">
                Trimester 2 (Bulan 4–6)
            </span>
            <a href="{{ route('pasien.buku-kia.trimester3') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                Trimester 3 <i class="bi bi-arrow-right ms-1"></i>
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

                    <!-- ================================================ -->
                    <!-- TAB 1: Perkembangan Janin                        -->
                    <!-- ================================================ -->
                    <div class="tab-pane fade show active" id="janin" role="tabpanel" aria-labelledby="janin-tab">

                        <!-- Banner Info Trimester 2 -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #e0f7fa, #f0fdff);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:#00A9BB;">
                                        <i class="bi bi-calendar2-heart-fill fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color:#00A9BB;">Saatnya Mulai Merencanakan Kelahiran</h5>
                                </div>
                                <p class="text-muted mb-0">Trimester 2 (Bulan 4–6) adalah periode paling nyaman dalam kehamilan. Mual biasanya mereda, energi meningkat, dan Anda mulai merasakan gerakan si kecil. Gunakan waktu ini untuk mempersiapkan rencana persalinan, melengkapi nutrisi, dan rutin memeriksakan kandungan.</p>
                            </div>
                        </div>

                        <h5 class="fw-bold text-dark mb-4">Ukuran Janin Anda (Bulan 4–6)</h5>

                        <!-- Grid Ukuran Janin -->
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🍎</div>
                                    <h6 class="fw-bold text-dark">Bulan 4</h6>
                                    <p class="text-muted small mb-0">Sebesar buah apel. Panjang sekitar 12,5 cm. Gejala mual pada ibu mulai berkurang.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🦶</div>
                                    <h6 class="fw-bold text-dark">Bulan 5</h6>
                                    <p class="text-muted small mb-0">Ibu mulai merasakan gerak bayi seperti menendang. Kenaikan berat badan ibu sekitar 4–8 kg.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🌽</div>
                                    <h6 class="fw-bold text-dark">Bulan 6</h6>
                                    <p class="text-muted small mb-0">Sebesar jagung. Panjang bisa mencapai 34 cm dan berat sekitar 1.000 gram. Organ fungsi tubuh berkembang.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Perkembangan Otak -->
                        <div class="card border-0 shadow-sm rounded-4">
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
                    <!-- END TAB 1 -->

                    <!-- ================================================ -->
                    <!-- TAB 2: Nutrisi & Perawatan                       -->
                    <!-- ================================================ -->
                    <div class="tab-pane fade" id="nutrisi" role="tabpanel" aria-labelledby="nutrisi-tab">

                        <!-- Alert Nutrisi Trimester 2 -->
                        <div class="alert alert-warning alert-nutrisi border-warning border-start border-4 rounded-3 d-flex align-items-center mb-4 px-2 px-md-3 py-2 py-md-3">
                            <i class="bi bi-exclamation-circle-fill fs-3 text-warning me-3" style="color:#FFC107 !important;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Peringatan Nutrisi Trimester 2!</h6>
                                <p class="mb-0">Makan dengan porsi lebih kecil tapi sering <strong>(3x makan utama + 1–2x kudapan)</strong>. Batasi konsumsi garam maks <strong>1 sdt/hari</strong> &amp; minum air <strong>8–12 gelas/hari</strong> untuk mencegah tekanan darah tinggi dan pembengkakan.</p>
                            </div>
                        </div>

                        <!-- Porsi Makan Harian -->
                        <h5 class="fw-bold text-dark mb-3">Porsi Makan Harian yang Dianjurkan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <img src="{{ asset('images/icons/rice-icon.png') }}" alt="Nasi/Karbohidrat">
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Nasi / Karbohidrat</h6>
                                    <span class="badge rounded-pill" style="background:#F0B429;color:#fff;">6 porsi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <img src="{{ asset('images/icons/protein-icon.png') }}" alt="Protein Hewani & Nabati">
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Protein Hewani &amp; Nabati</h6>
                                    <span class="badge rounded-pill" style="background:#0375C4;">4 porsi Hewani + 4 porsi Nabati</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <img src="{{ asset('images/icons/vegetables-icon.png') }}" alt="Sayuran">
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Sayuran</h6>
                                    <span class="badge rounded-pill" style="background:#28A745;">4 porsi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <img src="{{ asset('images/icons/fruits-icon.png') }}" alt="Buah-buahan">
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Buah-buahan</h6>
                                    <span class="badge rounded-pill" style="background:#DC3545;">4 porsi</span>
                                </div>
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
                                                <th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th><th>Minggu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                @for ($i = 0; $i < 7; $i++)
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input custom-checkbox fs-4" type="checkbox">
                                                    </div>
                                                </td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Yang Harus Dihindari -->
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
                                    <span class="fw-semibold">Merokok &amp; terpapar asap rokok</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Konsumsi makanan tinggi garam &amp; lemak jenuh</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="danger-card">
                                    <i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i>
                                    <span class="fw-semibold">Aktivitas fisik terlalu berat atau mengangkat beban</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 2 -->

                    <!-- ================================================ -->
                    <!-- TAB 3: Tanda Bahaya & Jurnal                     -->
                    <!-- ================================================ -->
                    <div class="tab-pane fade" id="bahaya" role="tabpanel" aria-labelledby="bahaya-tab">

                        <!-- Banner Alert Merah -->
                        <div class="alert-banner mb-4 rounded-4 shadow-sm text-center">
                            <i class="bi bi-exclamation-triangle-fill display-5 mb-2 d-block text-white"></i>
                            <h4 class="fw-bold mb-2 text-white">TANDA BAHAYA TRIMESTER 2!</h4>
                            <p class="mb-0 text-white-50 fs-6">Segera periksa ke Puskesmas/Rumah Sakit jika mengalami tanda bahaya berikut.</p>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-3 p-md-4 p-lg-5">
                                <h5 class="fw-bold text-dark border-bottom pb-3 mb-4">
                                    <i class="bi bi-journal-medical text-primary me-2"></i>Formulir Jurnal Kesehatan Harian
                                </h5>

                                <form action="{{ route('pasien.buku-kia.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="from_buku_kia" value="1">
                                    <input type="hidden" name="trimester" value="2">

                                    <div class="mb-4">
                                        <!-- 1. Demam Tinggi -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_0">Demam Tinggi?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_0" id="t2_flag_0" value="1">
                                            </div>
                                        </div>
                                        <!-- 2. Muntah darah -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_1">
                                                Muntah darah?
                                                <span class="badge ms-2 rounded-pill" style="background:#DC3545;font-size:0.7rem;">Baru</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_1" id="t2_flag_1" value="1">
                                            </div>
                                        </div>
                                        <!-- 3. Napas pendek & jantung berdebar -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_2">
                                                Napas pendek dan jantung berdebar kencang?
                                                <span class="badge ms-2 rounded-pill" style="background:#DC3545;font-size:0.7rem;">Baru</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_2" id="t2_flag_2" value="1">
                                            </div>
                                        </div>
                                        <!-- 4. Nyeri perut hebat -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_3">Nyeri perut hebat?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_3" id="t2_flag_3" value="1">
                                            </div>
                                        </div>
                                        <!-- 5. Pandangan kabur -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_4">Pandangan kabur?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_4" id="t2_flag_4" value="1">
                                            </div>
                                        </div>
                                        <!-- 6. Perdarahan / cairan berbau -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_5">Perdarahan / keluar cairan dari jalan lahir berbau?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_5" id="t2_flag_5" value="1">
                                            </div>
                                        </div>
                                        <!-- 7. Pusing / sakit kepala berat -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_6">Pusing / sakit kepala berat?</label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_6" id="t2_flag_6" value="1">
                                            </div>
                                        </div>
                                        <!-- 8. Sakit saat kencing / keputihan gatal -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0" for="t2_flag_7">
                                                Sakit saat kencing / keluar keputihan gatal?
                                                <span class="badge ms-2 rounded-pill" style="background:#DC3545;font-size:0.7rem;">Baru</span>
                                            </label>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_7" id="t2_flag_7" value="1">
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
                    <!-- END TAB 3 -->

                    <!-- ================================================ -->
                    <!-- TAB 4: Mental & Kelas KIA                        -->
                    <!-- ================================================ -->
                    <div class="tab-pane fade" id="mental" role="tabpanel" aria-labelledby="mental-tab">
                        <h5 class="fw-bold text-dark mb-4">Persiapan Mental Menyambut Kelahiran</h5>
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #e0f2fe;">
                                    <i class="bi bi-chat-heart-fill mb-3 fs-2 d-block" style="color: #0375C4;"></i>
                                    <h6 class="fw-bold text-dark">Diskusi Rencana Persalinan</h6>
                                    <p class="small text-muted mb-0">Bicarakan dengan suami dan bidan mengenai tempat, metode, dan pendamping persalinan yang Anda inginkan.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fce7f3;">
                                    <i class="bi bi-wind mb-3 fs-2 d-block" style="color: #db2777;"></i>
                                    <h6 class="fw-bold text-dark">Latihan Pernapasan</h6>
                                    <p class="small text-muted mb-0">Mulai latihan teknik pernapasan dalam dan relaksasi untuk mempersiapkan diri menghadapi proses persalinan.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #f0fdf4;">
                                    <i class="bi bi-people-fill mb-3 fs-2 d-block" style="color: #16a34a;"></i>
                                    <h6 class="fw-bold text-dark">Dukungan Suami &amp; Keluarga</h6>
                                    <p class="small text-muted mb-0">Libatkan suami dalam setiap pemeriksaan. Dukungan emosional dari keluarga sangat berpengaruh pada kesehatan ibu dan janin.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fef9c3;">
                                    <i class="bi bi-music-note-beamed mb-3 fs-2 d-block" style="color: #ca8a04;"></i>
                                    <h6 class="fw-bold text-dark">Stimulasi Janin</h6>
                                    <p class="small text-muted mb-0">Ajak bicara, perdengarkan musik lembut, atau bacakan cerita untuk si kecil. Janin sudah bisa mendengar sejak bulan ke-5.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #f3e8ff;">
                                    <i class="bi bi-moon-stars-fill mb-3 fs-2 d-block" style="color: #9333ea;"></i>
                                    <h6 class="fw-bold text-dark">Tidur Cukup &amp; Berkualitas</h6>
                                    <p class="small text-muted mb-0">Tidur miring ke kiri dianjurkan untuk melancarkan aliran darah ke janin. Gunakan bantal kehamilan jika perlu.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fee2e2;">
                                    <i class="bi bi-journal-text mb-3 fs-2 d-block" style="color: #e11d48;"></i>
                                    <h6 class="fw-bold text-dark">Catat Gerakan Janin</h6>
                                    <p class="small text-muted mb-0">Mulai bulan ke-5, hitung gerakan janin minimal 10 kali dalam 2 jam. Segera hubungi bidan jika gerakan berkurang drastis.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Absensi Kelas Ibu Hamil -->
                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-4">
                                    <i class="bi bi-card-checklist text-primary me-2"></i>Absensi Kelas Ibu Hamil — Trimester 2
                                </h5>
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
                                                <td>Perawatan Kehamilan Trimester 2</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>-</td>
                                                <td>Nutrisi &amp; Penambahan Berat Badan Ideal</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>-</td>
                                                <td>Persiapan Persalinan &amp; Tanda Bahaya</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>-</td>
                                                <td>Stimulasi Janin &amp; Kesehatan Mental Ibu</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 4 -->

                </div>
                <!-- END Tabs Content -->

            </div>
        </div>
        <!-- END Main Card -->

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
