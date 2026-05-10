@extends('layouts.bidan')

@section('title', 'Pilih Pasien - Screening Anemia')
@section('page-title', 'Screening Anemia')

@section('content')
<div class="custom-card">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-droplet-fill text-danger" style="font-size:1.25rem;"></i>
        <span>Pilih Pasien untuk Screening Anemia</span>
    </div>
    <div class="card-body">
        <p class="text-muted mb-4">Pilih pasien yang akan dilakukan screening anemia (pemeriksaan kadar hemoglobin)</p>

        <!-- Search -->
        <form action="{{ route('bidan.screening.select-patient') }}" method="GET" class="mb-4">
            <div class="input-group" style="max-width:450px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK pasien..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th style="width:100px;">Usia</th>
                        <th style="width:150px;">Usia Kehamilan</th>
                        <th style="width:150px;">Status</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $index => $patient)
                    <tr>
                        <td class="text-center fw-semibold">{{ $patients->firstItem() + $index }}</td>
                        <td><code style="font-size:0.85rem;">{{ $patient->nik }}</code></td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $patient->nama_lengkap }}</div>
                            @if($patient->no_hp)
                                <small class="text-muted"><i class="bi bi-telephone me-1"></i>{{ $patient->no_hp }}</small>
                            @endif
                        </td>
                        <td>{{ $patient->usia ? $patient->usia . ' thn' : '-' }}</td>
                        <td>{{ $patient->usia_kehamilan ?: '-' }}</td>
                        <td>
                            @if($patient->is_risiko_tinggi)
                                <span class="badge bg-danger bg-opacity-10 text-danger badge-risk">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Risiko Tinggi
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success badge-risk">
                                    <i class="bi bi-check-circle-fill me-1"></i> Normal
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bidan.screening.create', $patient->id) }}" class="btn btn-sm btn-danger">
                                <i class="bi bi-droplet me-1"></i> Screening Anemia
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox" style="font-size:3rem;opacity:0.3;"></i>
                                <p class="mt-3 mb-0 fw-semibold">Data pasien tidak ditemukan</p>
                                <small>Silakan coba kata kunci pencarian lain</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($patients->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $patients->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
