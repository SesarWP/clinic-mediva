<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bidan - Klinik Mediva Ngawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal:    #00A9BB;
            --teal-dk: #007d8c;
            --blue:    #0375C4;
            --accent:  #00A9BB;
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
        .login-container { width: 100%; max-width: 440px; }

        /* ===== Box ===== */
        .login-box {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05);
        }
        .login-icon {
            width: 64px; height: 64px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--teal), var(--blue));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 16px rgba(0,169,187,0.3);
        }
        .login-icon i { font-size: 1.75rem; color: white; }

        .login-box h2 {
            color: #0f172a;
            font-size: 1.75rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }
        .login-subtitle {
            color: #64748b;
            font-size: 0.92rem;
            text-align: center;
            margin-bottom: 32px;
            font-weight: 500;
        }

        /* ===== Form ===== */
        .form-label { color: #374151; font-weight: 600; font-size: 0.88rem; margin-bottom: 7px; }
        .form-control {
            background: white;
            border: 1.5px solid #e2e8f0;
            color: #0f172a;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.93rem;
            transition: all 0.2s ease;
        }
        .form-control::placeholder { color: #94a3b8; }
        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(0,169,187,0.12);
            background: white;
            color: #0f172a;
        }
        .input-group-text {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        .input-group:focus-within .input-group-text { border-color: var(--teal); }

        /* ===== Button ===== */
        .btn-login {
            background: linear-gradient(135deg, var(--teal), var(--blue));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(0,169,187,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,169,187,0.45);
            color: white;
        }

        /* ===== Alerts ===== */
        .alert-danger {
            background: #fee2e2;
            border: 1.5px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.88rem;
        }

        /* ===== Demo info ===== */
        .demo-info {
            background: #f0fdff;
            border: 1.5px solid rgba(0,169,187,0.2);
            border-radius: 12px;
            padding: 13px 16px;
            margin-top: 20px;
            color: #64748b;
            font-size: 0.83rem;
            text-align: center;
        }
        .demo-info strong { color: var(--teal-dk); }
        .demo-info code {
            color: var(--blue);
            background: white;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar-mediva">
        <a href="{{ route('home') }}" class="navbar-brand-text">
            <i class="bi bi-heart-pulse-fill me-2" style="color:var(--teal);"></i>Klinik <span>Mediva</span>
        </a>
        <a href="{{ route('login') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Pilih Portal
        </a>
    </nav>

    <div class="main-wrap">
        <div class="login-container">

            @if(session('warning'))
                <div class="alert alert-dismissible fade show mb-4" role="alert"
                     style="border-radius:12px;border:1.5px solid #fbbf24;background:#fffbeb;color:#92400e;font-size:0.88rem;font-weight:500;padding:13px 16px;">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="color:#f59e0b;"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="login-box">
                <div class="login-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <h2>Login Bidan</h2>
                <p class="login-subtitle">Masuk ke dashboard bidan</p>

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.bidan') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="bidan@mediva.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk sebagai Bidan
                    </button>
                </form>

                <div class="demo-info">
                    <strong>Demo:</strong> <code>bidan@mediva.com</code> / <code>password123</code>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
