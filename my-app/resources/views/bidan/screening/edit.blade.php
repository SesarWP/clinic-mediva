@extends('layouts.bidan')

@section('title', 'Edit Screening - Klinik Mediva')
@section('page-title', 'Edit Screening Anemia')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Edit Screening</li>
            </ol>
        </nav>

        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-pencil-square text-warning me-2"></i>
                Edit Screening — <strong>{{ $patient->nama_lengkap }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.screening.update', $screening->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Screening <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_screening" class="form-control" value="{{ old('tanggal_screening', $screening->tanggal_screening->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kadar HB <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="kadar_hb" class="form-control" value="{{ old('kadar_hb', $screening->kadar_hb) }}" id="kadar-hb-input">
                                <span class="input-group-text">g/dL</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert d-none mb-3" id="status-preview" style="border-radius:12px;">
                        <strong>Status: </strong><span id="status-text"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Terkait Pemeriksaan ANC</label>
                        <select name="anc_examination_id" class="form-select">
                            <option value="">-- Tidak terkait --</option>
                            @foreach($ancExaminations as $anc)
                                <option value="{{ $anc->id }}" {{ old('anc_examination_id', $screening->anc_examination_id) == $anc->id ? 'selected' : '' }}>
                                    {{ $anc->tanggal_periksa->format('d/m/Y') }} - UK {{ $anc->usia_kehamilan_minggu }} minggu
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tindak Lanjut</label>
                        <textarea name="tindakan" class="form-control" rows="2">{{ old('tindakan', $screening->tindakan) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $screening->catatan) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('kadar-hb-input')?.addEventListener('input', function() {
    const hb = parseFloat(this.value);
    const preview = document.getElementById('status-preview');
    const text = document.getElementById('status-text');
    if (isNaN(hb) || hb <= 0) { preview.classList.add('d-none'); return; }
    preview.classList.remove('d-none');
    let status, cls;
    if (hb >= 11) { status = 'Normal'; cls = 'alert-success'; }
    else if (hb >= 10) { status = 'Ringan'; cls = 'alert-warning'; }
    else if (hb >= 7) { status = 'Sedang'; cls = 'alert-danger'; }
    else { status = 'Berat'; cls = 'alert-danger'; }
    preview.className = 'alert mb-3 ' + cls;
    preview.style.borderRadius = '12px';
    text.textContent = status + ' (' + hb.toFixed(1) + ' g/dL)';
});
// Trigger on load
document.getElementById('kadar-hb-input')?.dispatchEvent(new Event('input'));
</script>
@endpush
@endsection
