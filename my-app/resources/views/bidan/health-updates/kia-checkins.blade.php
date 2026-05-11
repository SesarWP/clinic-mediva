@extends('layouts.bidan')

@section('title', 'Data KIA & Konsultasi - Klinik Mediva')
@section('page-title', 'Data KIA & Konsultasi')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
        <li class="breadcrumb-item active">Data KIA & Konsultasi</li>
    </ol>
</nav>

<div class="row g-4">
    <!-- Patient Progress Timeline (Left Column) -->
    <div class="col-lg-7">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 px-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-journal-medical text-primary me-2"></i>Riwayat Check-in KIA</h5>
                <p class="text-muted small mt-1 mb-0">Riwayat pengisian Buku KIA harian/mingguan oleh pasien.</p>
            </div>
            <div class="card-body p-4 pt-0">
                @if($checkins->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-journal-x text-black-50 mb-3 d-block" style="font-size: 3rem;"></i>
                        <p>Belum ada data check-in KIA dari pasien ini.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="rounded-start">Tanggal</th>
                                    <th>Trimester</th>
                                    <th>Status</th>
                                    <th>Catatan Tindak Lanjut</th>
                                    <th class="rounded-end text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($checkins as $checkin)
                                    @php 
                                        $answers = json_decode($checkin->answers, true); 
                                    @endphp
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">{{ $checkin->created_at->format('d M Y') }}</span><br>
                                            <small class="text-muted">{{ $checkin->created_at->format('H:i') }}</small>
                                        </td>
                                        <td><span class="badge bg-info rounded-pill">TM {{ $checkin->trimester }}</span></td>
                                        <td>
                                            @if($checkin->is_safe)
                                                <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3"><i class="bi bi-shield-check me-1"></i>Aman</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3"><i class="bi bi-exclamation-triangle-fill me-1"></i>Bahaya</span>
                                                <div class="mt-1 small text-danger">
                                                    @foreach($answers as $ans)
                                                        <div>- {{ $ans }}</div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($checkin->bidan_note)
                                                <div class="text-muted small border-start border-3 border-primary ps-2 fst-italic">
                                                    "{{ Str::limit($checkin->bidan_note, 50) }}"
                                                </div>
                                            @else
                                                <span class="text-black-50 small">- Belum ada catatan -</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill btn-eksekusi" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#dynamicNoteModal"
                                                data-id="{{ $checkin->id }}"
                                                data-date="{{ $checkin->created_at->format('d M Y') }}"
                                                data-note="{{ $checkin->bidan_note }}">
                                                <i class="bi bi-pencil-square"></i> Eksekusi
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $checkins->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Consultation Management (Right Column) -->
    <div class="col-lg-5">
        <div class="card shadow-sm rounded-4 border-0 d-flex flex-column" style="height: 100%;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-dots-fill text-primary me-2"></i>Konsultasi Pasien</h5>
                <span class="badge {{ $messageCount >= 3 ? 'bg-danger' : 'bg-success' }} rounded-pill px-3 py-2">
                    Batas: {{ $messageCount }}/3
                </span>
            </div>
            
            <div class="card-body p-4 pt-0 flex-grow-1 d-flex flex-column">
                <!-- Chat View -->
                <div class="chat-container mb-4 flex-grow-1 rounded-4 bg-light p-3" style="min-height: 350px; max-height: 500px; overflow-y: auto;">
                    @forelse($consultations as $chat)
                        @if($chat->sender_role == 'bidan')
                            <!-- Bidan Message (Right) -->
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white p-3 rounded-4 rounded-bottom-0 shadow-sm" style="max-width: 85%;">
                                    {{ $chat->message }}
                                    <div class="text-end text-white-50 mt-1" style="font-size: 0.7rem;">{{ $chat->created_at->format('d M, H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <!-- Pasien Message (Left) -->
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bg-white text-dark p-3 rounded-4 rounded-bottom-0 shadow-sm border" style="max-width: 85%;">
                                    <div class="fw-bold text-primary mb-1" style="font-size: 0.8rem;">{{ $patient->nama_lengkap }}</div>
                                    {{ $chat->message }}
                                    <div class="text-start text-muted mt-1" style="font-size: 0.7rem;">{{ $chat->created_at->format('d M, H:i') }}</div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                            <div class="text-center">
                                <i class="bi bi-chat-square-text text-black-50 mb-2" style="font-size: 2rem;"></i>
                                <p class="mb-0">Belum ada percakapan.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Actions -->
                @if($patient->requires_clinic_visit)
                    <div class="alert alert-danger border-0 rounded-4 text-center fw-semibold mb-0">
                        <i class="bi bi-lock-fill me-1"></i> Sesi Terkunci. Pasien wajib datang ke klinik.
                    </div>
                @else
                    <form action="{{ route('bidan.consultations.reply', $patient->id) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control form-control-lg bg-light border-0 rounded-start-pill ps-4" placeholder="Ketik balasan..." required>
                            <button class="btn btn-primary rounded-end-pill px-4" type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>

                    @if($messageCount >= 3)
                        <div class="text-center mb-3">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 w-100"><i class="bi bi-exclamation-circle me-1"></i> Batas 3 pesan pasien telah tercapai.</span>
                        </div>
                    @endif

                    <form action="{{ route('bidan.patients.require-visit', $patient->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold shadow-sm" onclick="return confirm('Kunci konsultasi ini dan minta pasien segera ke klinik?')">
                            <i class="bi bi-hospital me-1"></i> Tandai Wajib Kunjungan Klinik
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Single Dynamic Modal for Bidan Note -->
<div class="modal fade text-start" id="dynamicNoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Tindak Lanjut Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dynamicNoteForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted small mb-3">Tambahkan catatan klinis atau tindakan yang sudah dilakukan untuk check-in tanggal <span id="modalDateTarget" class="fw-bold"></span>.</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Klinis Bidan</label>
                        <textarea id="modalNoteInput" name="bidan_note" class="form-control rounded-3 bg-light" rows="4" placeholder="Tulis catatan atau tindakan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Move modal to body to prevent z-index backdrop issues
        var modal = document.getElementById('dynamicNoteModal');
        if(modal) {
            document.body.appendChild(modal);
        }

        // Handle dynamic modal data injection
        document.querySelectorAll('.btn-eksekusi').forEach(function(button) {
            button.addEventListener('click', function() {
                var checkinId = this.getAttribute('data-id');
                var checkinDate = this.getAttribute('data-date');
                var checkinNote = this.getAttribute('data-note');
                
                document.getElementById('modalDateTarget').textContent = checkinDate;
                document.getElementById('modalNoteInput').value = checkinNote || '';
                
                var form = document.getElementById('dynamicNoteForm');
                form.action = "{{ url('bidan/kia-checkins') }}/" + checkinId + "/note";
            });
        });
    });
</script>
@endpush
