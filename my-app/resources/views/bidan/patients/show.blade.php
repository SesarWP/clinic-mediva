@extends('layouts.bidan')

@section('title', 'Detail Pasien - Klinik Mediva')
@section('page-title', 'Detail Pasien')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
        <li class="breadcrumb-item active">{{ $patient->nama_lengkap }}</li>
    </ol>
</nav>

<!-- Profil Pasien -->
<div class="card custom-card mb-4">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#6f42c1,#0d6efd);display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;font-weight:700;">
                    {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $patient->nama_lengkap }}
                        @if($patient->is_risiko_tinggi)
                            <span class="badge bg-danger ms-2" style="font-size:0.7rem;">RISIKO TINGGI</span>
                        @endif
                    </h4>
                    <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun · Gol. Darah: {{ $patient->golongan_darah ?: '-' }}</small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('bidan.anc.create', $patient->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-clipboard-plus me-1"></i> ANC</a>
                <a href="{{ route('bidan.screening.create', $patient->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-droplet me-1"></i> Screening</a>
                <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info btn-sm"><i class="bi bi-heart-pulse me-1"></i> Update Kesehatan</a>
                <a href="{{ route('bidan.patients.edit', $patient->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="row g-3 mt-3">
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#f0f9ff;">
                    <small class="text-muted d-block">Kehamilan (G/P/A)</small>
                    <strong>G{{ $patient->gravida ?? 0 }}P{{ $patient->para ?? 0 }}A{{ $patient->abortus ?? 0 }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#f0fdf4;">
                    <small class="text-muted d-block">Usia Kehamilan</small>
                    <strong>{{ $patient->usia_kehamilan ?: '-' }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#fefce8;">
                    <small class="text-muted d-block">HPHT</small>
                    <strong>{{ $patient->hpht ? $patient->hpht->format('d M Y') : '-' }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#fdf2f8;">
                    <small class="text-muted d-block">Taksiran Persalinan</small>
                    <strong>{{ $patient->taksiran_persalinan ? $patient->taksiran_persalinan->format('d M Y') : '-' }}</strong>
                </div>
            </div>
        </div>

        @if($patient->is_risiko_tinggi)
        <div class="alert alert-danger d-flex align-items-start gap-2 mt-3 mb-0" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill mt-1"></i>
            <div>
                <strong>Faktor Risiko:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($patient->alasan_risiko as $alasan)
                        <li>{{ $alasan }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Riwayat ANC -->
<div class="card custom-card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i> Riwayat Pemeriksaan ANC</span>
        <a href="{{ route('bidan.anc.create', $patient->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
    <div class="card-body p-0">
        @if($patient->ancExaminations->isEmpty())
            <div class="text-center text-muted py-4">Belum ada pemeriksaan ANC</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>UK</th>
                            <th>TD</th>
                            <th>BB</th>
                            <th>TFU</th>
                            <th>LILA</th>
                            <th>DJJ</th>
                            <th>Bidan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->ancExaminations as $anc)
                        <tr>
                            <td>{{ $anc->tanggal_periksa->format('d/m/Y') }}</td>
                            <td>{{ $anc->usia_kehamilan_minggu }} mg</td>
                            <td>
                                <span class="{{ $anc->is_hipertensi ? 'text-danger fw-bold' : '' }}">
                                    {{ $anc->tekanan_darah_sistolik }}/{{ $anc->tekanan_darah_diastolik }}
                                </span>
                            </td>
                            <td>{{ $anc->berat_badan }} kg</td>
                            <td>{{ $anc->tinggi_fundus ? $anc->tinggi_fundus.' cm' : '-' }}</td>
                            <td>
                                @if($anc->lingkar_lengan_atas)
                                    <span class="{{ $anc->lingkar_lengan_atas < 23.5 ? 'text-danger fw-bold' : '' }}">{{ $anc->lingkar_lengan_atas }} cm</span>
                                @else - @endif
                            </td>
                            <td>{{ $anc->denyut_jantung_janin ?: '-' }}</td>
                            <td><small>{{ $anc->bidan->name }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.anc.show', $anc->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.anc.edit', $anc->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.anc.destroy', $anc->id) }}" method="POST" onsubmit="return confirm('Hapus data ANC ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Riwayat Screening Anemia -->
<div class="card custom-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-droplet-fill text-danger me-2"></i> Riwayat Screening Anemia</span>
        <a href="{{ route('bidan.screening.create', $patient->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
    <div class="card-body p-0">
        @if($patient->anemiaScreenings->isEmpty())
            <div class="text-center text-muted py-4">Belum ada screening anemia</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kadar HB</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                            <th>Bidan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->anemiaScreenings as $screening)
                        <tr>
                            <td>{{ $screening->tanggal_screening->format('d/m/Y') }}</td>
                            <td><strong>{{ $screening->kadar_hb }} g/dL</strong></td>
                            <td>
                                @php
                                    $colors = ['normal'=>'success','ringan'=>'warning','sedang'=>'orange','berat'=>'danger'];
                                    $c = $colors[$screening->status_anemia] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $c == 'orange' ? 'warning' : $c }} {{ $c == 'warning' ? 'text-dark' : '' }} badge-risk">
                                    {{ ucfirst($screening->status_anemia) }}
                                </span>
                            </td>
                            <td><small>{{ $screening->tindakan ?: '-' }}</small></td>
                            <td><small>{{ $screening->bidan->name }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.screening.show', $screening->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.screening.edit', $screening->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.screening.destroy', $screening->id) }}" method="POST" onsubmit="return confirm('Hapus data screening ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Riwayat Update Kesehatan (KIA) -->
<div class="card custom-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-journal-medical text-primary me-2"></i> Buku KIA Interaktif & Konsultasi</span>
        <a href="{{ route('bidan.kia-checkins.index', $patient->id) }}" class="btn btn-primary btn-sm rounded-pill fw-semibold px-3">
            <i class="bi bi-arrow-right-circle me-1"></i> Buka Manajemen KIA
        </a>
    </div>
    <div class="card-body p-4 text-center">
        @if($patient->requires_clinic_visit)
            <div class="alert alert-danger d-inline-block px-4 py-2 rounded-pill fw-bold mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Wajib Kunjungan Klinik
            </div>
            <p class="text-muted mb-0">Pasien ini telah ditandai untuk melakukan kunjungan langsung ke klinik.</p>
        @else
            <i class="bi bi-phone text-black-50 mb-3 d-block" style="font-size: 3rem;"></i>
            <p class="text-muted mb-0">Kelola riwayat check-in gamifikasi Buku KIA harian pasien, tinjau tanda bahaya, dan balas konsultasi ringan pasien melalui Manajemen KIA.</p>
        @endif
    </div>
</div>
@endsection
