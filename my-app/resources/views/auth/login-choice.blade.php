<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Klinik Mediva Ngawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            min-height: 100vh;
            background: #FFF3F0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .main-container {
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        .logo-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, #10606A, #147a87);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 8px 24px rgba(16, 96, 106, 0.2);
        }

        .logo-icon i { 
            font-size: 2rem; 
            color: white; 
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #10606A;
            margin-bottom: 8px;
            letter-spacing: -0.03em;
        }

        .subtitle {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 56px;
            font-weight: 500;
        }

        .login-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }

        .login-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 24px;
            padding: 48px 32px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            transition: all 0.3s ease;
        }

        .login-card.bidan::before {
            background: linear-gradient(90deg, #10606A, #147a87);
        }

        .login-card.pasien::before {
            background: linear-gradient(90deg, #F76D6C, #ff8f8e);
        }

        .login-card:hover {
            transform: translateY(-8px);
            border-color: transparent;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .login-card.bidan:hover {
            border-color: #10606A;
        }

        .login-card.pasien:hover {
            border-color: #F76D6C;
        }

        .login-card .card-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 1.75rem;
        }

        .login-card.bidan .card-icon {
            background: #10606A;
            color: white;
        }

        .login-card.pasien .card-icon {
            background: #F76D6C;
            color: white;
        }

        .login-card h3 {
            color: #111827;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .login-card p {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .login-card .btn-enter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            transition: all 0.3s ease;
            color: white;
        }

        .login-card.bidan .btn-enter {
            background: linear-gradient(135deg, #10606A, #147a87);
            box-shadow: 0 4px 12px rgba(16, 96, 106, 0.3);
        }

        .login-card.pasien .btn-enter {
            background: linear-gradient(135deg, #F76D6C, #ff8f8e);
            box-shadow: 0 4px 12px rgba(247, 109, 108, 0.3);
        }

        .login-card:hover .btn-enter {
            transform: translateX(4px);
        }

        .footer-text {
            color: #9ca3af;
            font-size: 0.875rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            h1 { font-size: 2rem; }
            .subtitle { font-size: 0.9rem; margin-bottom: 40px; }
            .login-card { padding: 36px 24px; }
            .login-cards { gap: 16px; }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="logo-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <h1>Klinik Mediva Ngawi</h1>
        <p class="subtitle">Sistem Monitoring ANC & Screening Anemia Ibu Hamil</p>

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show text-start mb-4" role="alert" style="border-radius: 12px; font-weight: 500;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="login-cards">
            <a href="{{ route('login.bidan') }}" class="login-card bidan">
                <div class="card-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <h3>Login Bidan</h3>
                <p>Akses dashboard bidan untuk mengelola data pasien, pemeriksaan ANC, dan screening anemia</p>
                <span class="btn-enter">
                    Masuk sebagai Bidan <i class="bi bi-arrow-right"></i>
                </span>
            </a>

            <a href="{{ route('login.pasien') }}" class="login-card pasien">
                <div class="card-icon">
                    <i class="bi bi-person-heart"></i>
                </div>
                <h3>Login Pasien</h3>
                <p>Lihat riwayat pemeriksaan, hasil screening anemia, dan jadwal kunjungan Anda</p>
                <span class="btn-enter">
                    Masuk sebagai Pasien <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>

        <p class="footer-text">&copy; {{ date('Y') }} Klinik Mediva Ngawi — Sistem Informasi Antenatal Care</p>
    </div>
</body>
</html>
