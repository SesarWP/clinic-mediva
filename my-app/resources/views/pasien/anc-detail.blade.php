@extends('layouts.pasien')

@section('title', 'Detail Pemeriksaan ANC - Klinik Mediva')
@section('page-title', 'Detail Pemeriksaan ANC')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <span class="badge bg-primary" style="font-size:0.9rem;">
                Pemeriksaan ANC
            </span>
        </div>

        <!-- Detail Pemeriksaan ANC -->
        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i> Detail Pemeriksaan ANC
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
                                    <strong class="{{ $anc->is_hipertensi ? 'text-danger' : '' }}" style="font-size:1.2rem;">
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

                    <!-- Keluhan -->
                    @if($anc->keluhan)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-left-text me-2"></i>Keluhan Saya</h6>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            {{ $anc->keluhan }}
                        </div>
                    </div>
                    @endif

                    <!-- Catatan Bidan -->
                    @if($anc->catatan_bidan)
                    <div class="col-12">
                        <h6 class="fw-bold text-success mb-3"><i class="bi bi-person-badge me-2"></i>Catatan dari Bidan</h6>
                        <div class="p-3 rounded-3" style="background:#f0fdf4;border-left:4px solid #10b981;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-chat-quote-fill text-success mt-1"></i>
                                <div>
                                    {{ $anc->catatan_bidan }}
                                    <div class="mt-2">
                                        <small class="text-muted">— {{ $anc->bidan->name }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Jadwal Berikutnya -->
                    @if($anc->jadwal_kunjungan_berikutnya)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check me-2"></i>Jadwal Kunjungan Berikutnya</h6>
                        <div class="p-3 rounded-3 text-center" style="background:#fefce8;">
                            <div style="font-size:2rem;color:#eab308;">
                                <i class="bi bi-calendar-event-fill"></i>
                            </div>
                            <strong style="font-size:1.3rem;">{{ $anc->jadwal_kunjungan_berikutnya->format('d F Y') }}</strong>
                            <div class="mt-1">
                                <small class="text-muted">{{ $anc->jadwal_kunjungan_berikutnya->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Info Petugas -->
                    <div class="col-12">
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <small class="text-muted d-block mb-1">Diperiksa Oleh</small>
                            <strong>{{ $anc->bidan->name }}</strong>
                            <div class="mt-1">
                                <small class="text-muted">{{ $anc->created_at->format('d F Y, H:i') }} WIB</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
