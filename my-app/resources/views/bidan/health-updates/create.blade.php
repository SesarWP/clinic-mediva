@extends('layouts.bidan')

@section('title', 'Input Update Kesehatan - Klinik Mediva')
@section('page-title', 'Input Update Kesehatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
                <li class="breadcrumb-item active">Input Update Kesehatan</li>
            </ol>
        </nav>

        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-heart-pulse-fill text-info me-2"></i>
                Update Kesehatan — <strong>{{ $patient->nama_lengkap }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('bidan.health-updates.store', $patient->id) }}" method="POST">
                    @csrf

                    <!-- Informasi Dasar -->
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check me-1"></i> Informasi Dasar</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Update <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_update" class="form-control @error('tanggal_update') is-invalid @enderror" value="{{ old('tanggal_update', date('Y-m-d')) }}" required>
                            @error('tanggal_update') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tipe Update <span class="text-danger">*</span></label>
                            <select name="tipe_update" class="form-select @error('tipe_update') is-invalid @enderror" required>
                                <option value="harian" {{ old('tipe_update') == 'harian' ? 'selected' : '' }}>Update Harian</option>
                                <option value="mingguan" {{ old('tipe_update') == 'mingguan' ? 'selected' : '' }}>Update Mingguan</option>
                            </select>
                            @error('tipe_update') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kondisi Umum <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kondisi_umum" id="kondisi_baik" value="baik" {{ old('kondisi_umum', 'baik') == 'baik' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="kondisi_baik">
                                    <span class="badge bg-success">Baik</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kondisi_umum" id="kondisi_cukup" value="cukup" {{ old('kondisi_umum') == 'cukup' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kondisi_cukup">
                                    <span class="badge bg-warning text-dark">Cukup</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kondisi_umum" id="kondisi_kurang" value="kurang" {{ old('kondisi_umum') == 'kurang' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kondisi_kurang">
                                    <span class="badge bg-danger">Kurang</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tanda Vital -->
                    <h6 class="fw-bold text-primary mb-3 mt-4"><i class="bi bi-thermometer-half me-1"></i> Tanda Vital</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Suhu Tubuh</label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="suhu_tubuh" class="form-control" value="{{ old('suhu_tubuh') }}" placeholder="36.5">
                                <span class="input-group-text">°C</span>
                            </div>
                            <small class="text-muted">Normal: 36-37.5°C</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">TD Sistolik</label>
                            <div class="input-group">
                                <input type="number" name="tekanan_darah_sistolik" class="form-control" value="{{ old('tekanan_darah_sistolik') }}" placeholder="120">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">TD Diastolik</label>
                            <div class="input-group">
                                <input type="number" name="tekanan_darah_diastolik" class="form-control" value="{{ old('tekanan_darah_diastolik') }}" placeholder="80">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gejala -->
                    <h6 class="fw-bold text-primary mb-3 mt-3"><i class="bi bi-clipboard2-pulse me-1"></i> Gejala yang Dialami</h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mual_muntah" id="mual_muntah" value="1" {{ old('mual_muntah') ? 'checked' : '' }}>
                                <label class="form-check-label" for="mual_muntah">Mual/Muntah</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pusing" id="pusing" value="1" {{ old('pusing') ? 'checked' : '' }}>
                                <label class="form-check-label" for="pusing">Pusing</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nyeri_perut" id="nyeri_perut" value="1" {{ old('nyeri_perut') ? 'checked' : '' }}>
                                <label class="form-check-label" for="nyeri_perut">Nyeri Perut</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input text-danger" type="checkbox" name="pendarahan" id="pendarahan" value="1" {{ old('pendarahan') ? 'checked' : '' }}>
                                <label class="form-check-label text-danger fw-semibold" for="pendarahan">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Pendarahan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input text-danger" type="checkbox" name="kontraksi" id="kontraksi" value="1" {{ old('kontraksi') ? 'checked' : '' }}>
                                <label class="form-check-label text-danger fw-semibold" for="kontraksi">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Kontraksi
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input text-danger" type="checkbox" name="gerakan_janin_berkurang" id="gerakan_janin_berkurang" value="1" {{ old('gerakan_janin_berkurang') ? 'checked' : '' }}>
                                <label class="form-check-label text-danger fw-semibold" for="gerakan_janin_berkurang">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Gerakan Janin Berkurang
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Pola Hidup -->
                    <h6 class="fw-bold text-primary mb-3 mt-4"><i class="bi bi-activity me-1"></i> Pola Hidup</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Kualitas Tidur</label>
                            <select name="kualitas_tidur" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="baik" {{ old('kualitas_tidur') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="cukup" {{ old('kualitas_tidur') == 'cukup' ? 'selected' : '' }}>Cukup</option>
                                <option value="buruk" {{ old('kualitas_tidur') == 'buruk' ? 'selected' : '' }}>Buruk</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Nafsu Makan</label>
                            <select name="nafsu_makan" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="baik" {{ old('nafsu_makan') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="cukup" {{ old('nafsu_makan') == 'cukup' ? 'selected' : '' }}>Cukup</option>
                                <option value="buruk" {{ old('nafsu_makan') == 'buruk' ? 'selected' : '' }}>Buruk</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Aktivitas Fisik</label>
                            <select name="aktivitas_fisik" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="ringan" {{ old('aktivitas_fisik') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                                <option value="sedang" {{ old('aktivitas_fisik') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="berat" {{ old('aktivitas_fisik') == 'berat' ? 'selected' : '' }}>Berat</option>
                            </select>
                        </div>
                    </div>

                    <!-- Keluhan & Catatan -->
                    <h6 class="fw-bold text-primary mb-3 mt-3"><i class="bi bi-chat-left-text me-1"></i> Keluhan & Catatan</h6>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan & Catatan Pasien</label>
                        <textarea name="keluhan" class="form-control" rows="3" placeholder="Tuliskan keluhan dan catatan yang disampaikan pasien...">{{ old('keluhan') }}</textarea>
                        <div class="form-text">Gabungkan keluhan dan catatan pasien dalam satu kolom ini.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Bidan</label>
                        <textarea name="catatan_bidan" class="form-control" rows="2" placeholder="Catatan dan saran untuk pasien...">{{ old('catatan_bidan') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="perlu_tindak_lanjut" id="perlu_tindak_lanjut" value="1" {{ old('perlu_tindak_lanjut') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold text-danger" for="perlu_tindak_lanjut">
                                <i class="bi bi-flag-fill me-1"></i>Perlu Tindak Lanjut
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('bidan.patients.show', $patient->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
                        <button type="submit" class="btn btn-info"><i class="bi bi-check-lg me-1"></i> Simpan Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
