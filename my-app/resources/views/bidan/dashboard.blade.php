@extends('layouts.bidan')

@section('title', 'Dashboard Bidan - Klinik Mediva')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Total Pasien</div>
                    <div class="stat-number text-primary">{{ $totalPasien }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(13,110,253,0.1);color:#0d6efd;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Kunjungan Hari Ini</div>
                    <div class="stat-number text-success">{{ $kunjunganHariIni }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(25,135,84,0.1);color:#198754;">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Pasien Anemia</div>
                    <div class="stat-number" style="color:#e67e22;">{{ $pasienAnemia }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(230,126,34,0.1);color:#e67e22;">
                    <i class="bi bi-droplet-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Risiko Tinggi</div>
                    <div class="stat-number text-danger">{{ $pasienRisikoTinggi->count() }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(220,53,69,0.1);color:#dc3545;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Pasien Risiko Tinggi -->
    <div class="col-lg-6">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> Pasien Risiko Tinggi</span>
                <span class="badge bg-danger rounded-pill">{{ $pasienRisikoTinggi->count() }}</span>
            </div>
            <div class="card-body p-0">
                @if($pasienRisikoTinggi->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-check-circle text-success" style="font-size:2rem;"></i>
                        <p class="mt-2 mb-0">Tidak ada pasien berisiko tinggi</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th>Pasien</th>
                                    <th>Risiko</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasienRisikoTinggi->take(5) as $p)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $p->nama_lengkap }}</div>
                                        <small class="text-muted">{{ $p->usia }} tahun</small>
                                    </td>
                                    <td>
                                        @foreach($p->alasan_risiko as $alasan)
                                            <span class="badge bg-danger bg-opacity-10 text-danger badge-risk d-block mb-1">{{ $alasan }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('bidan.patients.show', $p->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Jadwal Kunjungan Mendatang -->
    <div class="col-lg-6">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-calendar-week text-primary me-2"></i> Jadwal Kunjungan (7 Hari)</span>
                <span class="badge bg-primary rounded-pill">{{ $jadwalMendatang->count() }}</span>
            </div>
            <div class="card-body p-0">
                @if($jadwalMendatang->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-calendar-x" style="font-size:2rem;"></i>
                        <p class="mt-2 mb-0">Tidak ada jadwal kunjungan mendatang</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pasien</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalMendatang as $jadwal)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary badge-risk">
                                            {{ \Carbon\Carbon::parse($jadwal->jadwal_kunjungan_berikutnya)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $jadwal->patient->nama_lengkap }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ route('bidan.patients.show', $jadwal->patient->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kunjungan Hari Ini -->
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-clipboard2-pulse-fill text-success me-2"></i> Kunjungan Hari Ini</span>
                <a href="{{ route('bidan.patients.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-people me-1"></i> Semua Pasien
                </a>
            </div>
            <div class="card-body p-0">
                @if($kunjunganHariIniList->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size:2rem;"></i>
                        <p class="mt-2 mb-0">Belum ada kunjungan hari ini</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th>Pasien</th>
                                    <th>Usia Kehamilan</th>
                                    <th>TD</th>
                                    <th>BB</th>
                                    <th>Keluhan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kunjunganHariIniList as $kunjungan)
                                <tr>
                                    <td class="fw-semibold">{{ $kunjungan->patient->nama_lengkap }}</td>
                                    <td>{{ $kunjungan->usia_kehamilan_minggu }} minggu</td>
                                    <td>
                                        <span class="{{ $kunjungan->is_hipertensi ? 'text-danger fw-bold' : '' }}">
                                            {{ $kunjungan->tekanan_darah_sistolik }}/{{ $kunjungan->tekanan_darah_diastolik }}
                                        </span>
                                    </td>
                                    <td>{{ $kunjungan->berat_badan }} kg</td>
                                    <td><small>{{ Str::limit($kunjungan->keluhan, 40) ?: '-' }}</small></td>
                                    <td>
                                        <a href="{{ route('bidan.patients.show', $kunjungan->patient->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
