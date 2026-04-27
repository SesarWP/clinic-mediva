@extends('layouts.app')

@section('body')
<div class="sidebar-overlay"></div>

<!-- Sidebar -->
<nav class="sidebar" style="background: linear-gradient(180deg, #0c4a6e 0%, #164e63 100%);">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-3">
            <div style="width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#06b6d4,#0ea5e9);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-person-heart text-white"></i>
            </div>
            <div>
                <h4 class="text-white mb-0">Portal Pasien</h4>
                <small class="text-white-50">Klinik Mediva Ngawi</small>
            </div>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="{{ route('pasien.dashboard') }}" class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.dashboard') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('pasien.profil.edit') }}" class="nav-link {{ request()->routeIs('pasien.profil.*') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.profil.*') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);' : '' }}">
            <i class="bi bi-person-fill"></i> Profil Saya
        </a>
        <a href="{{ route('pasien.riwayat') }}" class="nav-link {{ request()->routeIs('pasien.riwayat') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.riwayat') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);' : '' }}">
            <i class="bi bi-clipboard2-pulse-fill"></i> Riwayat Periksa
        </a>
        <a href="{{ route('pasien.screening') }}" class="nav-link {{ request()->routeIs('pasien.screening') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.screening') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);' : '' }}">
            <i class="bi bi-droplet-fill"></i> Screening Anemia
        </a>

        <div class="nav-label mt-3">Akun</div>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" style="cursor:pointer;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <header class="top-header">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light btn-sm sidebar-toggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0 fw-bold text-dark">@yield('page-title', 'Dashboard Pasien')</h5>
        </div>
        <div class="user-info">
            <div>
                <div class="fw-semibold" style="font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div class="text-muted" style="font-size:0.75rem;">Pasien</div>
            </div>
            <div class="user-avatar" style="background: linear-gradient(135deg, #06b6d4, #0ea5e9);">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="content-area fade-in">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="border-radius:12px;border:none;background:linear-gradient(135deg,#d1e7dd,#badbcc);">
                <i class="bi bi-check-circle-fill me-2 text-success"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>
@endsection
