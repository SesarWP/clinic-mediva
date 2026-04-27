<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Klinik Mediva Ngawi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0b5ed7;
            --accent: #6f42c1;
            --success: #198754;
            --warning: #ffc107;
            --danger: #dc3545;
            --sidebar-width: 260px;
            --header-height: 64px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1a1c2e 0%, #2d1b69 100%);
            color: white;
            z-index: 1040;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .sidebar-brand small {
            opacity: 0.7;
            font-size: 0.75rem;
        }

        .sidebar-nav {
            padding: 16px 12px;
        }

        .sidebar-nav .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.5;
            padding: 12px 16px 6px;
            font-weight: 600;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 10px 16px;
            border-radius: 10px;
            margin-bottom: 2px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-nav .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .sidebar-nav .nav-link.active {
            color: white;
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            box-shadow: 0 4px 15px rgba(111, 66, 193, 0.4);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Header */
        .top-header {
            background: white;
            height: var(--header-height);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .top-header .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-header .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* Content Area */
        .content-area {
            padding: 24px;
        }

        /* Stat Cards */
        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 24px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stat-card.primary::before { background: linear-gradient(90deg, #0d6efd, #6f42c1); }
        .stat-card.success::before { background: linear-gradient(90deg, #198754, #20c997); }
        .stat-card.warning::before { background: linear-gradient(90deg, #ffc107, #fd7e14); }
        .stat-card.danger::before { background: linear-gradient(90deg, #dc3545, #e85d04); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 500;
        }

        /* Cards */
        .custom-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .custom-card .card-header {
            background: white;
            border-bottom: 1px solid #f3f4f6;
            padding: 16px 24px;
            font-weight: 600;
        }

        .custom-card .card-body {
            padding: 24px;
        }

        /* Tables */
        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 12px 16px;
        }

        .table-modern tbody td {
            padding: 14px 16px;
            border-color: #f3f4f6;
            vertical-align: middle;
        }

        .table-modern tbody tr:hover {
            background: #f8f9fa;
        }

        /* Badges */
        .badge-risk {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn { border-radius: 10px; font-weight: 500; }
        .btn-sm { border-radius: 8px; }

        /* Mobile */
        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1035;
                display: none;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @yield('extra-css')
    </style>
    @stack('styles')
</head>
<body>
    @yield('body')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.querySelectorAll('.sidebar-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelector('.sidebar').classList.toggle('show');
                document.querySelector('.sidebar-overlay')?.classList.toggle('show');
            });
        });
        document.querySelector('.sidebar-overlay')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.remove('show');
            document.querySelector('.sidebar-overlay').classList.remove('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
