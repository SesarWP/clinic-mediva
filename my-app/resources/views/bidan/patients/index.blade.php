@extends('layouts.bidan')

@section('title', 'Data Pasien - Klinik Mediva')
@section('page-title', 'Data Pasien')

@section('content')
<div class="card custom-card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
        <span><i class="bi bi-people-fill text-primary me-2"></i> Daftar Pasien</span>
        <a href="{{ route('bidan.patients.create') }}" class="btn btn-primary btn-sm" id="btn-tambah-pasien">
            <i class="bi bi-plus-lg me-1"></i> Pasien Baru
        </a>
    </div>
    <div class="card-body">
        <!-- Search -->
        <form action="{{ route('bidan.patients.index') }}" method="GET" class="mb-4">
            <div class="input-group" style="max-width:400px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}" style="border-radius:10px 0 0 10px;" id="search-pasien">
                <button class="btn btn-primary" type="submit" style="border-radius:0 10px 10px 0;" id="btn-search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Usia</th>
                        <th>Usia Kehamilan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $index => $patient)
                    <tr>
                        <td class="text-center">{{ $patients->firstItem() + $index }}</td>
                        <td><code>{{ $patient->nik }}</code></td>
                        <td>
                            <div class="fw-semibold">{{ $patient->nama_lengkap }}</div>
                            <small class="text-muted">{{ $patient->no_hp ?: '-' }}</small>
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
                            <div class="d-flex gap-1">
                                <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('bidan.patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('bidan.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pasien ini?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size:2rem;"></i>
                            <p class="mt-2 mb-0">Data pasien tidak ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection
