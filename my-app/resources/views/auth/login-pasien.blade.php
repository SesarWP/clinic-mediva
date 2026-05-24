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
            background: #FFF3F0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .back-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 32px;
            transition: color 0.2s;
            font-weight: 500;
        }
        .back-link:hover { color: #F76D6C; }

        .login-box {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 24px;
            padding: 48px 40px;
        }

        .login-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: #F76D6C;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .login-icon i { font-size: 1.75rem; color: white; }

        .login-box h2 {
            color: #111827;
            font-size: 1.75rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .login-box .login-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 36px;
            font-weight: 500;
        }

        .form-label {
            color: #374151;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            background: white;
            border: 2px solid #e5e7eb;
            color: #111827;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control::placeholder { color: #9ca3af; }
        .form-control:focus {
            background: white;
            border-color: #F76D6C;
            color: #111827;
            box-shadow: 0 0 0 4px rgba(247, 109, 108, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #F76D6C, #ff8f8e);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(247, 109, 108, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(247, 109, 108, 0.4);
            color: white;
        }

        .input-group-text {
            background: white;
            border: 2px solid #e5e7eb;
            border-right: none;
            color: #6b7280;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: #F76D6C;
        }

        .alert-danger {
            background: #fee2e2;
            border: 2px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .demo-info {
            background: #FFF3F0;
            border: 2px solid #F76D6C20;
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 24px;
            color: #6b7280;
            font-size: 0.85rem;
            text-align: center;
        }
        .demo-info strong {
            color: #F76D6C;
        }
        .demo-info code {
            color: #10606A;
            background: white;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="{{ route('login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert"
                 style="border-radius: 12px; border: 2px solid #fbbf24; background: #fffbeb; color: #92400e; font-size: 0.9rem; font-weight: 500; padding: 14px 16px;">
                <i class="bi bi-exclamation-triangle-fill me-2" style="color: #f59e0b;"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="login-box">
            <div class="login-icon">
                <i class="bi bi-person-heart"></i>
            </div>
            <h2>Login Pasien</h2>
            <p class="login-subtitle">Lihat riwayat pemeriksaan Anda</p>

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.pasien') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="pasien@mediva.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Masuk
                </button>
            </form>

            <div class="demo-info">
                <strong>Demo:</strong> <code>pasien@mediva.com</code> / <code>password123</code>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
