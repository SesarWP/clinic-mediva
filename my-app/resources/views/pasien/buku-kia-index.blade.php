@extends('layouts.pasien')

@section('title', 'Buku KIA Interaktif - Klinik Mediva')
@section('page-title', 'Buku KIA Interaktif')

@section('extra-css')
<style>
    /* ===== Hero Banner ===== */
    .kia-hero {
        background: linear-gradient(135deg, #e0f7fa 0%, #e8f4fd 50%, #fce4ec 100%);
        border-radius: 24px;
        padding: 48px 40px;
        position: relative;
        overflow: hidden;
    }
    .kia-hero::before {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(3, 117, 196, 0.06);
        top: -80px; right: -80px;
    }
    .kia-hero::after {
        content: '';
        position: absolute;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(0, 169, 187, 0.07);
        bottom: -60px; left: -40px;
    }
    .kia-hero-emoji {
        font-size: 5rem;
        animation: float 3s ease-in-out infinite;
        display: inline-block;
        filter: drop-shadow(0 8px 16px rgba(0,0,0,0.12));
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-12px); }
    }

    /* ===== Fade-in-up animation ===== */
    .fade-in-up {
        opacity: 0;
        transform: translateY(24px);
        animation: fadeInUp 0.6s cubic-bezier(0.4,0,0.2,1) forwards;
    }
    .fade-in-up.delay-1 { animation-delay: 0.1s; }
    .fade-in-up.delay-2 { animation-delay: 0.2s; }
    .fade-in-up.delay-3 { animation-delay: 0.3s; }
    .fade-in-up.delay-4 { animation-delay: 0.4s; }
    .fade-in-up.delay-5 { animation-delay: 0.5s; }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== Trimester Nav Cards ===== */
    .trimester-card {
        border-radius: 20px;
        padding: 36px 28px;
        text-decoration: none;
        display: block;
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
    }
    .trimester-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 18px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .trimester-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 48px rgba(0,0,0,0.13);
    }
    .trimester-card .tc-emoji {
        font-size: 3rem;
        display: block;
        margin-bottom: 16px;
        transition: transform 0.3s ease;
    }
    .trimester-card:hover .tc-emoji { transform: scale(1.15); }
    .trimester-card .tc-arrow {
        transition: transform 0.3s ease;
    }
    .trimester-card:hover .tc-arrow { transform: translateX(6px); }

    /* ===== Layanan table ===== */
    .layanan-table th {
        background: #e8f4fd;
        color: #0b4d75;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
    }
    .layanan-table td { vertical-align: middle; font-size: 0.9rem; }
    .layanan-table .check-icon { color: #28A745; font-size: 1.1rem; }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">

        <!-- ================================================ -->
        <!-- SECTION 1: Hero Banner                          -->
        <!-- ================================================ -->
        <div class="kia-hero mb-4 fade-in-up">
            <div class="row align-items-center g-4">
                <div class="col-12 col-md-8">
                    <span class="badge rounded-pill text-white px-3 py-2 mb-3 d-inline-block" style="background:#0375C4;">
                        <i class="bi bi-book-heart me-1"></i> Buku KIA Digital
                    </span>
                    <h2 class="fw-bold mb-3" style="color:#0b4d75;letter-spacing:-0.02em;line-height:1.25;">
                        Perjalanan Menjadi<br>Seorang Ibu 🌸
                    </h2>
                    <p class="text-muted mb-4" style="font-size:1.05rem;max-width:520px;">
                        Selamat! Anda kini siap memasuki tahapan baru dalam kehidupan. Nikmati perjalanan menuju proses melahirkan dengan panduan dan tips di sini.
                    </p>
                    <a href="#trimester-nav" class="btn text-white fw-semibold px-4 py-2" style="background:linear-gradient(135deg,#0375C4,#00A9BB);border-radius:12px;box-shadow:0 4px 14px rgba(3,117,196,0.35);">
                        <i class="bi bi-arrow-down-circle me-2"></i>Mulai Perjalanan
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <span class="kia-hero-emoji">🤰</span>
                </div>
            </div>
        </div>

        <!-- ================================================ -->
        <!-- SECTION 2: Tentang Buku KIA                     -->
        <!-- ================================================ -->
        <div class="card border-0 rounded-4 mb-4 fade-in-up delay-1" style="border:2px solid #00A9BB !important;background:linear-gradient(135deg,#f0fdff,#e8f4fd);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width:48px;height:48px;background:linear-gradient(135deg,#00A9BB,#0375C4);">
                        <i class="bi bi-journal-medical fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color:#00A9BB;">Tentang Buku KIA</h5>
                </div>
                <p class="text-muted mb-3">Buku KIA membantu Ibu memantau kondisi kehamilan, kesehatan bayi, dan balita secara menyeluruh dari trimester pertama hingga anak berusia 5 tahun.</p>
                <div class="row g-2">
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-start gap-2 p-3 rounded-3 bg-white">
                            <i class="bi bi-book-fill mt-1 flex-shrink-0" style="color:#0375C4;"></i>
                            <span class="small fw-semibold">Baca dan pahami isi buku secara rutin setiap trimester.</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-start gap-2 p-3 rounded-3 bg-white">
                            <i class="bi bi-hospital-fill mt-1 flex-shrink-0" style="color:#00A9BB;"></i>
                            <span class="small fw-semibold">Datang ke posyandu, klinik, atau faskes secara teratur.</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-start gap-2 p-3 rounded-3 bg-white">
                            <i class="bi bi-people-fill mt-1 flex-shrink-0" style="color:#e11d48;"></i>
                            <span class="small fw-semibold">Suami/ayah turut mendukung dan mendampingi ibu.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================ -->
        <!-- SECTION 3: 1000 HPK (MIGRATED)                  -->
        <!-- ================================================ -->
        <div class="fade-in-up delay-2">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-stars me-2" style="color:#f59e0b;"></i>1000 Hari Pertama Kehidupan (HPK)</h5>

            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background:linear-gradient(135deg,#ffffff,#f8f9fa);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;">
                            <i class="bi bi-star-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-primary">Pentingnya 1000 Hari Pertama Kehidupan (HPK)</h5>
                    </div>
                    <p class="text-muted mb-0">Masa 1000 HPK dimulai sejak janin di dalam kandungan <strong>(270 hari)</strong> hingga anak berusia 2 tahun <strong>(730 hari)</strong>. Ini adalah masa emas <em>(golden period)</em> di mana otak dan fisik anak berkembang paling pesat. Nutrisi dan perawatan yang baik sangat penting untuk mencegah stunting dan memastikan masa depan cerah bagi si kecil.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold text-dark mb-4">Perkembangan Otak Anak</h5>
                    <div class="row align-items-center justify-content-center g-4">
                        <div class="col-sm-4">
                            <div class="circular-progress" data-percentage="25"><span class="progress-value">25%</span></div>
                            <div class="mt-3 fw-semibold">Saat Lahir</div>
                            <div class="text-muted small">Otak baru berkembang seperempat dari kapasitas penuh</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="circular-progress" data-percentage="70"><span class="progress-value">70%</span></div>
                            <div class="mt-3 fw-semibold">Usia 1 Tahun</div>
                            <div class="text-muted small">Tumbuh pesat — stimulasi dan gizi sangat krusial</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="circular-progress" data-percentage="85"><span class="progress-value">85%</span></div>
                            <div class="mt-3 fw-semibold">Usia 3 Tahun</div>
                            <div class="text-muted small">Hampir matang — fondasi kecerdasan seumur hidup</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================ -->
        <!-- SECTION 4: Panduan Umum Kehamilan               -->
        <!-- ================================================ -->
        <div class="fade-in-up delay-3">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-clipboard2-pulse-fill me-2" style="color:#0375C4;"></i>Panduan Umum Kehamilan</h5>

            <!-- Alert Kuning -->
            <div class="alert border-0 rounded-3 d-flex align-items-center gap-3 mb-4 p-3 p-md-4" style="background:#fffbeb;border-left:4px solid #f59e0b !important;border-left-style:solid !important;">
                <i class="bi bi-exclamation-circle-fill fs-2 flex-shrink-0" style="color:#f59e0b;"></i>
                <p class="mb-0 fw-bold" style="color:#92400e;font-size:1rem;">
                    Periksa paling sedikit <u>6 kali</u> oleh dokter atau bidan selama masa kehamilan.
                </p>
            </div>

            <!-- Tabel Layanan Kesehatan Gratis -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-shield-fill-check me-2" style="color:#28A745;"></i>Layanan Kesehatan yang Berhak Anda Dapatkan</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered layanan-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th>Jenis Layanan</th>
                                    <th width="15%" class="text-center">Tersedia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center text-muted">1</td>
                                    <td>Pemeriksaan kehamilan oleh tenaga kesehatan (bidan/dokter)</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">2</td>
                                    <td>Pemberian Tablet Tambah Darah (TTD) minimal 90 tablet selama kehamilan</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">3</td>
                                    <td>Pemeriksaan status gizi &amp; pengukuran tekanan darah</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">4</td>
                                    <td>Pemeriksaan laboratorium &amp; skrining kesehatan jiwa</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">5</td>
                                    <td>USG minimal 2 kali selama kehamilan (Trimester 1 &amp; Trimester 3)</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">6</td>
                                    <td>Imunisasi Tetanus Toksoid (TT) sesuai status imunisasi</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">7</td>
                                    <td>Kelas ibu hamil — edukasi kehamilan, persalinan, dan perawatan bayi</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill check-icon"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================ -->
        <!-- SECTION 5: Navigasi Trimester                   -->
        <!-- ================================================ -->
        <div id="trimester-nav" class="fade-in-up delay-4">
            <h5 class="fw-bold text-dark mb-1"><i class="bi bi-map me-2" style="color:#0375C4;"></i>Pilih Trimester Anda</h5>
            <p class="text-muted small mb-4">Klik kartu di bawah untuk membuka panduan lengkap sesuai usia kehamilan Anda.</p>

            <div class="row g-3 g-md-4 mb-4">

                <!-- Trimester 1 -->
                <div class="col-12 col-md-4">
                    <a href="{{ route('pasien.buku-kia') }}" class="trimester-card" style="background:linear-gradient(135deg,#e8f4fd,#dbeafe);border-color:#93c5fd;">
                        <span class="tc-emoji">🌱</span>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge rounded-pill text-white px-3 py-1 fw-semibold" style="background:#0375C4;">Bulan 1–3</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5 tc-arrow" style="color:#0375C4;"></i>
                        </div>
                        <h5 class="fw-bold mb-1" style="color:#1e40af;">Trimester 1</h5>
                        <p class="text-muted small mb-0">Awal kehamilan. Janin mulai terbentuk, ibu mungkin mengalami mual dan kelelahan.</p>
                    </a>
                </div>

                <!-- Trimester 2 -->
                <div class="col-12 col-md-4">
                    <a href="{{ route('pasien.buku-kia.trimester2') }}" class="trimester-card" style="background:linear-gradient(135deg,#e0fdfa,#ccfbf1);border-color:#5eead4;">
                        <span class="tc-emoji">🌿</span>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge rounded-pill text-white px-3 py-1 fw-semibold" style="background:#00A9BB;">Bulan 4–6</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5 tc-arrow" style="color:#00A9BB;"></i>
                        </div>
                        <h5 class="fw-bold mb-1" style="color:#0f766e;">Trimester 2</h5>
                        <p class="text-muted small mb-0">Fase paling nyaman. Mual mereda, energi meningkat, dan bayi mulai bergerak.</p>
                    </a>
                </div>

                <!-- Trimester 3 -->
                <div class="col-12 col-md-4">
                    <a href="{{ route('pasien.buku-kia.trimester3') }}" class="trimester-card" style="background:linear-gradient(135deg,#fff1f2,#ffe4e6);border-color:#fda4af;">
                        <span class="tc-emoji">🌸</span>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge rounded-pill text-white px-3 py-1 fw-semibold" style="background:linear-gradient(135deg,#e11d48,#f43f5e);">Bulan 7–9</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5 tc-arrow" style="color:#e11d48;"></i>
                        </div>
                        <h5 class="fw-bold mb-1" style="color:#be123c;">Trimester 3</h5>
                        <p class="text-muted small mb-0">Fase akhir. Persiapkan diri untuk persalinan dan sambut kehadiran si kecil.</p>
                    </a>
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

        // Smooth scroll for hero CTA
        document.querySelector('a[href="#trimester-nav"]')?.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('trimester-nav')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
</script>
@endpush
