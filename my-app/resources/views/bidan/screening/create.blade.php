@extends('layouts.bidan')

@section('title', 'Screening Anemia - Klinik Mediva')
@section('page-title', 'Input Screening Anemia')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-droplet-fill text-danger me-2"></i>
                Screening Anemia — <strong>{{ $patient->nama_lengkap }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.screening.store', $patient->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Screening <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_screening" class="form-control @error('tanggal_screening') is-invalid @enderror" value="{{ old('tanggal_screening', date('Y-m-d')) }}">
                            @error('tanggal_screening') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kadar Hemoglobin (HB) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="kadar_hb" class="form-control @error('kadar_hb') is-invalid @enderror" value="{{ old('kadar_hb') }}" id="kadar-hb-input">
                                <span class="input-group-text">g/dL</span>
                            </div>
                            @error('kadar_hb') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Auto Status Preview -->
                    <div class="alert d-none mb-3" id="status-preview" style="border-radius:12px;">
                        <strong>Status Anemia: </strong><span id="status-text"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Terkait Pemeriksaan ANC</label>
                        <select name="anc_examination_id" class="form-select">
                            <option value="">-- Tidak terkait --</option>
                            @foreach($ancExaminations as $anc)
                                <option value="{{ $anc->id }}" {{ old('anc_examination_id') == $anc->id ? 'selected' : '' }}>
                                    {{ $anc->tanggal_periksa->format('d/m/Y') }} - UK {{ $anc->usia_kehamilan_minggu }} minggu
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tindak Lanjut</label>
                        <textarea name="tindakan" class="form-control" rows="2" placeholder="Misalnya: tablet Fe 2x1, konseling gizi...">{{ old('tindakan') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan') }}</textarea>
                    </div>

                    <!-- Reference Table -->
                    <div class="p-3 rounded-3 mb-4" style="background:#f8f9fa;font-size:0.85rem;">
                        <strong><i class="bi bi-info-circle me-1"></i> Klasifikasi Anemia (WHO):</strong>
                        <div class="row mt-2">
                            <div class="col-6 col-md-3"><span class="badge bg-success">Normal</span> ≥ 11 g/dL</div>
                            <div class="col-6 col-md-3"><span class="badge bg-warning text-dark">Ringan</span> 10 - 10.9</div>
                            <div class="col-6 col-md-3"><span class="badge" style="background:#fd7e14;color:white;">Sedang</span> 7 - 9.9</div>
                            <div class="col-6 col-md-3"><span class="badge bg-danger">Berat</span> &lt; 7 g/dL</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Simpan Screening</button>
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
</script>
@endpush
@endsection
