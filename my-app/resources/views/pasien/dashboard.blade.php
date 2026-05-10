@extends('layouts.pasien')

@section('title', 'Dashboard Pasien - Klinik Mediva')
@section('page-title', 'Dashboard Saya')

@section('content')
<!-- Welcome -->
<div class="card custom-card mb-4" style="background:linear-gradient(135deg,#0c4a6e,#164e63);color:white;">
    <div class="card-body py-4">
        <h4 class="fw-bold mb-1">Selamat Datang, {{ $patient->nama_lengkap }} 👋</h4>
        <p class="mb-0 opacity-75">Berikut ringkasan data kehamilan dan pemeriksaan Anda.</p>
    </div>
</div>

<!-- Info Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card primary">
            <div class="stat-label">Usia Kehamilan</div>
            <div class="stat-number text-primary" style="font-size:1.4rem;">{{ $patient->usia_kehamilan ?: '-' }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card success">
            <div class="stat-label">Taksiran Persalinan</div>
            <div class="fw-bold text-success" style="font-size:1.1rem;">{{ $patient->taksiran_persalinan ? $patient->taksiran_persalinan->format('d M Y') : '-' }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card warning">
            <div class="stat-label">Kehamilan (G/P/A)</div>
            <div class="fw-bold" style="font-size:1.1rem;color:#e67e22;">G{{ $patient->gravida ?? 0 }}P{{ $patient->para ?? 0 }}A{{ $patient->abortus ?? 0 }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card {{ $screeningTerakhir && $screeningTerakhir->status_anemia != 'normal' ? 'danger' : 'success' }}">
            <div class="stat-label">Status Anemia</div>
            <div class="fw-bold" style="font-size:1.1rem;">
                @if($screeningTerakhir)
                    {{ ucfirst($screeningTerakhir->status_anemia) }} ({{ $screeningTerakhir->kadar_hb }} g/dL)
                @else
                    Belum diperiksa
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <a href="{{ route('pasien.health-updates.create') }}" class="card custom-card text-decoration-none hover-shadow" style="border:2px solid #dc3545;">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:12px;background:#fee2e2;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-heart-pulse-fill text-danger" style="font-size:1.5rem;"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-danger">Update Kesehatan Harian</h6>
                    <small class="text-muted">Catat kondisi kesehatan Anda hari ini</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('pasien.health-updates.index') }}" class="card custom-card text-decoration-none hover-shadow" style="border:2px solid #0d6efd;">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:12px;background:#f0f9ff;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-clock-history text-primary" style="font-size:1.5rem;"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-primary">Riwayat Update Kesehatan</h6>
                    <small class="text-muted">Lihat catatan kesehatan Anda</small>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Jadwal Berikutnya -->
    <div class="col-lg-6">
        <div class="card custom-card h-100">
            <div class="card-header">
                <i class="bi bi-calendar-event text-primary me-2"></i> Jadwal Kunjungan Berikutnya
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                @if($jadwalBerikutnya)
                    <div class="text-center">
                        <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#0ea5e9,#06b6d4);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                            <i class="bi bi-calendar-check text-white" style="font-size:2rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary">{{ \Carbon\Carbon::parse($jadwalBerikutnya->jadwal_kunjungan_berikutnya)->format('d M Y') }}</h3>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($jadwalBerikutnya->jadwal_kunjungan_berikutnya)->diffForHumans() }}</p>
                    </div>
                @else
                    <div class="text-center text-muted">
                        <i class="bi bi-calendar-x" style="font-size:3rem;"></i>
                        <p class="mt-2">Belum ada jadwal kunjungan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pemeriksaan Terakhir -->
    <div class="col-lg-6">
        <div class="card custom-card h-100">
            <div class="card-header">
                <i class="bi bi-clipboard2-pulse text-success me-2"></i> Pemeriksaan Terakhir
            </div>
            <div class="card-body">
                @if($ancTerakhir)
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:#f0f9ff;">
                                <small class="text-muted d-block">Tanggal</small>
                                <strong>{{ $ancTerakhir->tanggal_periksa->format('d M Y') }}</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:#f0fdf4;">
                                <small class="text-muted d-block">Tekanan Darah</small>
                                <strong class="{{ $ancTerakhir->is_hipertensi ? 'text-danger' : '' }}">{{ $ancTerakhir->tekanan_darah_sistolik }}/{{ $ancTerakhir->tekanan_darah_diastolik }} mmHg</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:#fefce8;">
                                <small class="text-muted d-block">Berat Badan</small>
                                <strong>{{ $ancTerakhir->berat_badan }} kg</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:#fdf2f8;">
                                <small class="text-muted d-block">UK</small>
                                <strong>{{ $ancTerakhir->usia_kehamilan_minggu }} minggu</strong>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('pasien.riwayat') }}" class="btn btn-outline-primary btn-sm w-100">Lihat Semua Riwayat</a>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-inbox" style="font-size:3rem;"></i>
                        <p class="mt-2">Belum ada pemeriksaan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
