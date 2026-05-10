@extends('layouts.bidan')

@section('title', 'Detail ANC - Klinik Mediva')
@section('page-title', 'Detail Pemeriksaan ANC')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Detail ANC</li>
            </ol>
        </nav>

        <!-- Info Pasien -->
        <div class="card custom-card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#6f42c1,#0d6efd);display:flex;align-items:center;justify-content:center;color:white;font-size:1.2rem;font-weight:700;">
                        {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $patient->nama_lengkap }}</h5>
                        <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pemeriksaan ANC -->
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i> Detail Pemeriksaan ANC</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('bidan.anc.edit', $anc->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form action="{{ route('bidan.anc.destroy', $anc->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ANC ini?');" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Informasi Umum -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Umum</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Tanggal Periksa</small>
                                    <strong>{{ $anc->tanggal_periksa->format('d F Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f0f9ff;">
                                    <small class="text-muted d-block mb-1">Usia Kehamilan</small>
                                    <strong>{{ $anc->usia_kehamilan_minggu }} Minggu</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f0fdf4;">
                                    <small class="text-muted d-block mb-1">Berat Badan</small>
                                    <strong>{{ $anc->berat_badan }} kg</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanda Vital -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-heart-pulse me-2"></i>Tanda Vital</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="p-3 rounded-3" style="background:{{ $anc->is_hipertensi ? '#fee2e2' : '#f8f9fa' }};">
                                    <small class="text-muted d-block mb-1">Tekanan Darah</small>
                                    <strong class="{{ $anc->is_hipertensi ? 'text-danger' : '' }}">
                                        {{ $anc->tekanan_darah_sistolik }}/{{ $anc->tekanan_darah_diastolik }} mmHg
                                    </strong>
                                    @if($anc->is_hipertensi)
                                        <div class="mt-1">
                                            <span class="badge bg-danger" style="font-size:0.65rem;">HIPERTENSI</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Tinggi Fundus</small>
                                    <strong>{{ $anc->tinggi_fundus ? $anc->tinggi_fundus.' cm' : '-' }}</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 rounded-3" style="background:{{ $anc->lingkar_lengan_atas && $anc->lingkar_lengan_atas < 23.5 ? '#fee2e2' : '#f8f9fa' }};">
                                    <small class="text-muted d-block mb-1">LILA</small>
                                    <strong class="{{ $anc->lingkar_lengan_atas && $anc->lingkar_lengan_atas < 23.5 ? 'text-danger' : '' }}">
                                        {{ $anc->lingkar_lengan_atas ? $anc->lingkar_lengan_atas.' cm' : '-' }}
                                    </strong>
                                    @if($anc->lingkar_lengan_atas && $anc->lingkar_lengan_atas < 23.5)
                                        <div class="mt-1">
                                            <span class="badge bg-danger" style="font-size:0.65rem;">KEK</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">DJJ</small>
                                    <strong>{{ $anc->denyut_jantung_janin ? $anc->denyut_jantung_janin.' bpm' : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keluhan & Catatan -->
                    @if($anc->keluhan || $anc->catatan_bidan)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-left-text me-2"></i>Keluhan & Catatan</h6>
                        @if($anc->keluhan)
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.85rem;">Keluhan Pasien</label>
                            <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                {{ $anc->keluhan }}
                            </div>
                        </div>
                        @endif
                        @if($anc->catatan_bidan)
                        <div>
                            <label class="form-label fw-semibold text-muted" style="font-size:0.85rem;">Catatan Bidan</label>
                            <div class="p-3 rounded-3" style="background:#f0f9ff;">
                                {{ $anc->catatan_bidan }}
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Jadwal & Petugas -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check me-2"></i>Informasi Tambahan</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#fefce8;">
                                    <small class="text-muted d-block mb-1">Jadwal Kunjungan Berikutnya</small>
                                    <strong>{{ $anc->jadwal_kunjungan_berikutnya ? $anc->jadwal_kunjungan_berikutnya->format('d F Y') : 'Belum dijadwalkan' }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Diperiksa Oleh</small>
                                    <strong>{{ $anc->bidan->name }}</strong>
                                    <div class="mt-1">
                                        <small class="text-muted">{{ $anc->created_at->format('d F Y, H:i') }} WIB</small>
                                    </div>
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
                        <a href="{{ route('bidan.anc.edit', $anc->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
