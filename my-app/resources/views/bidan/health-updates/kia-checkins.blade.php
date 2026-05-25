@extends('layouts.bidan')

@section('title', 'Riwayat Check-in KIA - Klinik Mediva')
@section('page-title', 'Riwayat Check-in KIA')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bidan.patients.show', $patient->id) }}">{{ $patient->nama_lengkap }}</a></li>
        <li class="breadcrumb-item active">Riwayat Check-in KIA</li>
    </ol>
</nav>

<!-- Card Riwayat Check-in KIA -->
<div class="card custom-card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <span><i class="bi bi-journal-medical text-primary me-2"></i> Riwayat Check-in KIA</span>
            <div class="text-muted small mt-1">Riwayat pengisian Buku KIA harian/mingguan oleh pasien.</div>
        </div>
        <a href="{{ route('bidan.patients.show', $patient->id) }}"
           class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body p-0">
        @if($checkins->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-journal-x d-block mb-3" style="font-size:3rem;opacity:0.35;"></i>
                <p class="mb-0">Belum ada data check-in KIA dari pasien ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Trimester</th>
                            <th>Status</th>
                            <th>Tanda Bahaya</th>
                            <th>Catatan Tindak Lanjut</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checkins as $checkin)
                        @php $answers = json_decode($checkin->answers, true); @endphp
                        <tr>
                            <td class="text-nowrap">
                                <span class="fw-semibold">{{ $checkin->created_at->format('d M Y') }}</span><br>
                                <small class="text-muted">{{ $checkin->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info rounded-pill">TM {{ $checkin->trimester }}</span>
                            </td>
                            <td>
                                @if($checkin->is_safe)
                                    <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3">
                                        <i class="bi bi-shield-check me-1"></i>Aman
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Bahaya
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if(!$checkin->is_safe && is_array($answers) && count($answers))
                                    <ul class="mb-0 ps-3 small text-danger">
                                        @foreach($answers as $ans)
                                            <li>{{ $ans }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <small class="text-muted">—</small>
                                @endif
                            </td>
                            <td>
                                @if($checkin->bidan_note)
                                    <div class="text-muted small border-start border-3 border-primary ps-2 fst-italic">
                                        "{{ \Illuminate\Support\Str::limit($checkin->bidan_note, 60) }}"
                                    </div>
                                @else
                                    <small class="text-black-50">— Belum ada catatan</small>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary rounded-pill btn-eksekusi"
                                        data-bs-toggle="modal"
                                        data-bs-target="#dynamicNoteModal"
                                        data-id="{{ $checkin->id }}"
                                        data-date="{{ $checkin->created_at->format('d M Y') }}"
                                        data-note="{{ $checkin->bidan_note }}">
                                    <i class="bi bi-pencil-square me-1"></i>Eksekusi
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3">
                {{ $checkins->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Catatan Bidan -->
<div class="modal fade text-start" id="dynamicNoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Tindak Lanjut Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="dynamicNoteForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted small mb-3">
                        Catatan klinis untuk check-in tanggal
                        <span id="modalDateTarget" class="fw-bold text-dark"></span>.
                    </p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Klinis Bidan</label>
                        <textarea id="modalNoteInput" name="bidan_note"
                                  class="form-control rounded-3"
                                  rows="4"
                                  placeholder="Tulis catatan atau tindakan yang sudah dilakukan..."
                                  required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i>Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pindahkan modal ke body agar z-index backdrop tidak bermasalah
        const modal = document.getElementById('dynamicNoteModal');
        if (modal) document.body.appendChild(modal);

        // Inject data ke modal secara dinamis
        document.querySelectorAll('.btn-eksekusi').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('modalDateTarget').textContent = this.dataset.date;
                document.getElementById('modalNoteInput').value = this.dataset.note || '';
                document.getElementById('dynamicNoteForm').action =
                    "{{ url('bidan/kia-checkins') }}/" + this.dataset.id + "/note";
            });
        });
    });
</script>
@endpush
