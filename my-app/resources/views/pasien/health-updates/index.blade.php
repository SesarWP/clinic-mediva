@extends('layouts.pasien')

@section('title', 'Catatan Kesehatan - Klinik Mediva')
@section('page-title', 'Catatan Kesehatan dan Konsultasi')

@section('content')
<div class="row">
    <!-- Left Column: Update Kesehatan -->
    <div class="col-lg-8 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-1">Catatan Kesehatan Saya</h5>
                <small class="text-muted">Sampaikan keluhan atau kondisi Anda hari ini</small>
            </div>
        </div>

        <!-- Form Keluhan Cepat -->
        <div class="card custom-card bg-off-white shadow-soft rounded-2xl border-0 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('pasien.health-updates.store') }}" method="POST">
                    @csrf
                    <!-- Hidden Required Fields for HealthUpdateController -->
                    <input type="hidden" name="tanggal_update" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="tipe_update" value="harian">
                    <input type="hidden" name="kondisi_umum" value="baik">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-chat-left-text text-primary me-2"></i>Keluhan atau Catatan Hari Ini</label>
                        <textarea name="keluhan" class="form-control rounded-3" rows="3" placeholder="Tuliskan keluhan atau pertanyaan Anda di sini... (Contoh: Saya merasa pusing dan mual sejak pagi)" required></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn fw-bold text-white shadow-sm" style="background: linear-gradient(135deg, #06b6d4, #0ea5e9); border-radius: 10px; padding: 10px 24px;">
                            <i class="bi bi-send-fill me-2"></i>Kirim Keluhan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="fw-bold mb-3 mt-2 text-dark">Riwayat Catatan Kesehatan</h5>

        @if($updates->isEmpty())
            <div class="card custom-card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-heart-pulse" style="font-size:4rem;color:#ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Catatan Kesehatan</h5>
                    <p class="text-muted">Mulai catat keluhan atau kondisi kesehatan Anda di atas.</p>
                </div>
            </div>
        @else
            <!-- Timeline View -->
            <div class="card custom-card">
                <div class="card-body">
                    <div class="timeline">
                        @foreach($updates as $update)
                        <div class="timeline-item mb-4 pb-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex gap-3">
                                <!-- Icon & Date -->
                                <div class="text-center" style="min-width:80px;">
                                    <div class="mb-2">
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                                             style="width:48px;height:48px;background:{{ $update->has_gejala_bahaya ? '#fee2e2' : '#f0f9ff' }};">
                                            <i class="bi bi-heart-pulse-fill" style="font-size:1.3rem;color:{{ $update->has_gejala_bahaya ? '#dc3545' : '#0d6efd' }};"></i>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block">{{ $update->tanggal_update->format('d M') }}</small>
                                    <small class="text-muted">{{ $update->tanggal_update->format('Y') }}</small>
                                </div>

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="badge bg-{{ $update->tipe_update == 'harian' ? 'primary' : 'info' }} me-2">
                                                {{ ucfirst($update->tipe_update) }}
                                            </span>
                                            <span class="badge bg-{{ $update->kondisi_color }}">
                                                {{ ucfirst($update->kondisi_umum) }}
                                            </span>
                                            @if($update->has_gejala_bahaya)
                                                <span class="badge bg-danger ms-1">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Perlu Perhatian
                                                </span>
                                            @endif
                                        </div>
                                        <a href="{{ route('pasien.health-updates.show', $update->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                    </div>

                                    <!-- Tanda Vital -->
                                    @if($update->suhu_tubuh || $update->tekanan_darah)
                                    <div class="mb-2">
                                        <small class="text-muted">Tanda Vital:</small>
                                        @if($update->suhu_tubuh)
                                            <span class="badge bg-light text-dark ms-1">
                                                <i class="bi bi-thermometer-half me-1"></i>{{ $update->suhu_tubuh }}°C
                                            </span>
                                        @endif
                                        @if($update->tekanan_darah)
                                            <span class="badge bg-light text-dark ms-1">
                                                <i class="bi bi-heart me-1"></i>{{ $update->tekanan_darah }} mmHg
                                            </span>
                                        @endif
                                    </div>
                                    @endif

                                    <!-- Gejala -->
                                    @if(!empty($update->gejala_list))
                                    <div class="mb-2">
                                        <small class="text-muted">Gejala:</small>
                                        @foreach($update->gejala_list as $gejala)
                                            <span class="badge bg-warning text-dark ms-1">{{ $gejala }}</span>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Keluhan -->
                                    @if($update->keluhan)
                                    <div class="p-2 rounded-3 mt-2" style="background:#f8f9fa;">
                                        <small class="text-muted d-block mb-1">Keluhan:</small>
                                        <small>{{ Str::limit($update->keluhan, 150) }}</small>
                                    </div>
                                    @endif

                                    <!-- Catatan Bidan -->
                                    @if($update->catatan_bidan)
                                    <div class="p-2 rounded-3 mt-2" style="background:#f0f9ff;border-left:3px solid #0d6efd;">
                                        <small class="text-primary fw-semibold d-block mb-1">
                                            <i class="bi bi-person-badge me-1"></i>Catatan Bidan:
                                        </small>
                                        <small>{{ $update->catatan_bidan }}</small>
                                    </div>
                                    @endif

                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>{{ $update->created_at->diffForHumans() }}
                                            @if($update->sumber_input == 'bidan' && $update->bidan)
                                                · Input oleh {{ $update->bidan->name }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($updates->hasPages())
                    <div class="mt-4">
                        {{ $updates->links() }}
                    </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Right Column: Chat Bidan -->
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-4 border-0 mb-4 sticky-top" style="top: 20px;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-dots-fill text-primary me-2"></i>Tanya Bidan</h5>
                <span class="badge {{ isset($messageCount) && $messageCount >= 3 ? 'bg-danger' : 'bg-primary' }} rounded-pill">
                    Sisa Kuota: {{ max(0, 3 - ($messageCount ?? 0)) }}x
                </span>
            </div>
            <div class="card-body p-4">
                <!-- Chat Messages -->
                <div class="chat-container mb-4" style="max-height: 400px; overflow-y: auto; scroll-behavior: smooth;">
                    @forelse($consultations ?? [] as $chat)
                        @if($chat->sender_role == 'pasien')
                            <!-- Pasien Message (Right) -->
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white p-3 rounded-4 rounded-bottom-0 shadow-sm" style="max-width: 85%;">
                                    {{ $chat->message }}
                                    <div class="text-end text-white-50 mt-1" style="font-size: 0.7rem;">{{ $chat->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <!-- Bidan Message (Left) -->
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bg-light text-dark p-3 rounded-4 rounded-bottom-0 shadow-sm border" style="max-width: 85%;">
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
                            <p class="text-muted small mt-2 mb-0">Anda memiliki batas maksimal mengirim <strong>3 pesan</strong> ke bidan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input -->
                @if(isset($isLocked) && $isLocked)
                <div class="alert alert-danger border-0 rounded-3 text-center mb-0 fw-semibold">
                    <i class="bi bi-lock-fill d-block mb-1 fs-4"></i>
                    Sesi dikunci. Bidan meminta Anda segera datang ke klinik untuk pemeriksaan langsung.
                </div>
                @elseif(!isset($messageCount) || $messageCount < 3)
                <form action="{{ route('pasien.health-updates.chat') }}" method="POST">
                    @csrf
                    <div class="input-group shadow-sm rounded-pill">
                        <input type="text" name="message" class="form-control bg-light border-0 rounded-start-pill ps-4 py-2" placeholder="Ketik pesan..." required>
                        <button class="btn btn-primary rounded-end-pill px-3 py-2" type="submit">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle me-1"></i><strong>Batas maksimal 3 pesan.</strong> Hanya untuk keluhan ringan. Jika darurat, segera ke klinik.</small>
                </div>
                @else
                <div class="alert alert-warning border-warning border-start border-4 rounded-3 text-center mb-0" style="font-size: 0.85rem;">
                    <i class="bi bi-lock-fill d-block mb-1 fs-4"></i>
                    <strong>Sesi habis.</strong> Kunjungi klinik untuk pemeriksaan.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll chat to bottom
        var chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endpush
