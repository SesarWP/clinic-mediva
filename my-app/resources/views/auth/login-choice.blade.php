<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Klinik Mediva Ngawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background circles */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.07;
            animation: float 20s infinite ease-in-out;
        }
        .bg-circle:nth-child(1) { width: 600px; height: 600px; background: #6f42c1; top: -200px; left: -100px; animation-delay: 0s; }
        .bg-circle:nth-child(2) { width: 400px; height: 400px; background: #0d6efd; bottom: -100px; right: -50px; animation-delay: -5s; }
        .bg-circle:nth-child(3) { width: 300px; height: 300px; background: #20c997; top: 50%; left: 60%; animation-delay: -10s; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.05); }
            50% { transform: translate(-20px, 20px) scale(0.95); }
            75% { transform: translate(10px, -10px) scale(1.02); }
        }

        .main-container {
            text-align: center;
            z-index: 10;
            padding: 20px;
            max-width: 800px;
            width: 100%;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 20px 60px rgba(111, 66, 193, 0.4);
            animation: pulse-glow 3s infinite ease-in-out;
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 20px 60px rgba(111, 66, 193, 0.4); }
            50% { box-shadow: 0 20px 80px rgba(111, 66, 193, 0.6); }
        }

        .logo-icon i { font-size: 2.2rem; color: white; }

        h1 {
            font-size: 2.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: rgba(255,255,255,0.6);
            font-size: 1.1rem;
            margin-bottom: 48px;
            font-weight: 400;
        }

        .login-cards {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .login-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 40px 36px;
            width: 320px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: block;
        }

        .login-card:hover {
            transform: translateY(-12px);
            background: rgba(255,255,255,0.14);
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }

        .login-card .card-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
        }

        .login-card.bidan .card-icon {
            background: linear-gradient(135deg, #6f42c1, #a855f7);
            box-shadow: 0 8px 30px rgba(111, 66, 193, 0.3);
        }

        .login-card.pasien .card-icon {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            box-shadow: 0 8px 30px rgba(14, 165, 233, 0.3);
        }

        .login-card .card-icon i { color: white; }

        .login-card h3 {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-card p {
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .login-card .btn-enter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s ease;
        }

        .login-card.bidan .btn-enter {
            background: linear-gradient(135deg, #6f42c1, #a855f7);
            color: white;
        }

        .login-card.pasien .btn-enter {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
        }

        .login-card:hover .btn-enter {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .footer-text {
            margin-top: 48px;
            color: rgba(255,255,255,0.3);
            font-size: 0.8rem;
        }

        @media (max-width: 576px) {
            h1 { font-size: 1.8rem; }
            .login-card { width: 100%; padding: 30px 24px; }
        }
    </style>
</head>
<body>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>

    <div class="main-container">
        <div class="logo-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <h1>Klinik Mediva Ngawi</h1>
        <p class="subtitle">Sistem Monitoring ANC & Screening Anemia Ibu Hamil</p>

        <div class="login-cards">
            <a href="{{ route('login.bidan') }}" class="login-card bidan" id="login-bidan-card">
                <div class="card-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <h3>Login Bidan</h3>
                <p>Akses dashboard bidan untuk mengelola data pasien, pemeriksaan ANC, dan screening anemia.</p>
                <span class="btn-enter">
                    Masuk sebagai Bidan <i class="bi bi-arrow-right"></i>
                </span>
            </a>

            <a href="{{ route('login.pasien') }}" class="login-card pasien" id="login-pasien-card">
                <div class="card-icon">
                    <i class="bi bi-person-heart"></i>
                </div>
                <h3>Login Pasien</h3>
                <p>Lihat riwayat pemeriksaan, hasil screening anemia, dan jadwal kunjungan Anda.</p>
                <span class="btn-enter">
                    Masuk sebagai Pasien <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>

        <p class="footer-text">&copy; {{ date('Y') }} Klinik Mediva Ngawi — Sistem Informasi Antenatal Care</p>
    </div>
</body>
</html>
