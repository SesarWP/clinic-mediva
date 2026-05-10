@extends('layouts.pasien')

@section('title', 'Detail Update Kesehatan - Klinik Mediva')
@section('page-title', 'Detail Update Kesehatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pasien.health-updates.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <span class="badge bg-{{ $update->tipe_update == 'harian' ? 'primary' : 'info' }}" style="font-size:0.9rem;">
                {{ ucfirst($update->tipe_update) }}
            </span>
        </div>

        <!-- Alert Gejala Bahaya -->
        @if($update->has_gejala_bahaya)
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill mt-1" style="font-size:1.5rem;"></i>
            <div>
                <strong>⚠️ Perhatian: Terdeteksi Gejala yang Perlu Perhatian!</strong>
                <p class="mb-0 mt-1">Segera hubungi bidan Anda atau kunjungi fasilitas kesehatan terdekat jika kondisi memburuk.</p>
            </div>
        </div>
        @endif

        <!-- Detail Update -->
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-heart-pulse-fill text-danger me-2"></i> Update Kesehatan</span>
                <span class="badge bg-{{ $update->kondisi_color }}" style="font-size:0.9rem;">
                    Kondisi: {{ ucfirst($update->kondisi_umum) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Informasi Dasar -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check me-2"></i>Informasi Dasar</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">Tanggal Update</small>
                                    <strong>{{ $update->tanggal_update->format('d F Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#f0f9ff;">
                                    <small class="text-muted d-block mb-1">Waktu Input</small>
                                    <strong>{{ $update->created_at->format('d F Y, H:i') }} WIB</strong>
                                    <div class="mt-1">
                                        <small class="text-muted">({{ $update->created_at->diffForHumans() }})</small>
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
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-left-text me-2"></i>Keluhan</h6>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            {{ $update->keluhan }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan Pasien -->
                    @if($update->catatan_pasien)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-journal-text me-2"></i>Catatan Saya</h6>
                        <div class="p-3 rounded-3" style="background:#f0f9ff;">
                            {{ $update->catatan_pasien }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan Bidan -->
                    @if($update->catatan_bidan)
                    <div class="col-12">
                        <h6 class="fw-bold text-success mb-3"><i class="bi bi-person-badge me-2"></i>Catatan dari Bidan</h6>
                        <div class="p-3 rounded-3" style="background:#f0fdf4;border-left:4px solid #10b981;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-chat-quote-fill text-success mt-1"></i>
                                <div>
                                    {{ $update->catatan_bidan }}
                                    @if($update->bidan)
                                        <div class="mt-2">
                                            <small class="text-muted">— {{ $update->bidan->name }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($update->perlu_tindak_lanjut)
                        <div class="alert alert-warning mt-3 mb-0" style="border-radius:12px;">
                            <i class="bi bi-flag-fill me-2"></i>
                            <strong>Perlu Tindak Lanjut:</strong> Silakan jadwalkan kunjungan dengan bidan.
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Info Sumber -->
                    <div class="col-12">
                        <div class="p-3 rounded-3" style="background:#fef3c7;">
                            <small class="text-muted d-block mb-1">Sumber Input</small>
                            <strong>
                                @if($update->sumber_input == 'pasien')
                                    <i class="bi bi-person-fill me-1"></i>Diinput oleh Saya
                                @else
                                    <i class="bi bi-person-badge-fill me-1"></i>Diinput oleh Bidan
                                    @if($update->bidan)
                                        ({{ $update->bidan->name }})
                                    @endif
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="{{ route('pasien.health-updates.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                    </a>
                    <a href="{{ route('pasien.health-updates.create') }}" class="btn btn-danger">
                        <i class="bi bi-plus-lg me-1"></i> Update Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
