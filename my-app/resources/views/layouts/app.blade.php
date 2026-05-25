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
            --primary: #10606A;
            --primary-dark: #0d4d56;
            --primary-light: #147a87;
            --accent: #F76D6C;
            --accent-light: #FFF3F0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --sidebar-width: 280px;
            --header-height: 70px;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --navy-900: #1e293b;
            --navy-800: #334155;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background: var(--gray-50);
            min-height: 100vh;
            color: var(--gray-900);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #10606A 0%, #0d4d56 100%);
            color: white;
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.12);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-brand {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand h4 {
            font-weight: 700;
            font-size: 1.15rem;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .sidebar-brand small {
            opacity: 0.6;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 20px 16px;
        }

        .sidebar-nav .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            opacity: 0.4;
            padding: 16px 12px 8px;
            font-weight: 700;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 4px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.08);
            transform: translateX(2px);
        }

        .sidebar-nav .nav-link.active {
            color: white;
            background: linear-gradient(135deg, #F76D6C, #ff8f8e);
            box-shadow: 0 4px 16px rgba(247, 109, 108, 0.4);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--gray-50);
        }

        /* Header */
        .top-header {
            background: white;
            height: var(--header-height);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            gap: 8px;
        }

        .top-header h5 {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--gray-900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .top-header .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-header .user-info > div:first-child {
            text-align: right;
        }

        .top-header .user-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }

        @media (max-width: 576px) {
            .top-header {
                padding: 0 14px;
                height: 60px;
            }
            .top-header h5 {
                font-size: 0.92rem;
            }
        }

        /* Content Area */
        .content-area {
            padding: 32px;
            max-width: 1600px;
        }

        /* Stat Cards */
        .stat-card {
            border: none;
            border-radius: 20px;
            padding: 28px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--gray-100);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card.primary::before { background: linear-gradient(90deg, #10606A, #147a87); }
        .stat-card.success::before { background: linear-gradient(90deg, #10b981, #14b8a6); }
        .stat-card.warning::before { background: linear-gradient(90deg, #f59e0b, #f97316); }
        .stat-card.danger::before { background: linear-gradient(90deg, #F76D6C, #ff8f8e); }
        .stat-card.info::before { background: linear-gradient(90deg, #06b6d4, #0ea5e9); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
            border-color: var(--gray-200);
        }

        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-card .stat-number {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .stat-card .stat-label {
            font-size: 0.875rem;
            color: var(--gray-500);
            font-weight: 600;
            margin-top: 4px;
        }

        /* Cards */
        .custom-card {
            border: 1px solid var(--gray-200);
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
            background: white;
        }

        .custom-card .card-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 20px 28px;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--gray-900);
            letter-spacing: -0.01em;
        }

        .custom-card .card-body {
            padding: 28px;
        }

        /* Tables */
        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: var(--gray-50);
            border: none;
            border-bottom: 2px solid var(--gray-200);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--gray-600);
            padding: 14px 18px;
        }

        .table-modern tbody td {
            padding: 16px 18px;
            border-color: var(--gray-100);
            vertical-align: middle;
            color: var(--gray-700);
        }

        .table-modern tbody tr {
            transition: background 0.15s ease;
        }

        .table-modern tbody tr:hover {
            background: var(--gray-50);
        }

        /* Badges */
        .badge-risk {
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        /* Buttons */
        .btn { 
            border-radius: 12px; 
            font-weight: 600; 
            padding: 10px 20px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }
        
        .btn-sm { 
            border-radius: 10px; 
            padding: 8px 16px;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10606A, #147a87);
            box-shadow: 0 4px 12px rgba(16, 96, 106, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0d4d56, #10606A);
            box-shadow: 0 6px 16px rgba(16, 96, 106, 0.4);
            transform: translateY(-1px);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #14b8a6);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #F76D6C, #ff8f8e);
            box-shadow: 0 4px 12px rgba(247, 109, 108, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #10606A;
            color: #10606A;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: #10606A;
            color: white;
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid var(--gray-300);
            padding: 11px 16px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #10606A;
            box-shadow: 0 0 0 4px rgba(16, 96, 106, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        /* Alerts */
        .alert {
            border-radius: 16px;
            border: none;
            padding: 16px 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

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
                background: rgba(0,0,0,0.6);
                z-index: 1035;
                display: none;
                backdrop-filter: blur(4px);
            }
            .sidebar-overlay.show {
                display: block;
            }
            .content-area {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .content-area {
                padding: 14px;
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* Buku KIA Custom Styles */
        .bg-off-white { background-color: #f4f7f6; }
        .rounded-2xl { border-radius: 1rem; }
        .shadow-soft { box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important; }
        .transition-all { transition: all 0.3s ease; }

        /* ===== KIA Tabs - Horizontal Scrollable ===== */
        .kia-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            gap: 8px;
            padding-bottom: 8px !important;
        }
        /* Hide scrollbar across browsers */
        .kia-tabs::-webkit-scrollbar { display: none; }
        .kia-tabs { -ms-overflow-style: none; scrollbar-width: none; }

        .kia-tabs .nav-item {
            flex: 0 0 auto;
        }
        .kia-tabs .nav-link {
            color: #6c757d;
            background: #fff;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-size: 0.9rem;
        }
        .kia-tabs .nav-link:hover {
            color: #0375C4;
            border-color: #0375C4;
        }
        .kia-tabs .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #0375C4, #0ea5e9);
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(3, 117, 196, 0.4) !important;
        }

        @media (max-width: 768px) {
            .kia-tabs .nav-link {
                padding: 8px 16px !important;
                font-size: 0.8rem;
            }
            .kia-tabs .nav-link i {
                font-size: 0.85rem;
            }
        }

        /* ===== Circular Progress ===== */
        .circular-progress {
            position: relative;
            height: 100px;
            width: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        .circular-progress::before {
            content: "";
            position: absolute;
            height: 84px;
            width: 84px;
            border-radius: 50%;
            background-color: #fff;
        }
        .progress-value {
            position: relative;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0b4d75;
        }

        @media (max-width: 576px) {
            .circular-progress {
                width: 80px;
                height: 80px;
            }
            .circular-progress::before {
                width: 66px;
                height: 66px;
            }
            .progress-value {
                font-size: 1.15rem;
            }
        }

        /* ===== Custom Checkbox ===== */
        .custom-checkbox {
            width: 1.5rem !important;
            height: 1.5rem !important;
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .custom-checkbox {
                width: 1.25rem !important;
                height: 1.25rem !important;
            }
        }

        /* ===== Danger Card ===== */
        .danger-card {
            border: 1px solid rgba(220, 53, 69, 0.2);
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        .danger-card:hover {
            border-color: #DC3545;
            background: #fef2f2;
        }

        /* ===== Alert Banner (Tanda Bahaya) ===== */
        .alert-banner {
            background: linear-gradient(135deg, #DC3545, #c82333);
            padding: 30px 24px;
        }
        .alert-banner h4 {
            font-size: 1.35rem;
        }
        .alert-banner p {
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .alert-banner {
                padding: 20px 16px;
            }
            .alert-banner h4 {
                font-size: 1.05rem;
            }
            .alert-banner p {
                font-size: 0.82rem;
            }
            .alert-banner .display-5 {
                font-size: 2rem !important;
            }
        }

        @media (max-width: 576px) {
            .alert-banner {
                padding: 16px 12px;
            }
            .alert-banner h4 {
                font-size: 0.95rem;
            }
            .alert-banner p {
                font-size: 0.75rem;
            }
        }

        /* ===== iOS-style Toggle ===== */
        .toggle-switch {
            width: 3.5rem !important;
            height: 1.8rem !important;
            background-color: #e2e8f0;
            border-color: #e2e8f0;
            cursor: pointer;
        }
        .toggle-switch:checked {
            background-color: #0375C4;
            border-color: #0375C4;
        }

        /* ===== Pastel Card ===== */
        .pastel-card {
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .pastel-card:hover {
            transform: translateY(-4px);
        }

        @media (max-width: 576px) {
            .pastel-card {
                padding: 16px;
            }
        }

        /* ===== Porsi Makan Icon Sizing ===== */
        .porsi-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            margin: 0 auto 12px auto;
        }
        .porsi-icon i {
            font-size: 1.5rem;
        }
        .porsi-icon img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        /* ===== Jurnal Form Switches - Mobile Fix ===== */
        @media (max-width: 576px) {
            .kia-switch-row {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px;
            }
            .kia-switch-row label {
                font-size: 0.85rem;
            }
        }

        /* ===== Responsive Alert Nutrisi ===== */
        .alert-nutrisi {
            padding: 12px 16px;
        }
        .alert-nutrisi h6 {
            font-size: 0.95rem;
        }
        .alert-nutrisi p {
            font-size: 0.88rem;
        }

        @media (max-width: 576px) {
            .alert-nutrisi {
                padding: 10px 12px;
            }
            .alert-nutrisi h6 {
                font-size: 0.85rem;
            }
            .alert-nutrisi p {
                font-size: 0.8rem;
            }
            .alert-nutrisi i {
                font-size: 1.25rem !important;
            }
        }

        /* ===== KIA Header Responsive ===== */
        @media (max-width: 576px) {
            .kia-header h4 {
                font-size: 1.1rem;
            }
            .kia-header .badge {
                font-size: 0.7rem;
                padding: 4px 10px !important;
            }
            .kia-header .user-info {
                display: none;
            }
        }

        /* ===== Perkembangan Bulan Card Emoji ===== */
        .bulan-emoji {
            font-size: 3rem;
            line-height: 1;
        }

        @media (max-width: 576px) {
            .bulan-emoji {
                font-size: 2.25rem;
            }
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
