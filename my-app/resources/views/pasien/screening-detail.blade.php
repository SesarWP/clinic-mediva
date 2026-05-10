@extends('layouts.pasien')

@section('title', 'Detail Screening Anemia - Klinik Mediva')
@section('page-title', 'Detail Screening Anemia')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pasien.screening') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <span class="badge bg-danger" style="font-size:0.9rem;">
                Screening Anemia
            </span>
        </div>

        <!-- Detail Screening Anemia -->
        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-droplet-fill text-danger me-2"></i> Detail Screening Anemia
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
                                    <strong class="text-danger" style="font-size:1.5rem;">{{ $screening->kadar_hb }} g/dL</strong>
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
                                    " style="font-size:1.2rem;">
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
                                mt-1" style="font-size:1.5rem;"></i>
                                <div>
                                    <strong>Interpretasi:</strong>
                                    <p class="mb-0 mt-1">
                                        @if($screening->status_anemia == 'normal')
                                            Kadar hemoglobin Anda dalam batas normal (≥ 11 g/dL). Anda tidak mengalami anemia. Pertahankan pola makan sehat dan konsumsi makanan kaya zat besi.
                                        @elseif($screening->status_anemia == 'ringan')
                                            Anda mengalami anemia ringan (10-10.9 g/dL). Diperlukan suplementasi zat besi dan monitoring berkala. Konsumsi tablet Fe sesuai anjuran bidan dan perbanyak makanan kaya zat besi.
                                        @elseif($screening->status_anemia == 'sedang')
                                            Anda mengalami anemia sedang (7-9.9 g/dL). Memerlukan penanganan medis dan suplementasi intensif. Segera konsultasi dengan dokter dan ikuti anjuran bidan.
                                        @else
                                            Anda mengalami anemia berat (< 7 g/dL). Memerlukan penanganan medis segera dan mungkin perlu rujukan ke rumah sakit. Segera hubungi bidan atau ke fasilitas kesehatan terdekat.
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
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <small class="text-muted d-block mb-1">Diperiksa Oleh</small>
                            <strong>{{ $screening->bidan->name }}</strong>
                            <div class="mt-1">
                                <small class="text-muted">{{ $screening->created_at->format('d F Y, H:i') }} WIB</small>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Mengatasi Anemia -->
                    @if($screening->status_anemia != 'normal')
                    <div class="col-12">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-lightbulb me-2"></i>Tips Mengatasi Anemia</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#f0fdf4;">
                                    <strong class="text-success d-block mb-2">✓ Makanan Kaya Zat Besi:</strong>
                                    <ul class="mb-0" style="font-size:0.9rem;">
                                        <li>Daging merah, hati, ayam</li>
                                        <li>Sayuran hijau (bayam, kangkung)</li>
                                        <li>Kacang-kacangan</li>
                                        <li>Telur</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background:#fef3c7;">
                                    <strong class="text-warning d-block mb-2">⚠️ Yang Perlu Dihindari:</strong>
                                    <ul class="mb-0" style="font-size:0.9rem;">
                                        <li>Minum teh/kopi saat makan</li>
                                        <li>Makanan tinggi kalsium bersamaan dengan Fe</li>
                                        <li>Melewatkan makan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <a href="{{ route('pasien.screening') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
