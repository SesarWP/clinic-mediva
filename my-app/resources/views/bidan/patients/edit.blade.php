@extends('layouts.bidan')

@section('title', 'Edit Pasien - Klinik Mediva')
@section('page-title', 'Edit Data Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-pencil-square text-warning me-2"></i> Edit Data: {{ $patient->nama_lengkap }}
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-vcard me-1"></i> Data Diri</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK KTP <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $patient->nik) }}" maxlength="16">
                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $patient->nama_lengkap) }}">
                            @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $patient->tanggal_lahir?->format('Y-m-d')) }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">No. HP (WA)</label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $patient->no_hp) }}">
                            @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach(['A', 'B', 'AB', 'O'] as $gol)
                                    <option value="{{ $gol }}" {{ old('golongan_darah', $patient->golongan_darah) == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $patient->alamat) }}</textarea>
                    </div>

                    <hr class="my-4">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-heart-pulse me-1"></i> Data Kehamilan</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Gravida (G)</label>
                            <input type="number" name="gravida" class="form-control" value="{{ old('gravida', $patient->gravida) }}" min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Para (P)</label>
                            <input type="number" name="para" class="form-control" value="{{ old('para', $patient->para) }}" min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Abortus (A)</label>
                            <input type="number" name="abortus" class="form-control" value="{{ old('abortus', $patient->abortus) }}" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">HPHT</label>
                            <input type="date" name="hpht" class="form-control" value="{{ old('hpht', $patient->hpht?->format('Y-m-d')) }}" id="hpht-input">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Taksiran Persalinan</label>
                            <input type="date" name="taksiran_persalinan" class="form-control" value="{{ old('taksiran_persalinan', $patient->taksiran_persalinan?->format('Y-m-d')) }}" id="tp-input">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('bidan.patients.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i> Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('hpht-input')?.addEventListener('change', function() {
        const hpht = new Date(this.value);
        if (!isNaN(hpht)) {
            hpht.setDate(hpht.getDate() + 7);
            hpht.setMonth(hpht.getMonth() + 9);
            document.getElementById('tp-input').value = hpht.toISOString().split('T')[0];
        }
    });
</script>
@endpush
@endsection
