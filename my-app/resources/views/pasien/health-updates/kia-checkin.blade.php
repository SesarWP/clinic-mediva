@extends('layouts.pasien')

@section('title', 'Buku KIA Interaktif - Klinik Mediva')
@section('page-title', 'Buku KIA Interaktif')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Alert Modal for 'Tahukah Ibu?' -->
        @if(session('tahukah_ibu'))
        <div class="modal fade" id="tahukahIbuModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-body text-center p-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-info-subtle rounded-circle" style="width: 80px; height: 80px;">
                                <i class="bi bi-lightbulb-fill text-info" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark mb-3">Tahukah Ibu?</h4>
                        <p class="text-muted fs-5 mb-4">"{{ session('tahukah_ibu') }}"</p>
                        <button type="button" class="btn btn-info text-white rounded-pill px-4 py-2 fw-semibold" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Danger Sign Alert -->
        @if($latestAlert || session('danger_alert'))
        <div class="card shadow-sm rounded-4 bg-danger-subtle border-danger mb-4">
            <div class="card-body p-4 text-center">
                <i class="bi bi-exclamation-triangle-fill text-danger mb-3 d-block" style="font-size: 3rem;"></i>
                <h4 class="fw-bold text-danger mb-2">PERHATIAN MEDIS SEGERA</h4>
                <p class="text-danger-emphasis mb-3">
                    Berdasarkan laporan Anda, kami mendeteksi adanya <strong class="text-danger">Tanda Bahaya Kehamilan</strong>.
                    <br>
                    <strong>Gejala:</strong> {{ $latestAlert ? $latestAlert->red_flag_triggered : 'Gejala Berbahaya Terdeteksi' }}
                </p>
                <div class="alert alert-danger border-0 fw-semibold">
                    Silakan segera kunjungi Klinik Mediva atau fasilitas kesehatan terdekat untuk pemeriksaan komprehensif! Bidan Anda telah dinotifikasi.
                </div>
            </div>
        </div>
        @endif

        <!-- Check-in Card -->
        @if(!$todayCheckin)
        <div class="card shadow-sm rounded-4 border-0 mb-4" style="background: linear-gradient(145deg, #f0f9ff 0%, #e0f2fe 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <span class="badge bg-info text-white rounded-pill px-3 py-2 mb-2">Trimester {{ $trimester }}</span>
                    <h3 class="fw-bold" style="color: #0369a1;">Pemeriksaan Kesehatan Hari Ini</h3>
                    <p class="text-muted">Jawab pertanyaan berikut untuk memantau kondisi ibu dan si kecil.</p>
                </div>

                <form action="{{ route('pasien.health-updates.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3 text-danger"><i class="bi bi-heart-pulse-fill me-2"></i>Apakah ibu mengalami gejala berikut hari ini?</h5>
                        
                        @foreach($redFlags as $index => $flag)
                        <div class="card border-0 shadow-sm rounded-3 mb-3 hover-card transition">
                            <div class="card-body p-3">
                                <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                                    <label class="form-check-label ms-0 fw-medium text-dark flex-grow-1" for="flag_{{ $index }}">
                                        {{ $flag }}
                                    </label>
                                    <input class="form-check-input ms-3 mt-0 fs-5" type="checkbox" role="switch" name="flag_{{ $index }}" id="flag_{{ $index }}" value="1">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white rounded-pill py-3 fw-bold fs-5" style="background-color: #06b6d4; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);">
                            <i class="bi bi-send-check-fill me-2"></i> Simpan Catatan Hari Ini
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <!-- Already Checked In -->
        <div class="card shadow-sm rounded-4 border-0 mb-4 bg-success-subtle">
            <div class="card-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold text-success-emphasis mb-2">Terima Kasih, Ibu!</h4>
                <p class="text-success-emphasis mb-0">Catatan kesehatan hari ini sudah berhasil disimpan. Jangan lupa istirahat yang cukup ya.</p>
            </div>
        </div>
        @endif

        <!-- Consultation Chat Box -->
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-dots-fill text-primary me-2"></i>Tanya Bidan</h5>
                <span class="badge {{ $messageCount >= 3 ? 'bg-danger' : 'bg-secondary' }} rounded-pill">
                    Sesi: {{ $messageCount }}/3
                </span>
            </div>
            <div class="card-body p-4">
                <!-- Chat Messages -->
                <div class="chat-container mb-4" style="max-height: 400px; overflow-y: auto;">
                    @forelse($consultations as $chat)
                        @if($chat->sender_role == 'pasien')
                            <!-- Pasien Message (Right) -->
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white p-3 rounded-4 rounded-bottom-0 shadow-sm" style="max-width: 75%;">
                                    {{ $chat->message }}
                                    <div class="text-end text-white-50 mt-1" style="font-size: 0.7rem;">{{ $chat->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <!-- Bidan Message (Left) -->
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bg-light text-dark p-3 rounded-4 rounded-bottom-0 shadow-sm border" style="max-width: 75%;">
                                    <div class="fw-bold text-primary mb-1" style="font-size: 0.8rem;">Bidan Klinik Mediva</div>
                                    {{ $chat->message }}
                                    <div class="text-start text-muted mt-1" style="font-size: 0.7rem;">{{ $chat->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-muted my-4">
                            <i class="bi bi-chat-heart text-black-50 mb-2 d-block" style="font-size: 2rem;"></i>
                            <small>Punya pertanyaan seputar keluhan ringan? Tanyakan di sini.</small>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input -->
                @if($messageCount < 3)
                <form action="{{ route('pasien.health-updates.chat') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="message" class="form-control form-control-lg bg-light border-0 rounded-start-pill ps-4" placeholder="Ketik pesan Anda..." required>
                        <button class="btn btn-primary rounded-end-pill px-4" type="submit">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
                <div class="text-center mt-2">
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Hanya untuk pertanyaan ringan. Untuk kondisi darurat, segera ke klinik.</small>
                </div>
                @else
                <div class="alert alert-warning border-warning border-start border-4 rounded-3 text-center mb-0">
                    <i class="bi bi-lock-fill me-2"></i>
                    <strong>Sesi diskusi mencapai batas.</strong> Untuk pemeriksaan komprehensif, silakan kunjungi Klinik Mediva.
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        background-color: #cbd5e1;
        border-color: #cbd5e1;
    }
    .form-switch .form-check-input:checked {
        background-color: #ef4444; /* danger red */
        border-color: #ef4444;
    }
    .form-switch .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.25);
    }
    .hover-card:hover {
        transform: translateY(-2px);
        background-color: #f8fafc;
    }
    .transition {
        transition: all 0.2s ease-in-out;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show modal if exists
        var tahukahIbuModal = document.getElementById('tahukahIbuModal');
        if (tahukahIbuModal) {
            var modal = new bootstrap.Modal(tahukahIbuModal);
            modal.show();
        }

        // Scroll chat to bottom
        var chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endpush
