@extends('layouts.pasien')

@section('title', 'Profil Saya - Klinik Mediva')
@section('page-title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header">
                <i class="bi bi-person-fill text-primary me-2"></i> Edit Profil
            </div>
            <div class="card-body">
                <form action="{{ route('pasien.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4 text-center">
                        <div class="position-relative d-inline-block">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile Photo" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: linear-gradient(135deg, #06b6d4, #0ea5e9); color: white; font-size: 3rem; border: 4px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <label for="profile_photo" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2" style="cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); border: 2px solid white;">
                                <i class="bi bi-camera-fill" style="font-size: 1rem;"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="mt-2 small text-muted">Klik ikon kamera untuk mengubah foto profil</div>
                        @error('profile_photo')
                            <div class="text-danger mt-2 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        function previewImage(event) {
                            const input = event.target;
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const container = input.closest('.position-relative');
                                    let img = container.querySelector('img');
                                    if (!img) {
                                        img = document.createElement('img');
                                        img.className = 'rounded-circle';
                                        img.style = 'width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);';
                                        const div = container.querySelector('div.rounded-circle');
                                        if (div) div.replaceWith(img);
                                    }
                                    img.src = e.target.result;
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $patient->nama_lengkap) }}">
                        @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP (WA)</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $patient->no_hp) }}">
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $patient->alamat) }}</textarea>
                    </div>

                    <hr>
                    <h6 class="fw-bold text-muted mb-3">Informasi (tidak dapat diubah)</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" class="form-control" value="{{ $patient->nik }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="text" class="form-control" value="{{ $patient->tanggal_lahir->format('d M Y') }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Golongan Darah</label>
                            <input type="text" class="form-control" value="{{ $patient->golongan_darah ?: '-' }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">HPHT</label>
                            <input type="text" class="form-control" value="{{ $patient->hpht ? $patient->hpht->format('d M Y') : '-' }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Taksiran Persalinan</label>
                            <input type="text" class="form-control" value="{{ $patient->taksiran_persalinan ? $patient->taksiran_persalinan->format('d M Y') : '-' }}" disabled>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
