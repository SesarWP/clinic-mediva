<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pasien - Klinik Mediva Ngawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0c4a6e 0%, #164e63 50%, #0f766e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
        }
        .bg-shape:nth-child(1) { width: 500px; height: 500px; background: #06b6d4; top: -150px; right: -100px; }
        .bg-shape:nth-child(2) { width: 400px; height: 400px; background: #0ea5e9; bottom: -150px; left: -100px; }

        .login-container {
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .back-link {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 24px;
            transition: color 0.2s;
        }
        .back-link:hover { color: white; }

        .login-box {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 40px;
        }

        .login-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 12px 40px rgba(14, 165, 233, 0.3);
        }
        .login-icon i { font-size: 1.6rem; color: white; }

        .login-box h2 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 4px;
        }

        .login-box .login-subtitle {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 32px;
        }

        .form-label {
            color: rgba(255,255,255,0.7);
            font-weight: 500;
            font-size: 0.85rem;
        }

        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder { color: rgba(255,255,255,0.3); }
        .form-control:focus {
            background: rgba(255,255,255,0.12);
            border-color: #06b6d4;
            color: white;
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.2);
        }

        .btn-login {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
            color: white;
        }

        .input-group-text {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-right: none;
            color: rgba(255,255,255,0.5);
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #fca5a5;
            border-radius: 12px;
        }

        .demo-info {
            background: rgba(6, 182, 212, 0.1);
            border: 1px solid rgba(6, 182, 212, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 20px;
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
        }
        .demo-info code {
            color: #67e8f9;
            background: none;
        }
    </style>
</head>
<body>
    <div class="bg-shape"></div>
    <div class="bg-shape"></div>

    <div class="login-container">
        <a href="{{ route('home') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke halaman utama
        </a>

        <div class="login-box">
            <div class="login-icon">
                <i class="bi bi-person-heart"></i>
            </div>
            <h2>Login Pasien</h2>
            <p class="login-subtitle">Lihat riwayat pemeriksaan & screening anemia Anda</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.pasien') }}" method="POST" id="form-login-pasien">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="pasien@mediva.com" value="{{ old('email') }}" required autofocus id="email-pasien">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required id="password-pasien">
                    </div>
                </div>

                <button type="submit" class="btn btn-login" id="btn-login-pasien">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                </button>
            </form>

            <div class="demo-info">
                <strong>Demo:</strong> <code>pasien@mediva.com</code> / <code>password123</code>
            </div>
        </div>
    </div>
</body>
</html>
