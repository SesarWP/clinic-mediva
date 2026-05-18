@extends('layouts.pasien')

@section('title', 'Riwayat Update Kesehatan - Klinik Mediva')
@section('page-title', 'Riwayat Update Kesehatan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-1">Update Kesehatan Saya</h5>
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

        <h5 class="fw-bold mb-3 mt-2 text-dark">Riwayat Update Kesehatan</h5>

        @if($updates->isEmpty())
            <div class="card custom-card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-heart-pulse" style="font-size:4rem;color:#ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Update Kesehatan</h5>
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
</div>
@endsection
