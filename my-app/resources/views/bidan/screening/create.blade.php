@extends('layouts.bidan')

@section('title', 'Screening Anemia - Klinik Mediva')
@section('page-title', 'Screening Anemia')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-droplet-fill" style="font-size:1.3rem;color:#F76D6C;"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Screening Anemia</h5>
                        <small class="text-muted">{{ $patient->nama_lengkap }}</small>
                    </div>
                </div>
                <span class="badge bg-light text-dark border">NIK: {{ $patient->nik }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.screening.store', $patient->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Screening <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_screening" class="form-control @error('tanggal_screening') is-invalid @enderror" value="{{ old('tanggal_screening', date('Y-m-d')) }}">
                            @error('tanggal_screening') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kadar Hemoglobin (HB) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="kadar_hb" class="form-control @error('kadar_hb') is-invalid @enderror" value="{{ old('kadar_hb') }}" id="kadar-hb-input" placeholder="Contoh: 11.5">
                                <span class="input-group-text">g/dL</span>
                            </div>
                            @error('kadar_hb') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Auto Status Preview -->
                    <div class="alert d-none mb-4" id="status-preview" style="border-left:4px solid;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle-fill" style="font-size:1.2rem;"></i>
                            <div>
                                <strong>Status Anemia:</strong> <span id="status-text"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Terkait Pemeriksaan ANC</label>
                        <select name="anc_examination_id" class="form-select">
                            <option value="">-- Tidak terkait dengan pemeriksaan ANC --</option>
                            @foreach($ancExaminations as $anc)
                                <option value="{{ $anc->id }}" {{ old('anc_examination_id') == $anc->id ? 'selected' : '' }}>
                                    {{ $anc->tanggal_periksa->format('d/m/Y') }} - Usia Kehamilan {{ $anc->usia_kehamilan_minggu }} minggu
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Opsional: Hubungkan dengan pemeriksaan ANC jika ada</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tindak Lanjut</label>
                        <textarea name="tindakan" class="form-control" rows="3" placeholder="Contoh: Pemberian tablet Fe 2x1, konseling gizi, rujukan ke dokter...">{{ old('tindakan') }}</textarea>
                        <small class="text-muted">Tindakan yang diberikan kepada pasien</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan lain yang perlu dicatat...">{{ old('catatan') }}</textarea>
                    </div>

                    <!-- Reference Table -->
                    <div class="p-4 rounded-3 mb-4" style="background:#FFF3F0;border:1px solid #F76D6C20;">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-info-circle-fill" style="color:#F76D6C;"></i>
                            <strong style="color:#10606A;">Klasifikasi Anemia pada Ibu Hamil (WHO)</strong>
                        </div>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="p-2 rounded text-center" style="background:white;border:2px solid #10b981;">
                                    <div class="badge bg-success mb-1">Normal</div>
                                    <div class="fw-bold" style="color:#10606A;">≥ 11 g/dL</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 rounded text-center" style="background:white;border:2px solid #f59e0b;">
                                    <div class="badge bg-warning text-dark mb-1">Ringan</div>
                                    <div class="fw-bold" style="color:#10606A;">10 - 10.9</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 rounded text-center" style="background:white;border:2px solid #f97316;">
                                    <div class="badge text-white mb-1" style="background:#f97316;">Sedang</div>
                                    <div class="fw-bold" style="color:#10606A;">7 - 9.9</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 rounded text-center" style="background:white;border:2px solid #F76D6C;">
                                    <div class="badge mb-1" style="background:#F76D6C;color:white;">Berat</div>
                                    <div class="fw-bold" style="color:#10606A;">&lt; 7 g/dL</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-lg me-1"></i> Simpan Screening
                        </button>
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
    
    if (isNaN(hb) || hb <= 0) { 
        preview.classList.add('d-none'); 
        return; 
    }
    
    preview.classList.remove('d-none');
    let status, cls, borderColor;
    
    if (hb >= 11) { 
        status = 'Normal'; 
        cls = 'alert-success'; 
        borderColor = '#10b981';
    } else if (hb >= 10) { 
        status = 'Anemia Ringan'; 
        cls = 'alert-warning'; 
        borderColor = '#f59e0b';
    } else if (hb >= 7) { 
        status = 'Anemia Sedang'; 
        cls = 'alert-danger'; 
        borderColor = '#f97316';
    } else { 
        status = 'Anemia Berat'; 
        cls = 'alert-danger'; 
        borderColor = '#F76D6C';
    }
    
    preview.className = 'alert mb-4 ' + cls;
    preview.style.borderLeft = '4px solid ' + borderColor;
    text.textContent = status + ' (' + hb.toFixed(1) + ' g/dL)';
});
</script>
@endpush
@endsection
