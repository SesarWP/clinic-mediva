@extends('layouts.bidan')

@section('title', 'Pemeriksaan ANC - Klinik Mediva')
@section('page-title', 'Pemeriksaan ANC')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard2-pulse-fill" style="font-size:1.3rem;color:#10606A;"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Pemeriksaan ANC</h5>
                        <small class="text-muted">{{ $patient->nama_lengkap }}</small>
                    </div>
                </div>
                <span class="badge bg-light text-dark border">NIK: {{ $patient->nik }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.anc.store', $patient->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_periksa" class="form-control @error('tanggal_periksa') is-invalid @enderror" value="{{ old('tanggal_periksa', date('Y-m-d')) }}">
                            @error('tanggal_periksa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Usia Kehamilan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="usia_kehamilan_minggu" class="form-control @error('usia_kehamilan_minggu') is-invalid @enderror" value="{{ old('usia_kehamilan_minggu') }}" min="1" max="45" placeholder="Contoh: 20">
                                <span class="input-group-text">minggu</span>
                            </div>
                            @error('usia_kehamilan_minggu') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Berat Badan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror" value="{{ old('berat_badan') }}" placeholder="Contoh: 65.5">
                                <span class="input-group-text">kg</span>
                            </div>
                            @error('berat_badan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-2 mb-3">
                        <h6 class="fw-bold mb-3" style="color:#10606A;">
                            <i class="bi bi-heart-pulse me-2"></i>Tanda Vital
                        </h6>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">TD Sistolik <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="tekanan_darah_sistolik" class="form-control @error('tekanan_darah_sistolik') is-invalid @enderror" value="{{ old('tekanan_darah_sistolik') }}" placeholder="120">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                                @error('tekanan_darah_sistolik') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">TD Diastolik <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="tekanan_darah_diastolik" class="form-control @error('tekanan_darah_diastolik') is-invalid @enderror" value="{{ old('tekanan_darah_diastolik') }}" placeholder="80">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                                @error('tekanan_darah_diastolik') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tinggi Fundus</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="tinggi_fundus" class="form-control" value="{{ old('tinggi_fundus') }}" placeholder="25">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">LILA</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="lingkar_lengan_atas" class="form-control" value="{{ old('lingkar_lengan_atas') }}" placeholder="28">
                                    <span class="input-group-text">cm</span>
                                </div>
                                <small class="text-muted">Lingkar Lengan Atas</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Denyut Jantung Janin (DJJ)</label>
                            <div class="input-group">
                                <input type="number" name="denyut_jantung_janin" class="form-control" value="{{ old('denyut_jantung_janin') }}" placeholder="140">
                                <span class="input-group-text">bpm</span>
                            </div>
                            <small class="text-muted">Normal: 120-160 bpm</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jadwal Kunjungan Berikutnya</label>
                            <input type="date" name="jadwal_kunjungan_berikutnya" class="form-control" value="{{ old('jadwal_kunjungan_berikutnya') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan Pasien</label>
                        <textarea name="keluhan" class="form-control" rows="2" placeholder="Keluhan yang disampaikan pasien...">{{ old('keluhan') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Catatan Bidan</label>
                        <textarea name="catatan_bidan" class="form-control" rows="2" placeholder="Catatan hasil pemeriksaan dan rekomendasi...">{{ old('catatan_bidan') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Simpan Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
