@extends('layouts.bidan')

@section('title', 'Detail Pasien - Klinik Mediva')
@section('page-title', 'Detail Pasien')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bidan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bidan.patients.index') }}">Data Pasien</a></li>
        <li class="breadcrumb-item active">{{ $patient->nama_lengkap }}</li>
    </ol>
</nav>

<!-- Profil Pasien -->
<div class="card custom-card mb-4">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#6f42c1,#0d6efd);display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;font-weight:700;">
                    {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $patient->nama_lengkap }}
                        @if($patient->is_risiko_tinggi)
                            <span class="badge bg-danger ms-2" style="font-size:0.7rem;">RISIKO TINGGI</span>
                        @endif
                    </h4>
                    <small class="text-muted">NIK: {{ $patient->nik }} · {{ $patient->usia }} tahun · Gol. Darah: {{ $patient->golongan_darah ?: '-' }}</small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('bidan.patients.edit', $patient->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="row g-3 mt-3">
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#f0f9ff;">
                    <small class="text-muted d-block">Kehamilan (G/P/A)</small>
                    <strong>G{{ $patient->gravida ?? 0 }}P{{ $patient->para ?? 0 }}A{{ $patient->abortus ?? 0 }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#f0fdf4;">
                    <small class="text-muted d-block">Usia Kehamilan</small>
                    <strong>{{ $patient->usia_kehamilan ?: '-' }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#fefce8;">
                    <small class="text-muted d-block">HPHT</small>
                    <strong>{{ $patient->hpht ? $patient->hpht->format('d M Y') : '-' }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3" style="background:#fdf2f8;">
                    <small class="text-muted d-block">Taksiran Persalinan</small>
                    <strong>{{ $patient->taksiran_persalinan ? $patient->taksiran_persalinan->format('d M Y') : '-' }}</strong>
                </div>
            </div>
        </div>

        @if($patient->is_risiko_tinggi)
        <div class="alert alert-danger d-flex align-items-start gap-2 mt-3 mb-0" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill mt-1"></i>
            <div>
                <strong>Faktor Risiko:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($patient->alasan_risiko as $alasan)
                        <li>{{ $alasan }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Riwayat ANC -->
<div class="card custom-card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i> Riwayat Pemeriksaan ANC</span>
        <a href="{{ route('bidan.anc.create', $patient->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
    <div class="card-body p-0">
        @if($patient->ancExaminations->isEmpty())
            <div class="text-center text-muted py-4">Belum ada pemeriksaan ANC</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>UK</th>
                            <th>TD</th>
                            <th>BB</th>
                            <th>TFU</th>
                            <th>LILA</th>
                            <th>DJJ</th>
                            <th>Bidan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->ancExaminations as $anc)
                        <tr>
                            <td>{{ $anc->tanggal_periksa->format('d/m/Y') }}</td>
                            <td>{{ $anc->usia_kehamilan_minggu }} mg</td>
                            <td>
                                <span class="{{ $anc->is_hipertensi ? 'text-danger fw-bold' : '' }}">
                                    {{ $anc->tekanan_darah_sistolik }}/{{ $anc->tekanan_darah_diastolik }}
                                </span>
                            </td>
                            <td>{{ $anc->berat_badan }} kg</td>
                            <td>{{ $anc->tinggi_fundus ? $anc->tinggi_fundus.' cm' : '-' }}</td>
                            <td>
                                @if($anc->lingkar_lengan_atas)
                                    <span class="{{ $anc->lingkar_lengan_atas < 23.5 ? 'text-danger fw-bold' : '' }}">{{ $anc->lingkar_lengan_atas }} cm</span>
                                @else - @endif
                            </td>
                            <td>{{ $anc->denyut_jantung_janin ?: '-' }}</td>
                            <td><small>{{ $anc->bidan->name }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.anc.show', $anc->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.anc.edit', $anc->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.anc.destroy', $anc->id) }}" method="POST" onsubmit="return confirm('Hapus data ANC ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Riwayat Screening Anemia -->
<div class="card custom-card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-droplet-fill text-danger me-2"></i> Riwayat Screening Anemia</span>
        <a href="{{ route('bidan.screening.create', $patient->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
    <div class="card-body p-0">
        @if($patient->anemiaScreenings->isEmpty())
            <div class="text-center text-muted py-4">Belum ada screening anemia</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kadar HB</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                            <th>Bidan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->anemiaScreenings as $screening)
                        <tr>
                            <td>{{ $screening->tanggal_screening->format('d/m/Y') }}</td>
                            <td><strong>{{ $screening->kadar_hb }} g/dL</strong></td>
                            <td>
                                @php
                                    $colors = ['normal'=>'success','ringan'=>'warning','sedang'=>'orange','berat'=>'danger'];
                                    $c = $colors[$screening->status_anemia] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $c == 'orange' ? 'warning' : $c }} {{ $c == 'warning' ? 'text-dark' : '' }} badge-risk">
                                    {{ ucfirst($screening->status_anemia) }}
                                </span>
                            </td>
                            <td><small>{{ $screening->tindakan ?: '-' }}</small></td>
                            <td><small>{{ $screening->bidan->name }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.screening.show', $screening->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.screening.edit', $screening->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.screening.destroy', $screening->id) }}" method="POST" onsubmit="return confirm('Hapus data screening ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Riwayat Catatan Kesehatan -->
<div class="card custom-card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-notes-medical text-info me-2"></i> Riwayat Catatan Kesehatan</span>
        <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info btn-sm text-white"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
    <div class="card-body p-0">
        @if($patient->healthUpdates->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="bi bi-journal-x d-block mb-2" style="font-size:2rem;"></i>
                Belum ada catatan kesehatan dari pasien.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="min-width:90px;">Tanggal</th>
                            <th style="min-width:110px;">Kondisi Umum</th>
                            <th style="min-width:160px;">Gejala Tercatat</th>
                            <th style="min-width:180px;">Catatan / Keluhan Pasien</th>
                            <th style="min-width:80px;">Sumber</th>
                            <th style="min-width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->healthUpdates as $update)
                        <tr>
                            <td class="text-nowrap">{{ $update->tanggal_update->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $kondisiColor = match($update->kondisi_umum ?? '') {
                                        'baik'   => 'success',
                                        'cukup'  => 'warning',
                                        'kurang' => 'danger',
                                        default  => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $kondisiColor }} badge-risk">
                                    {{ ucfirst($update->kondisi_umum ?? '-') }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $gejalaBahaya = [];
                                    $gejalaRingan = [];

                                    if (!empty($update->pendarahan))              $gejalaBahaya[] = 'Pendarahan';
                                    if (!empty($update->kontraksi))               $gejalaBahaya[] = 'Kontraksi';
                                    if (!empty($update->gerakan_janin_berkurang)) $gejalaBahaya[] = 'Gerakan Janin ↓';
                                    if (!empty($update->nyeri_perut))             $gejalaBahaya[] = 'Nyeri Perut';

                                    if (!empty($update->mual_muntah))             $gejalaRingan[] = 'Mual/Muntah';
                                    if (!empty($update->pusing))                  $gejalaRingan[] = 'Pusing';
                                @endphp

                                @if(empty($gejalaBahaya) && empty($gejalaRingan))
                                    <span class="text-muted small">— Tidak ada gejala</span>
                                @else
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($gejalaBahaya as $g)
                                            <span class="badge bg-danger" style="font-size:0.72rem;">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $g }}
                                            </span>
                                        @endforeach
                                        @foreach($gejalaRingan as $g)
                                            <span class="badge bg-warning text-dark" style="font-size:0.72rem;">
                                                {{ $g }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $keluhan     = trim($update->keluhan ?? '');
                                    $catatan     = trim($update->catatan_pasien ?? '');
                                    $gabungan    = implode(' · ', array_filter([$keluhan, $catatan]));
                                @endphp
                                <small class="text-muted">
                                    {{ $gabungan ? \Illuminate\Support\Str::limit($gabungan, 90) : '—' }}
                                </small>
                            </td>
                            <td>
                                <small>
                                    @if($update->sumber_input === 'bidan')
                                        <span class="badge bg-primary-subtle text-primary">Bidan</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">Pasien</span>
                                    @endif
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.health-updates.show', $update->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.health-updates.edit', $update->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.health-updates.destroy', $update->id) }}" method="POST" onsubmit="return confirm('Hapus catatan kesehatan ini?');" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Buku KIA Interaktif & Konsultasi -->
<div class="row g-4 mb-4">

    <!-- Riwayat Check-in KIA -->
    <div class="col-lg-7">
        <div class="card custom-card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-journal-medical text-primary me-2"></i> Riwayat Check-in KIA</span>
                <a href="{{ route('bidan.kia-checkins.index', $patient->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-right-circle me-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @php
                    $checkins = $patient->kiaCheckins->take(5);
                @endphp
                @if($checkins->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-journal-x d-block mb-2" style="font-size:2.5rem;opacity:0.4;"></i>
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
                                    <th>Catatan Bidan</th>
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
                                    <td><span class="badge bg-info rounded-pill">TM {{ $checkin->trimester }}</span></td>
                                    <td>
                                        @if($checkin->is_safe)
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-2">
                                                <i class="bi bi-shield-check me-1"></i>Aman
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-2">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Bahaya
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($checkin->bidan_note)
                                            <small class="text-muted fst-italic border-start border-3 border-primary ps-2">
                                                "{{ \Illuminate\Support\Str::limit($checkin->bidan_note, 40) }}"
                                            </small>
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
                                            <i class="bi bi-pencil-square"></i> Eksekusi
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Konsultasi Pasien -->
    <div class="col-lg-5">
        <div class="card custom-card h-100 d-flex flex-column">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-chat-dots-fill text-primary me-2"></i> Konsultasi Pasien</span>
                <span class="badge rounded-pill px-3 py-1 {{ $consultationCount >= 3 ? 'bg-danger' : 'bg-success' }}">
                    Batas: {{ $consultationCount }}/3
                </span>
            </div>
            <div class="card-body p-3 d-flex flex-column flex-grow-1">

                {{-- Area chat --}}
                <div class="chat-container rounded-3 mb-3 p-3 flex-grow-1"
                     style="background:#f8fafc;min-height:280px;max-height:380px;overflow-y:auto;display:flex;flex-direction:column;gap:10px;">
                    @forelse($patient->consultations as $msg)
                        @if($msg->sender_role === 'pasien')
                            <div class="d-flex align-items-end gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white fw-bold"
                                     style="width:30px;height:30px;min-width:30px;background:linear-gradient(135deg,#6f42c1,#0d6efd);font-size:0.72rem;">
                                    {{ strtoupper(substr($patient->nama_lengkap, 0, 1)) }}
                                </div>
                                <div style="max-width:80%;">
                                    <div class="fw-semibold text-primary mb-1" style="font-size:0.75rem;">{{ $patient->nama_lengkap }}</div>
                                    <div class="rounded-3 px-3 py-2 bg-white border shadow-sm" style="font-size:0.87rem;line-height:1.5;">
                                        {{ $msg->message }}
                                    </div>
                                    <div class="text-muted mt-1" style="font-size:0.7rem;">{{ $msg->created_at->format('d M, H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex align-items-end justify-content-end gap-2">
                                <div style="max-width:80%;">
                                    <div class="rounded-3 px-3 py-2 text-white shadow-sm" style="background:linear-gradient(135deg,#0375C4,#0ea5e9);font-size:0.87rem;line-height:1.5;">
                                        {{ $msg->message }}
                                    </div>
                                    <div class="text-muted mt-1 text-end" style="font-size:0.7rem;">{{ $msg->bidan->name ?? 'Bidan' }} · {{ $msg->created_at->format('d M, H:i') }}</div>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white"
                                     style="width:30px;height:30px;min-width:30px;background:linear-gradient(135deg,#0375C4,#0ea5e9);">
                                    <i class="bi bi-person-badge-fill" style="font-size:0.8rem;"></i>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-100 d-flex align-items-center justify-content-center text-muted flex-grow-1">
                            <div class="text-center">
                                <i class="bi bi-chat-square-text d-block mb-2" style="font-size:2rem;opacity:0.35;"></i>
                                <p class="mb-0 small">Belum ada percakapan.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Form & Aksi --}}
                @if($patient->requires_clinic_visit)
                    <div class="alert alert-danger border-0 rounded-3 text-center fw-semibold mb-0 py-2">
                        <i class="bi bi-lock-fill me-1"></i> Sesi terkunci — pasien wajib ke klinik.
                    </div>
                @else
                    <form action="{{ route('bidan.consultations.reply', $patient->id) }}" method="POST" class="mb-2">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message"
                                   class="form-control bg-light border-0 rounded-start-pill ps-4"
                                   placeholder="Ketik balasan..."
                                   required>
                            <button class="btn btn-primary rounded-end-pill px-3" type="submit" title="Kirim">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                    @if($consultationCount >= 3)
                        <div class="text-center mb-2">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 w-100">
                                <i class="bi bi-exclamation-circle me-1"></i> Batas 3 pesan pasien telah tercapai.
                            </span>
                        </div>
                    @endif
                    <form action="{{ route('bidan.patients.require-visit', $patient->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold"
                                onclick="return confirm('Kunci konsultasi dan minta pasien segera ke klinik?')">
                            <i class="bi bi-hospital me-1"></i> Tandai Wajib Kunjungan Klinik
                        </button>
                    </form>
                @endif
            </div>
        </div>
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
                    <p class="text-muted small mb-3">Catatan klinis untuk check-in tanggal <span id="modalDateTarget" class="fw-bold"></span>.</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Klinis Bidan</label>
                        <textarea id="modalNoteInput" name="bidan_note" class="form-control rounded-3" rows="4" placeholder="Tulis catatan atau tindakan..." required></textarea>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-scroll chat ke bawah
        const chatContainer = document.querySelector('.chat-container');
        if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;

        // Modal catatan bidan — inject data dinamis
        document.querySelectorAll('.btn-eksekusi').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('modalDateTarget').textContent = this.dataset.date;
                document.getElementById('modalNoteInput').value = this.dataset.note || '';
                document.getElementById('dynamicNoteForm').action =
                    "{{ url('bidan/kia-checkins') }}/" + this.dataset.id + "/note";
            });
        });

        // Pindahkan modal ke body agar z-index backdrop tidak bermasalah
        const modal = document.getElementById('dynamicNoteModal');
        if (modal) document.body.appendChild(modal);
    });
</script>
@endpush
