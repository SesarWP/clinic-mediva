<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Mediva Ngawi — Sistem Pemantauan Kesehatan Ibu Hamil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        :root {
            --teal:    #00A9BB;
            --teal-dk: #007d8c;
            --cyan:    #06b6d4;
            --blue:    #0375C4;
        }

        body { background: #f8fafc; color: #1e293b; }

        /* ===== Navbar ===== */
        .navbar-mediva {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 0;
        }
        .navbar-brand-text {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--teal-dk);
        }
        .navbar-brand-text span { color: var(--teal); }

        /* ===== Hero ===== */
        .hero-section {
            background: linear-gradient(135deg, #e0f7fa 0%, #e8f4fd 55%, #fce4ec 100%);
            padding: 96px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: rgba(0,169,187,0.07);
            top: -120px; right: -120px;
            pointer-events: none;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(3,117,196,0.06);
            bottom: -80px; left: -60px;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(0,169,187,0.12);
            color: var(--teal-dk);
            border: 1px solid rgba(0,169,187,0.3);
            border-radius: 999px;
            padding: 6px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.03em;
            color: #0b4d75;
        }
        .hero-title span { color: var(--teal); }
        .hero-subtitle {
            font-size: 1.05rem;
            color: #475569;
            line-height: 1.7;
            max-width: 520px;
        }
        .hero-emoji-wrap {
            width: 220px; height: 220px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0,169,187,0.15), rgba(3,117,196,0.12));
            border: 3px solid rgba(0,169,187,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            animation: float 3.5s ease-in-out infinite;
            box-shadow: 0 16px 48px rgba(0,169,187,0.18);
        }
        .hero-emoji-wrap span { font-size: 6rem; line-height: 1; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-14px); }
        }

        /* ===== Buttons ===== */
        .btn-teal {
            background: linear-gradient(135deg, var(--teal), var(--blue));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 4px 16px rgba(0,169,187,0.35);
            transition: all 0.25s ease;
        }
        .btn-teal:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,169,187,0.45);
            color: white;
        }
        .btn-outline-teal {
            background: transparent;
            color: var(--teal-dk);
            border: 2px solid var(--teal);
            border-radius: 12px;
            padding: 11px 26px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }
        .btn-outline-teal:hover {
            background: var(--teal);
            color: white;
            transform: translateY(-2px);
        }

        /* ===== Features ===== */
        .features-section { padding: 80px 0; background: #fff; }
        .section-label {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--teal);
            margin-bottom: 10px;
        }
        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #0b4d75;
        }
        .feature-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: 36px 28px;
            background: #fff;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--blue));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.08);
            border-color: rgba(0,169,187,0.3);
        }
        .feature-card:hover::before { opacity: 1; }
        .feature-emoji {
            font-size: 3rem;
            line-height: 1;
            margin-bottom: 20px;
            display: block;
        }
        .feature-card h5 {
            font-weight: 700;
            font-size: 1.1rem;
            color: #0b4d75;
            margin-bottom: 10px;
        }
        .feature-card p {
            color: #64748b;
            font-size: 0.92rem;
            line-height: 1.65;
            margin: 0;
        }

        /* ===== Stats strip ===== */
        .stats-strip {
            background: linear-gradient(135deg, var(--teal-dk), var(--blue));
            padding: 48px 0;
            color: white;
        }
        .stat-item .stat-num {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .stat-item .stat-lbl {
            font-size: 0.88rem;
            opacity: 0.8;
            font-weight: 500;
        }

        /* ===== Footer ===== */
        .footer-mediva {
            background: #0b4d75;
            color: rgba(255,255,255,0.7);
            padding: 28px 0;
            font-size: 0.88rem;
        }
        .footer-mediva a { color: rgba(255,255,255,0.85); text-decoration: none; }
        .footer-mediva a:hover { color: white; }

        /* ===== Fade-in-up ===== */
        .fiu { opacity: 0; transform: translateY(20px); animation: fiu 0.6s ease forwards; }
        .fiu.d1 { animation-delay: 0.1s; }
        .fiu.d2 { animation-delay: 0.2s; }
        .fiu.d3 { animation-delay: 0.3s; }
        @keyframes fiu { to { opacity:1; transform:translateY(0); } }

        @media (max-width: 768px) {
            .hero-section { padding: 64px 0 56px; }
            .hero-emoji-wrap { width: 160px; height: 160px; }
            .hero-emoji-wrap span { font-size: 4.5rem; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-mediva sticky-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand-text text-decoration-none" href="{{ route('home') }}">
                <i class="bi bi-heart-pulse-fill me-2" style="color:var(--teal);"></i>Klinik <span>Mediva</span>
            </a>

            <!-- Hamburger toggler (mobile only) -->
            <button class="navbar-toggler border-0 shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMain"
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation"
                    style="padding:8px 12px;border-radius:10px;background:#f1f5f9;">
                <i class="bi bi-list" style="font-size:1.5rem;color:var(--teal);"></i>
            </button>

            <!-- Collapsible nav items -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 ms-auto mt-3 mt-lg-0 pb-3 pb-lg-0">
                    @auth
                        <a href="{{ Auth::user()->role === 'bidan' ? route('bidan.dashboard') : route('pasien.dashboard') }}"
                           class="btn btn-teal btn-sm px-4 text-center">
                            <i class="bi bi-grid-1x2-fill me-1"></i> Dashboard Saya
                        </a>
                    @else
                        <a href="https://wa.me/6285732324231?text=Halo%20Klinik%20Mediva%2C%20saya%20ingin%20bertanya%20mengenai%20layanan%20kesehatan%20ibu%20hamil."
                           target="_blank" rel="noopener noreferrer"
                           class="btn btn-sm px-3 fw-semibold d-inline-flex align-items-center justify-content-center gap-2"
                           style="background:#25D366;color:white;border-radius:10px;border:none;box-shadow:0 3px 10px rgba(37,211,102,0.35);transition:all 0.2s ease;"
                           onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 16px rgba(37,211,102,0.45)';"
                           onmouseout="this.style.transform='';this.style.boxShadow='0 3px 10px rgba(37,211,102,0.35)';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                            </svg>
                            Hubungi CS
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-teal btn-sm px-3 fw-semibold text-center">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-teal btn-sm px-3 fw-semibold text-center">
                            <i class="bi bi-person-plus-fill me-1"></i> Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-12 col-lg-7 text-center text-lg-start">
                    <div class="hero-badge fiu d-inline-flex">
                        <i class="bi bi-shield-fill-check"></i> Sistem Informasi Kesehatan Ibu Hamil
                    </div>
                    <h1 class="hero-title mb-4 fiu d1 fs-2 fs-lg-1">
                        Sistem Pemantauan Terpadu<br><span>Kesehatan Ibu Hamil</span>
                    </h1>
                    <p class="hero-subtitle mb-4 mb-lg-5 fiu d2 mx-auto mx-lg-0">
                        Klinik Mediva Ngawi hadir mendampingi kehamilan Anda melalui pemantauan ANC, screening anemia, dan Buku KIA Interaktif yang mudah diakses kapan saja.
                    </p>
                    <div class="fiu d3">
                        @auth
                            <a href="{{ Auth::user()->role === 'bidan' ? route('bidan.dashboard') : route('pasien.dashboard') }}"
                               class="btn btn-teal d-block d-lg-inline-block w-100 w-lg-auto">
                                <i class="bi bi-grid-1x2-fill me-2"></i>Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="btn btn-teal d-block d-lg-inline-flex w-100 mb-3 mb-lg-0"
                               style="width:auto!important;margin-right:12px;">
                                <i class="bi bi-arrow-right-circle me-2"></i>Mulai Sekarang
                            </a>
                            <a href="{{ route('register') }}"
                               class="btn btn-outline-teal d-block d-lg-inline-flex w-100 mb-3 mb-lg-0"
                               style="width:auto!important;margin-right:12px;">
                                Daftar Akun
                            </a>
                            <a href="#fitur"
                               class="btn btn-link text-decoration-none d-block d-lg-inline-flex w-100"
                               style="width:auto!important;color:#64748b;font-weight:600;">
                                Pelajari Lebih Lanjut
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-12 col-lg-5 text-center fiu d2 mt-5 mt-lg-0">
                    <div class="hero-emoji-wrap mx-auto">
                        <span>🤰</span>
                    </div>
                    <div class="mt-4 d-flex justify-content-center gap-4">
                        <div class="text-center">
                            <div class="fw-bold" style="font-size:1.4rem;color:#0b4d75;">ANC</div>
                            <div class="text-muted small">Pemeriksaan</div>
                        </div>
                        <div style="width:1px;background:#cbd5e1;"></div>
                        <div class="text-center">
                            <div class="fw-bold" style="font-size:1.4rem;color:#0b4d75;">HB</div>
                            <div class="text-muted small">Screening</div>
                        </div>
                        <div style="width:1px;background:#cbd5e1;"></div>
                        <div class="text-center">
                            <div class="fw-bold" style="font-size:1.4rem;color:#0b4d75;">KIA</div>
                            <div class="text-muted small">Buku Digital</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATS STRIP ===== -->
    <div class="stats-strip">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-num">6x</div>
                    <div class="stat-lbl">Minimal Periksa Kehamilan</div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-num">1000</div>
                    <div class="stat-lbl">Hari Pertama Kehidupan</div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-num">90</div>
                    <div class="stat-lbl">Tablet TTD Selama Hamil</div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-num">3</div>
                    <div class="stat-lbl">Trimester Terpantau</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FEATURES ===== -->
    <section class="features-section" id="fitur">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Layanan Digital</div>
                <h2 class="section-title">Layanan Unggulan Kami</h2>
                <p class="text-muted mt-2" style="max-width:520px;margin:0 auto;font-size:0.95rem;">
                    Semua kebutuhan pemantauan kehamilan tersedia dalam satu platform yang mudah digunakan.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-4 fiu">
                    <div class="feature-card">
                        <span class="feature-emoji">🩺</span>
                        <h5>Pemeriksaan ANC</h5>
                        <p>Rekam medis kebidanan digital yang akurat. Pantau tekanan darah, berat badan, tinggi fundus, dan DJJ secara terstruktur setiap kunjungan.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 fiu d1">
                    <div class="feature-card">
                        <span class="feature-emoji">🩸</span>
                        <h5>Screening Anemia</h5>
                        <p>Deteksi dini dan pemantauan kadar Hb ibu hamil. Sistem otomatis mengklasifikasikan status anemia dan merekomendasikan tindakan yang tepat.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 fiu d2">
                    <div class="feature-card">
                        <span class="feature-emoji">📖</span>
                        <h5>Buku KIA Interaktif</h5>
                        <p>Akses edukasi 1000 HPK, panduan nutrisi per trimester, dan catatan kesehatan mandiri langsung dari genggaman tangan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    @guest
    <section style="background:linear-gradient(135deg,#e0f7fa,#e8f4fd);padding:72px 0;">
        <div class="container text-center">
            <h2 class="fw-bold mb-3" style="color:#0b4d75;font-size:clamp(1.5rem,3vw,2rem);letter-spacing:-0.02em;">
                Siap Memulai Perjalanan Kehamilan Anda?
            </h2>
            <p class="text-muted mb-4" style="max-width:480px;margin:0 auto 24px;">
                Bergabunglah dengan pasien Klinik Mediva Ngawi dan nikmati kemudahan pemantauan kehamilan secara digital.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('login') }}" class="btn btn-outline-teal px-4 py-3" style="font-size:1rem; border-width: 2px;">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Portal
                </a>
                <a href="{{ route('register') }}" class="btn btn-teal px-4 py-3" style="font-size:1rem;">
                    <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </section>
    @endguest

    <!-- ===== FOOTER ===== -->
    <footer class="footer-mediva">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <span class="fw-bold text-white">
                        <i class="bi bi-heart-pulse-fill me-1" style="color:var(--teal);"></i>Klinik Mediva Ngawi
                    </span>
                    <span class="ms-2">&copy; {{ date('Y') }} — Sistem Informasi Antenatal Care</span>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('login') }}">Masuk Portal</a>
                    <a href="https://wa.me/6285732324231?text=Halo%20Klinik%20Mediva%2C%20saya%20ingin%20bertanya%20mengenai%20layanan%20kesehatan%20ibu%20hamil."
                       target="_blank" rel="noopener noreferrer"
                       style="color:rgba(255,255,255,0.85);text-decoration:none;">
                        <i class="bi bi-whatsapp me-1"></i>Hubungi CS
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
