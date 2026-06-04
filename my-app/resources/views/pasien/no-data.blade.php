@extends('layouts.pasien')

@section('title', 'Data Belum Tersedia - Klinik Mediva')
@section('page-title', 'Dashboard')

@section('content')
<div class="text-center py-5">
    <div style="width:80px;height:80px;border-radius:50%;background:rgba(220,53,69,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
        <i class="bi bi-exclamation-circle text-danger" style="font-size:2.5rem;"></i>
    </div>
    <h4 class="fw-bold">Data Pasien Belum Tersedia</h4>
    <p class="text-muted">Akun Anda belum dihubungkan dengan data pasien. Silakan lengkapi data profil Anda terlebih dahulu.</p>
    
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ route('pasien.setup-profile') }}" class="btn btn-primary">
            <i class="bi bi-person-lines-fill me-1"></i> Lengkapi Data Diri Sekarang
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-left me-1"></i> Kembali ke Login
            </button>
        </form>
    </div>
</div>
@endsection
