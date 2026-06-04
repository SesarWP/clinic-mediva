@extends('layouts.pasien')

@section('title', 'Lengkapi Profil - Klinik Mediva')
@section('page-title', 'Lengkapi Data Diri')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-person-lines-fill me-2"></i> Lengkapi Data Medis Anda
            </div>
            <div class="card-body p-4">
                
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i> Silakan lengkapi data NIK dan Tanggal Lahir Anda. Data ini sangat penting untuk rekam medis dan Buku KIA Anda.
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pasien.setup-profile.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK" required>
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Pastikan NIK yang Anda masukkan sudah benar karena tidak dapat diubah nantinya.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP / WhatsApp</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat domisili">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-save me-1"></i> Simpan Data & Lanjutkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
