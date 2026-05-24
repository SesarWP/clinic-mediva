@extends('layouts.pasien')

@section('title', 'Buku KIA Interaktif - Trimester 3')
@section('page-title', 'Buku KIA Interaktif')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 kia-header">
            <div>
                <h4 class="fw-bold mb-1" style="color: #0b4d75;">Buku KIA Interaktif</h4>
                <span class="badge rounded-pill text-white px-3 py-2" style="background: linear-gradient(135deg,#e11d48,#f43f5e);">Trimester 3</span>
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
            <a href="{{ route('pasien.buku-kia.trimester2') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Trimester 2
            </a>
            <span class="btn btn-sm rounded-pill px-3 text-white fw-semibold" style="background: linear-gradient(135deg,#e11d48,#f43f5e); cursor:default;">
                Trimester 3 (Bulan 7–9)
            </span>
        </div>

        <!-- Main Card Container -->
        <div class="card custom-card bg-off-white shadow-soft rounded-2xl border-0 mb-4">
            <div class="card-body p-3 p-md-4 p-lg-5">

                <!-- ===== 5-Tab Horizontal Scrollable Pills ===== -->
                <ul class="nav nav-pills kia-tabs mb-4" id="kia-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="t3-janin-tab" data-bs-toggle="pill" data-bs-target="#t3-janin" type="button" role="tab" aria-selected="true">
                            <i class="bi bi-heart-pulse me-1 me-md-2"></i>Perkembangan Janin
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="t3-nutrisi-tab" data-bs-toggle="pill" data-bs-target="#t3-nutrisi" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-egg-fried me-1 me-md-2"></i>Nutrisi & Perawatan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="t3-persiapan-tab" data-bs-toggle="pill" data-bs-target="#t3-persiapan" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-bag-check me-1 me-md-2"></i>Persiapan Kelahiran
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="t3-bahaya-tab" data-bs-toggle="pill" data-bs-target="#t3-bahaya" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-exclamation-triangle me-1 me-md-2"></i>Tanda Bahaya & Jurnal
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 px-md-4 fw-semibold shadow-sm" id="t3-mental-tab" data-bs-toggle="pill" data-bs-target="#t3-mental" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-flower1 me-1 me-md-2"></i>Mental & Kelas KIA
                        </button>
                    </li>
                </ul>

                <!-- ===== Tabs Content ===== -->
                <div class="tab-content kia-tab-content mt-3" id="kia-tabs-content">

                    <!-- ============================================ -->
                    <!-- TAB 1: Perkembangan Janin                   -->
                    <!-- ============================================ -->
                    <div class="tab-pane fade show active" id="t3-janin" role="tabpanel" aria-labelledby="t3-janin-tab">

                        <!-- Banner Info Trimester 3 -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fff1f2, #ffe4e6);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:linear-gradient(135deg,#e11d48,#f43f5e);">
                                        <i class="bi bi-stars fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color:#be123c;">Memasuki Fase Akhir — Persiapkan Diri!</h5>
                                </div>
                                <p class="text-muted mb-2">Trimester 3 (Bulan 7–9) adalah fase terakhir sebelum kelahiran. Janin tumbuh pesat dan organ-organnya mematangkan fungsi. Ibu akan sering merasa <strong>lelah, sulit tidur, sering buang air kecil, dan kaki bengkak</strong> — ini normal.</p>
                                <div class="row g-2 mt-1">
                                    <div class="col-6 col-md-3">
                                        <div class="rounded-3 text-center p-2" style="background:rgba(225,29,72,0.08);">
                                            <div class="fw-bold" style="color:#be123c;font-size:1.1rem;">40–48 cm</div>
                                            <div class="text-muted small">Panjang Janin</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rounded-3 text-center p-2" style="background:rgba(225,29,72,0.08);">
                                            <div class="fw-bold" style="color:#be123c;font-size:1.1rem;">1,3–4 kg</div>
                                            <div class="text-muted small">Berat Janin</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rounded-3 text-center p-2" style="background:rgba(225,29,72,0.08);">
                                            <div class="fw-bold" style="color:#be123c;font-size:1.1rem;">+4–8 kg</div>
                                            <div class="text-muted small">Kenaikan BB Ibu</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="rounded-3 text-center p-2" style="background:rgba(225,29,72,0.08);">
                                            <div class="fw-bold" style="color:#be123c;font-size:1.1rem;">Bulan 7–9</div>
                                            <div class="text-muted small">Periode</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold text-dark mb-4">Ukuran Janin Anda (Bulan 7–9)</h5>

                        <!-- Grid Ukuran Janin -->
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🍈</div>
                                    <h6 class="fw-bold text-dark">Bulan 7</h6>
                                    <p class="text-muted small mb-2">Sebesar buah pepaya. Panjang sekitar 40 cm, berat ±1.300 gram.</p>
                                    <p class="text-muted small mb-0">Janin sudah bisa membuka dan menutup mata. Paru-paru mulai matang.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🥥</div>
                                    <h6 class="fw-bold text-dark">Bulan 8</h6>
                                    <p class="text-muted small mb-2">Sebesar kelapa. Panjang sekitar 45 cm, berat ±2.000 gram.</p>
                                    <p class="text-muted small mb-0">Janin mulai turun ke posisi kepala di bawah. Gerakan terasa lebih kuat.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4 hover-lift transition-all">
                                    <div class="bulan-emoji mb-3">🍉</div>
                                    <h6 class="fw-bold text-dark">Bulan 9</h6>
                                    <p class="text-muted small mb-2">Sebesar semangka. Panjang minimal 48 cm, berat 2.500–3.999 gram.</p>
                                    <p class="text-muted small mb-0">Janin siap lahir. Semua organ telah matang dan berfungsi penuh.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Perkembangan Otak -->
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bold text-dark mb-4">Perkembangan Otak Anak</h5>
                                <div class="row align-items-center justify-content-center g-4">
                                    <div class="col-sm-4">
                                        <div class="circular-progress" data-percentage="25"><span class="progress-value">25%</span></div>
                                        <div class="mt-3 fw-semibold">Saat Lahir</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="circular-progress" data-percentage="70"><span class="progress-value">70%</span></div>
                                        <div class="mt-3 fw-semibold">Usia 1 Tahun</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="circular-progress" data-percentage="85"><span class="progress-value">85%</span></div>
                                        <div class="mt-3 fw-semibold">Usia 3 Tahun</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 1 -->

                    <!-- ============================================ -->
                    <!-- TAB 2: Nutrisi & Perawatan                  -->
                    <!-- ============================================ -->
                    <div class="tab-pane fade" id="t3-nutrisi" role="tabpanel" aria-labelledby="t3-nutrisi-tab">

                        <!-- Alert Nutrisi -->
                        <div class="alert alert-warning alert-nutrisi border-warning border-start border-4 rounded-3 d-flex align-items-center mb-4 px-2 px-md-3 py-2 py-md-3">
                            <i class="bi bi-exclamation-circle-fill fs-3 text-warning me-3" style="color:#FFC107 !important;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Peringatan Nutrisi Trimester 3!</h6>
                                <p class="mb-0">Makan dengan porsi lebih kecil tapi sering <strong>(3x makan utama + 1–2x kudapan)</strong>. Hindari makanan berlemak tinggi yang dapat memperlambat pencernaan. Tetap minum air <strong>8–12 gelas/hari</strong>.</p>
                            </div>
                        </div>

                        <!-- Mitos vs Fakta -->
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-question-fill me-2" style="color:#e11d48;"></i>Mitos vs Fakta Kehamilan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <div class="alert mb-0 rounded-3 border-0 d-flex align-items-start gap-3 p-3" style="background:#fee2e2;">
                                    <div class="flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:36px;height:36px;min-width:36px;background:#DC3545;font-size:0.8rem;">MITOS</div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color:#991b1b;">Minyak &amp; makanan pedas mempercepat kelahiran</h6>
                                        <p class="mb-0 small text-muted">Banyak ibu hamil percaya mengonsumsi minyak kelapa atau makanan pedas dapat memicu persalinan lebih cepat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="alert mb-0 rounded-3 border-0 d-flex align-items-start gap-3 p-3" style="background:#dbeafe;">
                                    <div class="flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:36px;height:36px;min-width:36px;background:#0375C4;font-size:0.8rem;">FAKTA</div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color:#1e40af;">Mitos ini tidak terbukti secara medis</h6>
                                        <p class="mb-0 small text-muted">Tidak ada bukti ilmiah yang mendukung klaim tersebut. Yang terpenting adalah <strong>pola makan seimbang</strong> dan rutin memeriksakan kandungan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Porsi Makan Harian -->
                        <h5 class="fw-bold text-dark mb-3">Porsi Makan Harian yang Dianjurkan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🍚</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Nasi / Karbohidrat</h6>
                                    <span class="badge rounded-pill" style="background:#F0B429;color:#fff;">6 porsi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center bg-white p-3 h-100">
                                    <div class="porsi-icon" style="background:#FFF8E1;">
                                        <span style="font-size:2.5rem;line-height:1;">🥚🍗</span>
                                    </div>
                                    <h6 class="fw-bold" style="font-size:0.85rem;">Protein Hewani &amp; Nabati</h6>
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
                                                <td><div class="form-check d-flex justify-content-center"><input class="form-check-input custom-checkbox fs-4" type="checkbox"></div></td>
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
                            <div class="col-md-6"><div class="danger-card"><i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i><span class="fw-semibold">Minum obat tanpa resep dokter/bidan</span></div></div>
                            <div class="col-md-6"><div class="danger-card"><i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i><span class="fw-semibold">Bepergian jauh tanpa pendamping</span></div></div>
                            <div class="col-md-6"><div class="danger-card"><i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i><span class="fw-semibold">Aktivitas fisik berat / mengangkat beban</span></div></div>
                            <div class="col-md-6"><div class="danger-card"><i class="bi bi-x-circle-fill text-danger fs-4 me-3"></i><span class="fw-semibold">Stres berlebihan — jaga ketenangan pikiran</span></div></div>
                        </div>
                    </div>
                    <!-- END TAB 2 -->

                    <!-- ============================================ -->
                    <!-- TAB 3: Persiapan Kelahiran (TAB BARU)       -->
                    <!-- ============================================ -->
                    <div class="tab-pane fade" id="t3-persiapan" role="tabpanel" aria-labelledby="t3-persiapan-tab">

                        <!-- Banner Persiapan -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7);">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:linear-gradient(135deg,#16a34a,#22c55e);">
                                    <i class="bi bi-bag-check-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1" style="color:#15803d;">Checklist Persiapan Persalinan (P4K)</h5>
                                    <p class="text-muted mb-0 small">Centang setiap item yang sudah Anda siapkan. Pastikan semua selesai sebelum hari perkiraan lahir.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Checklist Interaktif -->
                        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                            <div class="card-body p-3 p-md-4">
                                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2"><i class="bi bi-list-check text-success me-2"></i>Daftar Persiapan Persalinan</h6>
                                <div class="d-flex flex-column gap-2">

                                    @php
                                    $checklistItems = [
                                        ['icon' => 'bi-calendar2-check', 'color' => '#0375C4', 'text' => 'Tanya tanggal perkiraan lahir ke bidan/dokter'],
                                        ['icon' => 'bi-people-fill',     'color' => '#16a34a', 'text' => 'Suami/keluarga mendampingi periksa dan melahirkan'],
                                        ['icon' => 'bi-piggy-bank-fill', 'color' => '#f59e0b', 'text' => 'Siapkan tabungan/dana cadangan biaya bersalin'],
                                        ['icon' => 'bi-shield-fill-check','color' => '#0ea5e9','text' => 'Memperoleh Kartu JKN/BPJS'],
                                        ['icon' => 'bi-hospital-fill',   'color' => '#e11d48', 'text' => 'Menentukan bidan/dokter/faskes untuk bersalin'],
                                        ['icon' => 'bi-bag-fill',        'color' => '#9333ea', 'text' => 'Siapkan KTP, KK, pakaian ibu &amp; bayi'],
                                        ['icon' => 'bi-droplet-fill',    'color' => '#DC3545', 'text' => 'Siapkan &gt;1 orang pendonor darah yang golongannya sama'],
                                        ['icon' => 'bi-car-front-fill',  'color' => '#0375C4', 'text' => 'Siapkan kendaraan siaga'],
                                        ['icon' => 'bi-house-fill',      'color' => '#16a34a', 'text' => 'Tempel stiker P4K di depan rumah'],
                                        ['icon' => 'bi-heart-fill',      'color' => '#e11d48', 'text' => 'Rencanakan metode KB pascasalin'],
                                    ];
                                    @endphp

                                    @foreach($checklistItems as $i => $item)
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-3 kia-switch-row" style="background:#f8fafc; border:1px solid #e2e8f0;">
                                        <div class="flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center text-white" style="width:36px;height:36px;min-width:36px;background:{{ $item['color'] }};">
                                            <i class="bi {{ $item['icon'] }}" style="font-size:0.9rem;"></i>
                                        </div>
                                        <label class="fw-semibold mb-0 flex-grow-1" for="t3_checklist_{{ $i }}" style="cursor:pointer;">{!! $item['text'] !!}</label>
                                        <div class="form-check m-0 flex-shrink-0">
                                            <input class="form-check-input custom-checkbox" type="checkbox" id="t3_checklist_{{ $i }}" style="width:1.4rem;height:1.4rem;cursor:pointer;">
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <!-- Edukasi IMD -->
                        <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #fdf4ff, #fae8ff);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:linear-gradient(135deg,#9333ea,#a855f7);">
                                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color:#7e22ce;">Inisiasi Menyusu Dini (IMD)</h5>
                                </div>
                                <p class="text-muted mb-3">Segera setelah lahir, letakkan bayi di dada ibu untuk <strong>kontak kulit ke kulit (skin-to-skin)</strong> minimal 1 jam. Biarkan bayi mencari dan menghisap puting sendiri.</p>
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <div class="rounded-3 p-3 text-center" style="background:rgba(147,51,234,0.08);">
                                            <i class="bi bi-droplet-half fs-3 mb-2 d-block" style="color:#9333ea;"></i>
                                            <div class="fw-semibold small" style="color:#7e22ce;">Kolostrum</div>
                                            <p class="text-muted mb-0" style="font-size:0.78rem;">ASI pertama kaya antibodi, melindungi bayi dari infeksi</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="rounded-3 p-3 text-center" style="background:rgba(147,51,234,0.08);">
                                            <i class="bi bi-thermometer-half fs-3 mb-2 d-block" style="color:#9333ea;"></i>
                                            <div class="fw-semibold small" style="color:#7e22ce;">Kehangatan</div>
                                            <p class="text-muted mb-0" style="font-size:0.78rem;">Kontak kulit menjaga suhu tubuh bayi tetap stabil</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="rounded-3 p-3 text-center" style="background:rgba(147,51,234,0.08);">
                                            <i class="bi bi-emoji-smile-fill fs-3 mb-2 d-block" style="color:#9333ea;"></i>
                                            <div class="fw-semibold small" style="color:#7e22ce;">Bonding</div>
                                            <p class="text-muted mb-0" style="font-size:0.78rem;">Mempererat ikatan emosional ibu dan bayi sejak dini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 3 -->

                    <!-- ============================================ -->
                    <!-- TAB 4: Tanda Bahaya & Jurnal                -->
                    <!-- ============================================ -->
                    <div class="tab-pane fade" id="t3-bahaya" role="tabpanel" aria-labelledby="t3-bahaya-tab">

                        <!-- Banner Alert Merah -->
                        <div class="alert-banner mb-4 rounded-4 shadow-sm text-center">
                            <i class="bi bi-exclamation-triangle-fill display-5 mb-2 d-block text-white"></i>
                            <h4 class="fw-bold mb-2 text-white">TANDA BAHAYA TRIMESTER 3!</h4>
                            <p class="mb-0 text-white-50 fs-6">Segera ke IGD Puskesmas/Rumah Sakit jika mengalami salah satu tanda di bawah ini. Jangan tunda!</p>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-3 p-md-4 p-lg-5">
                                <h5 class="fw-bold text-dark border-bottom pb-3 mb-4">
                                    <i class="bi bi-journal-medical text-primary me-2"></i>Formulir Jurnal Kesehatan Harian
                                </h5>

                                <form action="{{ route('pasien.buku-kia.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="from_buku_kia" value="1">
                                    <input type="hidden" name="trimester" value="3">

                                    <div class="mb-4">

                                        <!-- 1. Gerakan bayi kurang -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 rounded-3 kia-switch-row" style="background:#fff1f2; border:1px solid #fecdd3;">
                                            <label class="fw-semibold mb-0 me-3" for="t3_flag_0">
                                                <span class="badge me-2 rounded-pill text-white" style="background:#DC3545;font-size:0.68rem;vertical-align:middle;">CRITICAL</span>
                                                Gerakan bayi tidak ada / kurang dari 10 kali dalam 12 jam?
                                            </label>
                                            <div class="form-check form-switch m-0 flex-shrink-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_0" id="t3_flag_0" value="1">
                                            </div>
                                        </div>

                                        <!-- 2. Ketuban pecah tanpa kontraksi -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 rounded-3 kia-switch-row" style="background:#fff1f2; border:1px solid #fecdd3;">
                                            <label class="fw-semibold mb-0 me-3" for="t3_flag_1">
                                                <span class="badge me-2 rounded-pill text-white" style="background:#DC3545;font-size:0.68rem;vertical-align:middle;">CRITICAL</span>
                                                Ketuban pecah namun tidak ada kontraksi?
                                            </label>
                                            <div class="form-check form-switch m-0 flex-shrink-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_1" id="t3_flag_1" value="1">
                                            </div>
                                        </div>

                                        <!-- 3. Nyeri perut di antara kontraksi -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0 me-3" for="t3_flag_2">
                                                <span class="badge me-2 rounded-pill text-white" style="background:#f97316;font-size:0.68rem;vertical-align:middle;">BARU</span>
                                                Nyeri perut hebat di antara kontraksi?
                                            </label>
                                            <div class="form-check form-switch m-0 flex-shrink-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_2" id="t3_flag_2" value="1">
                                            </div>
                                        </div>

                                        <!-- 4. Perdarahan hebat -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 rounded-3 kia-switch-row" style="background:#fff1f2; border:1px solid #fecdd3;">
                                            <label class="fw-semibold mb-0 me-3" for="t3_flag_3">
                                                <span class="badge me-2 rounded-pill text-white" style="background:#DC3545;font-size:0.68rem;vertical-align:middle;">CRITICAL</span>
                                                Perdarahan hebat?
                                            </label>
                                            <div class="form-check form-switch m-0 flex-shrink-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_3" id="t3_flag_3" value="1">
                                            </div>
                                        </div>

                                        <!-- 5. Pusing / sakit kepala berat -->
                                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded-3 kia-switch-row">
                                            <label class="fw-semibold mb-0 me-3" for="t3_flag_4">Pusing / sakit kepala berat?</label>
                                            <div class="form-check form-switch m-0 flex-shrink-0">
                                                <input class="form-check-input toggle-switch" type="checkbox" name="flag_4" id="t3_flag_4" value="1">
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
                    <!-- END TAB 4 -->

                    <!-- ============================================ -->
                    <!-- TAB 5: Mental & Kelas KIA                   -->
                    <!-- ============================================ -->
                    <div class="tab-pane fade" id="t3-mental" role="tabpanel" aria-labelledby="t3-mental-tab">

                        <!-- Tanda Awal Persalinan -->
                        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fffbeb, #fef3c7);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;background:linear-gradient(135deg,#f59e0b,#fbbf24);">
                                        <i class="bi bi-bell-fill fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color:#92400e;">Kenali Tanda Awal Persalinan</h5>
                                </div>
                                <p class="text-muted mb-3">Segera hubungi bidan atau pergi ke faskes jika Anda mengalami salah satu tanda berikut:</p>
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex align-items-start gap-2 p-3 rounded-3" style="background:rgba(245,158,11,0.1);">
                                            <i class="bi bi-droplet-fill mt-1 flex-shrink-0" style="color:#f59e0b;"></i>
                                            <div>
                                                <div class="fw-semibold small" style="color:#92400e;">Lendir Bercampur Darah</div>
                                                <p class="text-muted mb-0" style="font-size:0.78rem;">Keluar cairan lendir kemerahan dari jalan lahir (bloody show)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex align-items-start gap-2 p-3 rounded-3" style="background:rgba(245,158,11,0.1);">
                                            <i class="bi bi-activity mt-1 flex-shrink-0" style="color:#f59e0b;"></i>
                                            <div>
                                                <div class="fw-semibold small" style="color:#92400e;">Mulas Teratur</div>
                                                <p class="text-muted mb-0" style="font-size:0.78rem;">Kontraksi makin sering, makin lama, dan makin kuat setiap 5–10 menit</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex align-items-start gap-2 p-3 rounded-3" style="background:rgba(245,158,11,0.1);">
                                            <i class="bi bi-water mt-1 flex-shrink-0" style="color:#f59e0b;"></i>
                                            <div>
                                                <div class="fw-semibold small" style="color:#92400e;">Ketuban Pecah</div>
                                                <p class="text-muted mb-0" style="font-size:0.78rem;">Cairan bening mengalir dari jalan lahir — segera ke faskes meski belum mulas</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tips Mental -->
                        <h5 class="fw-bold text-dark mb-4">Tips Menjaga Kesehatan Jiwa Menjelang Persalinan</h5>
                        <div class="row g-3 g-md-4 mb-5">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #f0fdf4;">
                                    <i class="bi bi-chat-dots-fill mb-3 fs-2 d-block" style="color:#16a34a;"></i>
                                    <h6 class="fw-bold text-dark">Ceritakan Rasa Takut Anda</h6>
                                    <p class="small text-muted mb-0">Wajar merasa cemas menjelang persalinan. Bicarakan dengan suami, keluarga, atau bidan agar beban terasa lebih ringan.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fce7f3;">
                                    <i class="bi bi-wind mb-3 fs-2 d-block" style="color:#db2777;"></i>
                                    <h6 class="fw-bold text-dark">Latihan Pernapasan Rutin</h6>
                                    <p class="small text-muted mb-0">Tarik napas dalam 4 hitungan, tahan 4 hitungan, hembuskan 6 hitungan. Lakukan 10 menit setiap pagi untuk menenangkan pikiran.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #eff6ff;">
                                    <i class="bi bi-book-fill mb-3 fs-2 d-block" style="color:#2563eb;"></i>
                                    <h6 class="fw-bold text-dark">Pelajari Proses Persalinan</h6>
                                    <p class="small text-muted mb-0">Pengetahuan mengurangi rasa takut. Tanyakan kepada bidan tentang tahapan persalinan agar Anda lebih siap dan percaya diri.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fef9c3;">
                                    <i class="bi bi-sun-fill mb-3 fs-2 d-block" style="color:#ca8a04;"></i>
                                    <h6 class="fw-bold text-dark">Jalan Santai Pagi Hari</h6>
                                    <p class="small text-muted mb-0">Olahraga ringan seperti jalan kaki 15–20 menit membantu posisi janin dan menjaga mood tetap positif.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #f3e8ff;">
                                    <i class="bi bi-moon-stars-fill mb-3 fs-2 d-block" style="color:#9333ea;"></i>
                                    <h6 class="fw-bold text-dark">Istirahat Berkualitas</h6>
                                    <p class="small text-muted mb-0">Tidur miring ke kiri dengan bantal di antara lutut. Simpan energi untuk proses persalinan yang membutuhkan stamina.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="pastel-card" style="background-color: #fee2e2;">
                                    <i class="bi bi-heart-fill mb-3 fs-2 d-block" style="color:#e11d48;"></i>
                                    <h6 class="fw-bold text-dark">Doa &amp; Dukungan Spiritual</h6>
                                    <p class="small text-muted mb-0">Ketenangan batin dari ibadah dan doa terbukti membantu ibu lebih rileks dan siap menghadapi persalinan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Absensi Kelas Ibu Hamil -->
                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-4">
                                    <i class="bi bi-card-checklist text-primary me-2"></i>Absensi Kelas Ibu Hamil — Trimester 3
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
                                                <td>Tanda Bahaya &amp; Persiapan Persalinan</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>-</td>
                                                <td>IMD, ASI Eksklusif &amp; Perawatan Bayi Baru Lahir</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>-</td>
                                                <td>KB Pascasalin &amp; Kesehatan Ibu Nifas</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>-</td>
                                                <td>Simulasi Persalinan Normal &amp; Senam Hamil</td>
                                                <td class="text-center"><span class="badge bg-light text-dark border">Belum Hadir</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 5 -->

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

        // Checklist progress feedback (opsional: highlight row saat dicentang)
        document.querySelectorAll('[id^="t3_checklist_"]').forEach(function (cb) {
            cb.addEventListener('change', function () {
                const row = this.closest('.d-flex');
                if (this.checked) {
                    row.style.background = '#f0fdf4';
                    row.style.borderColor = '#86efac';
                } else {
                    row.style.background = '#f8fafc';
                    row.style.borderColor = '#e2e8f0';
                }
            });
        });
    });
</script>
@endpush
