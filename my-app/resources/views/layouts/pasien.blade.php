@extends('layouts.app')

@section('body')
<div class="sidebar-overlay"></div>

<!-- Sidebar -->
<nav class="sidebar" style="background: linear-gradient(180deg, #0c4a6e 0%, #075985 100%);">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-3">
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#06b6d4,#0ea5e9);display:flex;align-items:center;justify-content:center;box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);">
                <i class="bi bi-person-heart text-white" style="font-size:1.3rem;"></i>
            </div>
            <div>
                <h4 class="text-white mb-0">Portal Pasien</h4>
                <small class="text-white-50">Klinik Mediva Ngawi</small>
            </div>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="{{ route('pasien.dashboard') }}" class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.dashboard') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('pasien.screening') }}" class="nav-link {{ request()->routeIs('pasien.screening*') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.screening*') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-droplet-fill"></i> Screening Anemia
        </a>
        <a href="{{ route('pasien.health-updates.index') }}" class="nav-link {{ request()->routeIs('pasien.health-updates.*') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.health-updates.*') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-heart-pulse-fill"></i> Update Kesehatan
        </a>
        <a href="{{ route('pasien.buku-kia') }}" class="nav-link {{ request()->routeIs('pasien.buku-kia') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.buku-kia') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-journal-medical"></i> Buku KIA Interaktif
        </a>
        <a href="{{ route('pasien.riwayat') }}" class="nav-link {{ request()->routeIs('pasien.riwayat*') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.riwayat*') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-clipboard2-pulse-fill"></i> Riwayat Periksa
        </a>
        <a href="{{ route('pasien.profil.edit') }}" class="nav-link {{ request()->routeIs('pasien.profil.*') ? 'active' : '' }}" style="{{ request()->routeIs('pasien.profil.*') ? 'background:linear-gradient(135deg,#06b6d4,#0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);' : '' }}">
            <i class="bi bi-person-fill"></i> Profil Saya
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
            @if(auth()->user()->profile_photo_path)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="User Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
            @else
                <div class="user-avatar" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #06b6d4, #0ea5e9);box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3); color: white; font-weight: bold;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
    </header>

    <!-- Content -->
    <div class="content-area fade-in">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-3" style="font-size:1.25rem;"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>
@endsection
