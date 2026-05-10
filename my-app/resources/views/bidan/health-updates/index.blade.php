@extends('layouts.bidan')

@section('title', 'Riwayat Update Kesehatan - Klinik Mediva')
@section('page-title', 'Riwayat Update Kesehatan')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Riwayat Update Kesehatan</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="card custom-card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,#17a2b8,#138496);display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;font-weight:700;">
                            {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $patient->nama_lengkap }}</h5>
                            <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun</small>
                        </div>
                    </div>
                    <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Update
                    </a>
                </div>
            </div>
        </div>

        @if($updates->isEmpty())
            <div class="card custom-card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-heart-pulse" style="font-size:4rem;color:#ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Update Kesehatan</h5>
                    <p class="text-muted">Pasien belum melakukan update kesehatan</p>
                    <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info mt-2">
                        <i class="bi bi-plus-lg me-1"></i> Buat Update Pertama
                    </a>
                </div>
            </div>
        @else
            <!-- Timeline View -->
            <div class="card custom-card">
                <div class="card-body">
                    <div class="timeline">
                        @foreach($updates as $update)
                        <div class="timeline-item mb-4 pb-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex gap-3">
                                <!-- Icon & Date -->
                                <div class="text-center" style="min-width:80px;">
                                    <div class="mb-2">
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                                             style="width:48px;height:48px;background:{{ $update->has_gejala_bahaya ? '#fee2e2' : '#f0f9ff' }};">
                                            <i class="bi bi-heart-pulse-fill" style="font-size:1.3rem;color:{{ $update->has_gejala_bahaya ? '#dc3545' : '#17a2b8' }};"></i>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block">{{ $update->tanggal_update->format('d M') }}</small>
                                    <small class="text-muted">{{ $update->tanggal_update->format('Y') }}</small>
                                </div>

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="badge bg-{{ $update->tipe_update == 'harian' ? 'primary' : 'info' }} me-2">
                                                {{ ucfirst($update->tipe_update) }}
                                            </span>
                                            <span class="badge bg-{{ $update->kondisi_color }}">
                                                {{ ucfirst($update->kondisi_umum) }}
                                            </span>
                                            @if($update->has_gejala_bahaya)
                                                <span class="badge bg-danger ms-1">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Gejala Bahaya
                                                </span>
                                            @endif
                                            @if($update->perlu_tindak_lanjut)
                                                <span class="badge bg-warning text-dark ms-1">
                                                    <i class="bi bi-flag-fill me-1"></i>Perlu Tindak Lanjut
                                                </span>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('bidan.health-updates.show', $update->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('bidan.health-updates.edit', $update->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('bidan.health-updates.destroy', $update->id) }}" method="POST" onsubmit="return confirm('Hapus update kesehatan ini?');" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Tanda Vital -->
                                    @if($update->suhu_tubuh || $update->tekanan_darah)
                                    <div class="mb-2">
                                        <small class="text-muted">Tanda Vital:</small>
                                        @if($update->suhu_tubuh)
                                            <span class="badge {{ $update->suhu_tubuh >= 38 ? 'bg-danger' : 'bg-light text-dark' }} ms-1">
                                                <i class="bi bi-thermometer-half me-1"></i>{{ $update->suhu_tubuh }}°C
                                            </span>
                                        @endif
                                        @if($update->tekanan_darah)
                                            <span class="badge {{ $update->tekanan_darah_sistolik >= 140 ? 'bg-danger' : 'bg-light text-dark' }} ms-1">
                                                <i class="bi bi-heart me-1"></i>{{ $update->tekanan_darah }} mmHg
                                            </span>
                                        @endif
                                    </div>
                                    @endif

                                    <!-- Gejala -->
                                    @if(!empty($update->gejala_list))
                                    <div class="mb-2">
                                        <small class="text-muted">Gejala:</small>
                                        @foreach($update->gejala_list as $gejala)
                                            <span class="badge {{ in_array($gejala, ['Pendarahan', 'Kontraksi', 'Gerakan Janin Berkurang']) ? 'bg-danger' : 'bg-warning text-dark' }} ms-1">
                                                {{ $gejala }}
                                            </span>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Keluhan -->
                                    @if($update->keluhan)
                                    <div class="p-2 rounded-3 mt-2" style="background:#f8f9fa;">
                                        <small class="text-muted d-block mb-1">Keluhan:</small>
                                        <small>{{ Str::limit($update->keluhan, 150) }}</small>
                                    </div>
                                    @endif

                                    <!-- Catatan Bidan -->
                                    @if($update->catatan_bidan)
                                    <div class="p-2 rounded-3 mt-2" style="background:#f0fdf4;border-left:3px solid #10b981;">
                                        <small class="text-success fw-semibold d-block mb-1">
                                            <i class="bi bi-person-badge me-1"></i>Catatan Bidan:
                                        </small>
                                        <small>{{ Str::limit($update->catatan_bidan, 150) }}</small>
                                    </div>
                                    @endif

                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>{{ $update->created_at->diffForHumans() }}
                                            · Input oleh: 
                                            @if($update->sumber_input == 'pasien')
                                                <span class="badge bg-light text-dark">Pasien</span>
                                            @else
                                                <span class="badge bg-light text-dark">Bidan ({{ $update->bidan->name ?? '-' }})</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($updates->hasPages())
                    <div class="mt-4">
                        {{ $updates->links() }}
                    </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
