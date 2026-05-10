@extends('layouts.bidan')

@section('title', 'Detail Update Kesehatan - Klinik Mediva')
@section('page-title', 'Detail Update Kesehatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Detail Update Kesehatan</li>
            </ol>
        </nav>

        <!-- Info Pasien -->
        <div class="card custom-card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#17a2b8,#138496);display:flex;align-items:center;justify-content:center;color:white;font-size:1.2rem;font-weight:700;">
                        {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $patient->nama_lengkap }}</h5>
                        <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Gejala Bahaya -->
        @if($update->has_gejala_bahaya)
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill mt-1" style="font-size:1.5rem;"></i>
            <div>
                <strong>⚠️ PERHATIAN: Terdeteksi Gejala Bahaya!</strong>
                <p class="mb-0 mt-1">Pasien memerlukan perhatian dan tindak lanjut segera.</p>
                <ul class="mb-0 mt-2">
                    @if($update->pendarahan)
                        <li>Pendarahan</li>
                    @endif
                    @if($update->kontraksi)
                        <li>Kontraksi</li>
                    @endif
                    @if($update->gerakan_janin_berkurang)
                        <li>Gerakan Janin Berkurang</li>
                    @endif
                    @if($update->suhu_tubuh && $update->suhu_tubuh >= 38)
                        <li>Demam Tinggi ({{ $update->suhu_tubuh }}°C)</li>
                    @endif
                    @if($update->tekanan_darah_sistolik && $update->tekanan_darah_sistolik >= 140)
                        <li>Hipertensi ({{ $update->tekanan_darah }} mmHg)</li>
                    @endif
                </ul>
            </div>
        </div>
        @endif

        <!-- Detail Update -->
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-heart-pulse-fill text-info me-2"></i> Detail Update Kesehatan</span>
                <div class="d-flex gap-2">
                    <span class="badge bg-{{ $update->tipe_update == 'harian' ? 'primary' : 'info' }}" style="font-size:0.9rem;">
                        {{ ucfirst($update->tipe_update) }}
                    </span>
                    <span class="badge bg-{{ $update->kondisi_color }}" style="font-size:0.9rem;">
                        {{ ucfirst($update->kondisi_umum) }}
                    </span>
                    @if($update->perlu_tindak_lanjut)
                        <span class="badge bg-warning text-dark" style="font-size:0.9rem;">
                            <i class="bi bi-flag-fill me-1"></i>Perlu Tindak Lanjut
                        </span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Informasi Dasar -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check me-2"></i>Informasi Dasar</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Tanggal Update</small>
                                    <strong>{{ $update->tanggal_update->format('d F Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f0f9ff;">
                                    <small class="text-muted d-block mb-1">Sumber Input</small>
                                    <strong>
                                        @if($update->sumber_input == 'pasien')
                                            <i class="bi bi-person-fill me-1"></i>Pasien
                                        @else
                                            <i class="bi bi-person-badge-fill me-1"></i>Bidan
                                            @if($update->bidan)
                                                ({{ $update->bidan->name }})
                                            @endif
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#fef3c7;">
                                    <small class="text-muted d-block mb-1">Waktu Input</small>
                                    <strong>{{ $update->created_at->format('d/m/Y H:i') }}</strong>
                                    <div class="mt-1">
                                        <small class="text-muted">{{ $update->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanda Vital -->
                    @if($update->suhu_tubuh || $update->tekanan_darah)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-thermometer-half me-2"></i>Tanda Vital</h6>
                        <div class="row g-3">
                            @if($update->suhu_tubuh)
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:{{ $update->suhu_tubuh >= 38 ? '#fee2e2' : '#f8f9fa' }};">
                                    <small class="text-muted d-block mb-1">Suhu Tubuh</small>
                                    <strong class="{{ $update->suhu_tubuh >= 38 ? 'text-danger' : '' }}" style="font-size:1.3rem;">
                                        {{ $update->suhu_tubuh }}°C
                                    </strong>
                                    @if($update->suhu_tubuh >= 38)
                                        <div class="mt-1">
                                            <span class="badge bg-danger" style="font-size:0.7rem;">DEMAM TINGGI</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @if($update->tekanan_darah)
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:{{ $update->tekanan_darah_sistolik >= 140 ? '#fee2e2' : '#f8f9fa' }};">
                                    <small class="text-muted d-block mb-1">Tekanan Darah</small>
                                    <strong class="{{ $update->tekanan_darah_sistolik >= 140 ? 'text-danger' : '' }}" style="font-size:1.3rem;">
                                        {{ $update->tekanan_darah }} mmHg
                                    </strong>
                                    @if($update->tekanan_darah_sistolik >= 140)
                                        <div class="mt-1">
                                            <span class="badge bg-danger" style="font-size:0.7rem;">HIPERTENSI</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Gejala -->
                    @if(!empty($update->gejala_list))
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-clipboard2-pulse me-2"></i>Gejala yang Dialami</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($update->gejala_list as $gejala)
                                <span class="badge {{ in_array($gejala, ['Pendarahan', 'Kontraksi', 'Gerakan Janin Berkurang']) ? 'bg-danger' : 'bg-warning text-dark' }}" style="font-size:0.9rem;padding:8px 12px;">
                                    @if(in_array($gejala, ['Pendarahan', 'Kontraksi', 'Gerakan Janin Berkurang']))
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                    @endif
                                    {{ $gejala }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-clipboard2-pulse me-2"></i>Gejala yang Dialami</h6>
                        <div class="p-3 rounded-3 text-center text-muted" style="background:#f8f9fa;">
                            Tidak ada gejala yang dilaporkan
                        </div>
                    </div>
                    @endif

                    <!-- Pola Hidup -->
                    @if($update->kualitas_tidur || $update->nafsu_makan || $update->aktivitas_fisik)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-activity me-2"></i>Pola Hidup</h6>
                        <div class="row g-3">
                            @if($update->kualitas_tidur)
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Kualitas Tidur</small>
                                    <strong>{{ ucfirst($update->kualitas_tidur) }}</strong>
                                </div>
                            </div>
                            @endif
                            @if($update->nafsu_makan)
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Nafsu Makan</small>
                                    <strong>{{ ucfirst($update->nafsu_makan) }}</strong>
                                </div>
                            </div>
                            @endif
                            @if($update->aktivitas_fisik)
                            <div class="col-md-4">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Aktivitas Fisik</small>
                                    <strong>{{ ucfirst($update->aktivitas_fisik) }}</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Keluhan -->
                    @if($update->keluhan)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-left-text me-2"></i>Keluhan Pasien</h6>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            {{ $update->keluhan }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan Pasien -->
                    @if($update->catatan_pasien)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-journal-text me-2"></i>Catatan Pasien</h6>
                        <div class="p-3 rounded-3" style="background:#f0f9ff;">
                            {{ $update->catatan_pasien }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan Bidan -->
                    @if($update->catatan_bidan)
                    <div class="col-12">
                        <h6 class="fw-bold text-success mb-3"><i class="bi bi-person-badge me-2"></i>Catatan Bidan</h6>
                        <div class="p-3 rounded-3" style="background:#f0fdf4;border-left:4px solid #10b981;">
                            {{ $update->catatan_bidan }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Profil Pasien
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('bidan.health-updates.edit', $update->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('bidan.health-updates.destroy', $update->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus update kesehatan ini?');" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
