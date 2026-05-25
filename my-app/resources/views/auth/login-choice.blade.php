<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Portal Login - Klinik Mediva Ngawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal:    #00A9BB;
            --teal-dk: #007d8c;
            --blue:    #0375C4;
        }

        body {
            min-height: 100vh;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
        }

        /* ===== Navbar ===== */
        .navbar-mediva {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand-text {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--teal-dk);
            text-decoration: none;
        }
        .navbar-brand-text span { color: var(--teal); }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: white;
            transition: all 0.2s ease;
        }
        .btn-back:hover { color: var(--teal-dk); border-color: var(--teal); background: #f0fdff; }

        /* ===== Main ===== */
        .main-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .main-container {
            text-align: center;
            max-width: 860px;
            width: 100%;
        }

        /* ===== Logo ===== */
        .logo-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--teal), var(--blue));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(0,169,187,0.25);
        }
        .logo-icon i { font-size: 2rem; color: white; }

        h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0b4d75;
            margin-bottom: 8px;
            letter-spacing: -0.03em;
        }
        .subtitle {
            color: #64748b;
            font-size: 0.98rem;
            margin-bottom: 48px;
            font-weight: 500;
        }

        /* ===== Cards ===== */
        .login-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        .login-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 24px;
            padding: 44px 32px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            transition: opacity 0.3s ease;
        }
        .login-card.bidan::before  { background: linear-gradient(90deg, var(--teal), var(--blue)); }
        .login-card.pasien::before { background: linear-gradient(90deg, #e11d48, #f43f5e); }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px rgba(0,0,0,0.09);
        }
        .login-card.bidan:hover  { border-color: var(--teal); }
        .login-card.pasien:hover { border-color: #e11d48; }

        .card-icon {
            width: 64px; height: 64px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.75rem;
        }
        .login-card.bidan  .card-icon { background: linear-gradient(135deg, var(--teal), var(--blue)); color: white; }
        .login-card.pasien .card-icon { background: linear-gradient(135deg, #e11d48, #f43f5e); color: white; }

        .login-card h3 {
            color: #0f172a;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }
        .login-card p {
            color: #64748b;
            font-size: 0.92rem;
            margin-bottom: 28px;
            line-height: 1.65;
        }
        .btn-enter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.92rem;
            border: none;
            color: white;
            transition: all 0.25s ease;
        }
        .login-card.bidan  .btn-enter { background: linear-gradient(135deg, var(--teal), var(--blue)); box-shadow: 0 4px 14px rgba(0,169,187,0.35); }
        .login-card.pasien .btn-enter { background: linear-gradient(135deg, #e11d48, #f43f5e); box-shadow: 0 4px 14px rgba(225,29,72,0.3); }
        .login-card:hover .btn-enter  { transform: translateX(4px); }

        .footer-text { color: #94a3b8; font-size: 0.85rem; font-weight: 500; }

        @media (max-width: 768px) {
            h1 { font-size: 1.75rem; }
            .login-card { padding: 32px 22px; }
            .login-cards { gap: 16px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar-mediva">
        <a href="{{ route('home') }}" class="navbar-brand-text">
            <i class="bi bi-heart-pulse-fill me-2" style="color:var(--teal);"></i>Klinik <span>Mediva</span>
        </a>
        <a href="{{ route('home') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </nav>

    <div class="main-wrap">
        <div class="main-container">

            <div class="logo-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <h1>Klinik Mediva Ngawi</h1>
            <p class="subtitle">Sistem Monitoring ANC &amp; Screening Anemia Ibu Hamil</p>

            @if(session('success'))
                <div class="alert alert-dismissible fade show text-start mb-4" role="alert"
                     style="border-radius:12px;border:2px solid #6ee7b7;background:#ecfdf5;color:#065f46;font-size:0.9rem;font-weight:500;padding:14px 16px;">
                    <i class="bi bi-check-circle-fill me-2" style="color:#10b981;"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-dismissible fade show text-start mb-4" role="alert"
                     style="border-radius:12px;border:2px solid #fbbf24;background:#fffbeb;color:#92400e;font-size:0.9rem;font-weight:500;padding:14px 16px;">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="color:#f59e0b;"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="login-cards">
                <a href="{{ route('login.bidan') }}" class="login-card bidan">
                    <div class="card-icon"><i class="bi bi-person-badge-fill"></i></div>
                    <h3>Login Bidan</h3>
                    <p>Akses dashboard bidan untuk mengelola data pasien, pemeriksaan ANC, dan screening anemia</p>
                    <span class="btn-enter">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk sebagai Bidan
                    </span>
                </a>
                <a href="{{ route('login.pasien') }}" class="login-card pasien">
                    <div class="card-icon"><i class="bi bi-person-heart"></i></div>
                    <h3>Login Pasien</h3>
                    <p>Lihat riwayat pemeriksaan, hasil screening anemia, dan jadwal kunjungan Anda</p>
                    <span class="btn-enter">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk sebagai Pasien
                    </span>
                </a>
            </div>

            <p class="footer-text">&copy; {{ date('Y') }} Klinik Mediva Ngawi — Sistem Informasi Antenatal Care</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
