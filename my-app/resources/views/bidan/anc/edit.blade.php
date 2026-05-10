@extends('layouts.bidan')

@section('title', 'Edit ANC - Klinik Mediva')
@section('page-title', 'Edit Pemeriksaan ANC')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Edit ANC</li>
            </ol>
        </nav>

        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-pencil-square text-warning me-2"></i>
                Edit ANC — <strong>{{ $patient->nama_lengkap }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.anc.update', $anc->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Tanggal Periksa <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_periksa" class="form-control @error('tanggal_periksa') is-invalid @enderror" value="{{ old('tanggal_periksa', $anc->tanggal_periksa->format('Y-m-d')) }}">
                            @error('tanggal_periksa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Usia Kehamilan (minggu) <span class="text-danger">*</span></label>
                            <input type="number" name="usia_kehamilan_minggu" class="form-control @error('usia_kehamilan_minggu') is-invalid @enderror" value="{{ old('usia_kehamilan_minggu', $anc->usia_kehamilan_minggu) }}" min="1" max="45">
                            @error('usia_kehamilan_minggu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Berat Badan (kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.1" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror" value="{{ old('berat_badan', $anc->berat_badan) }}">
                            @error('berat_badan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">TD Sistolik <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="tekanan_darah_sistolik" class="form-control" value="{{ old('tekanan_darah_sistolik', $anc->tekanan_darah_sistolik) }}">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">TD Diastolik <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="tekanan_darah_diastolik" class="form-control" value="{{ old('tekanan_darah_diastolik', $anc->tekanan_darah_diastolik) }}">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Tinggi Fundus</label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="tinggi_fundus" class="form-control" value="{{ old('tinggi_fundus', $anc->tinggi_fundus) }}">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">LILA</label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="lingkar_lengan_atas" class="form-control" value="{{ old('lingkar_lengan_atas', $anc->lingkar_lengan_atas) }}">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">DJJ</label>
                            <div class="input-group">
                                <input type="number" name="denyut_jantung_janin" class="form-control" value="{{ old('denyut_jantung_janin', $anc->denyut_jantung_janin) }}">
                                <span class="input-group-text">bpm</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jadwal Kunjungan Berikutnya</label>
                            <input type="date" name="jadwal_kunjungan_berikutnya" class="form-control" value="{{ old('jadwal_kunjungan_berikutnya', $anc->jadwal_kunjungan_berikutnya?->format('Y-m-d')) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="2">{{ old('keluhan', $anc->keluhan) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Bidan</label>
                        <textarea name="catatan_bidan" class="form-control" rows="2">{{ old('catatan_bidan', $anc->catatan_bidan) }}</textarea>
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
@endsection
