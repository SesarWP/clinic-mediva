@extends('layouts.pasien')

@section('title', 'Screening Anemia - Klinik Mediva')
@section('page-title', 'Hasil Screening Anemia')

@section('content')
<div class="card custom-card">
    <div class="card-header">
        <i class="bi bi-droplet-fill text-danger me-2"></i> Riwayat Screening Anemia Saya
    </div>
    <div class="card-body p-0">
        @if($screenings->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-droplet" style="font-size:3rem;"></i>
                <p class="mt-2">Belum ada hasil screening anemia.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kadar HB</th>
                            <th>Status</th>
                            <th>Tindak Lanjut</th>
                            <th>Diperiksa Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($screenings as $s)
                        <tr>
                            <td>{{ $s->tanggal_screening->format('d/m/Y') }}</td>
                            <td><strong>{{ $s->kadar_hb }} g/dL</strong></td>
                            <td>
                                @php
                                    $colors = ['normal'=>'success','ringan'=>'warning','sedang'=>'danger','berat'=>'danger'];
                                    $c = $colors[$s->status_anemia] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $c }} {{ $c == 'warning' ? 'text-dark' : '' }} badge-risk">
                                    {{ ucfirst($s->status_anemia) }}
                                </span>
                            </td>
                            <td><small>{{ Str::limit($s->tindakan, 50) ?: '-' }}</small></td>
                            <td><small>{{ $s->bidan->name }}</small></td>
                            <td>
                                <a href="{{ route('pasien.screening.detail', $s->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center py-3">
                {{ $screenings->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Info Card -->
<div class="card custom-card mt-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Tentang Anemia pada Kehamilan</h6>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="p-3 rounded-3 text-center" style="background:#d1fae5;">
                    <span class="badge bg-success mb-2">Normal</span>
                    <div class="fw-bold">≥ 11 g/dL</div>
                    <small class="text-muted">Kadar HB baik</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 rounded-3 text-center" style="background:#fef3c7;">
                    <span class="badge bg-warning text-dark mb-2">Ringan</span>
                    <div class="fw-bold">10 - 10.9 g/dL</div>
                    <small class="text-muted">Perlu suplemen Fe</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 rounded-3 text-center" style="background:#fed7aa;">
                    <span class="badge" style="background:#fd7e14;color:white;" class="mb-2">Sedang</span>
                    <div class="fw-bold">7 - 9.9 g/dL</div>
                    <small class="text-muted">Konsultasi dokter</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 rounded-3 text-center" style="background:#fecaca;">
                    <span class="badge bg-danger mb-2">Berat</span>
                    <div class="fw-bold">&lt; 7 g/dL</div>
                    <small class="text-muted">Perlu transfusi</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
