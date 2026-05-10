@extends('layouts.bidan')

@section('title', 'Detail Screening - Klinik Mediva')
@section('page-title', 'Detail Screening Anemia')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Detail Screening</li>
            </ol>
        </nav>

        <!-- Info Pasien -->
        <div class="card custom-card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#dc3545,#fd7e14);display:flex;align-items:center;justify-content:center;color:white;font-size:1.2rem;font-weight:700;">
                        {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $patient->nama_lengkap }}</h5>
                        <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Screening Anemia -->
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-droplet-fill text-danger me-2"></i> Detail Screening Anemia</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('bidan.screening.edit', $screening->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form action="{{ route('bidan.screening.destroy', $screening->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data screening ini?');" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Hasil Screening -->
                    <div class="col-12">
                        <h6 class="fw-bold text-danger mb-3"><i class="bi bi-clipboard-data me-2"></i>Hasil Screening</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Tanggal Screening</small>
                                    <strong>{{ $screening->tanggal_screening->format('d F Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#fee2e2;">
                                    <small class="text-muted d-block mb-1">Kadar Hemoglobin</small>
                                    <strong class="text-danger" style="font-size:1.3rem;">{{ $screening->kadar_hb }} g/dL</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:
                                    @if($screening->status_anemia == 'normal') #dcfce7
                                    @elseif($screening->status_anemia == 'ringan') #fef3c7
                                    @elseif($screening->status_anemia == 'sedang') #fed7aa
                                    @else #fee2e2
                                    @endif
                                ;">
                                    <small class="text-muted d-block mb-1">Status Anemia</small>
                                    <strong class="
                                        @if($screening->status_anemia == 'normal') text-success
                                        @elseif($screening->status_anemia == 'ringan') text-warning
                                        @else text-danger
                                        @endif
                                    " style="font-size:1.1rem;">
                                        {{ strtoupper($screening->status_anemia) }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interpretasi Status -->
                    <div class="col-12">
                        <div class="alert 
                            @if($screening->status_anemia == 'normal') alert-success
                            @elseif($screening->status_anemia == 'ringan') alert-warning
                            @else alert-danger
                            @endif
                        " style="border-radius:12px;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi 
                                    @if($screening->status_anemia == 'normal') bi-check-circle-fill
                                    @else bi-exclamation-triangle-fill
                                    @endif
                                mt-1"></i>
                                <div>
                                    <strong>Interpretasi:</strong>
                                    <p class="mb-0 mt-1">
                                        @if($screening->status_anemia == 'normal')
                                            Kadar hemoglobin dalam batas normal (≥ 11 g/dL). Pasien tidak mengalami anemia.
                                        @elseif($screening->status_anemia == 'ringan')
                                            Anemia ringan terdeteksi (10-10.9 g/dL). Diperlukan suplementasi zat besi dan monitoring berkala.
                                        @elseif($screening->status_anemia == 'sedang')
                                            Anemia sedang terdeteksi (7-9.9 g/dL). Memerlukan penanganan medis dan suplementasi intensif.
                                        @else
                                            Anemia berat terdeteksi (< 7 g/dL). Memerlukan penanganan medis segera dan rujukan ke fasilitas kesehatan yang lebih lengkap.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terkait Pemeriksaan ANC -->
                    @if($screening->ancExamination)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Terkait Pemeriksaan ANC</h6>
                        <div class="card" style="border:2px solid #e5e7eb;border-radius:12px;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex gap-3">
                                            <div>
                                                <small class="text-muted d-block">Tanggal Periksa</small>
                                                <strong>{{ $screening->ancExamination->tanggal_periksa->format('d F Y') }}</strong>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Usia Kehamilan</small>
                                                <strong>{{ $screening->ancExamination->usia_kehamilan_minggu }} Minggu</strong>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Tekanan Darah</small>
                                                <strong>{{ $screening->ancExamination->tekanan_darah_sistolik }}/{{ $screening->ancExamination->tekanan_darah_diastolik }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="{{ route('bidan.anc.show', $screening->ancExamination->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail ANC
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Tindak Lanjut -->
                    @if($screening->tindakan)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-clipboard-check me-2"></i>Tindak Lanjut</h6>
                        <div class="p-3 rounded-3" style="background:#f0f9ff;border-left:4px solid #0d6efd;">
                            {{ $screening->tindakan }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan -->
                    @if($screening->catatan)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-left-text me-2"></i>Catatan</h6>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            {{ $screening->catatan }}
                        </div>
                    </div>
                    @endif

                    <!-- Petugas -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge me-2"></i>Informasi Petugas</h6>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block mb-1">Diperiksa Oleh</small>
                                    <strong>{{ $screening->bidan->name }}</strong>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Waktu Input</small>
                                    <small class="fw-semibold">{{ $screening->created_at->format('d F Y, H:i') }} WIB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Profil Pasien
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('bidan.screening.edit', $screening->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
