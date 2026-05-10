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
                <a href="{{ route('bidan.anc.create', $patient->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-clipboard-plus me-1"></i> ANC</a>
                <a href="{{ route('bidan.screening.create', $patient->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-droplet me-1"></i> Screening</a>
                <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info btn-sm"><i class="bi bi-heart-pulse me-1"></i> Update Kesehatan</a>
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
<div class="card custom-card">
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

<!-- Riwayat Update Kesehatan -->
<div class="card custom-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-heart-pulse-fill text-info me-2"></i> Update Kesehatan Harian/Mingguan</span>
        <div class="d-flex gap-2">
            <a href="{{ route('bidan.health-updates.index', $patient->id) }}" class="btn btn-outline-info btn-sm"><i class="bi bi-list-ul"></i> Lihat Semua</a>
            <a href="{{ route('bidan.health-updates.create', $patient->id) }}" class="btn btn-info btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body p-0">
        @php
            $recentUpdates = $patient->healthUpdates()->take(5)->get();
        @endphp
        @if($recentUpdates->isEmpty())
            <div class="text-center text-muted py-4">Belum ada update kesehatan</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Kondisi</th>
                            <th>Tanda Vital</th>
                            <th>Gejala</th>
                            <th>Sumber</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUpdates as $update)
                        <tr class="{{ $update->has_gejala_bahaya ? 'table-danger' : '' }}">
                            <td>{{ $update->tanggal_update->format('d/m/Y') }}</td>
                            <td><span class="badge bg-{{ $update->tipe_update == 'harian' ? 'primary' : 'info' }}">{{ ucfirst($update->tipe_update) }}</span></td>
                            <td><span class="badge bg-{{ $update->kondisi_color }}">{{ ucfirst($update->kondisi_umum) }}</span></td>
                            <td>
                                <small>
                                    @if($update->suhu_tubuh)
                                        <span class="{{ $update->suhu_tubuh >= 38 ? 'text-danger fw-bold' : '' }}">{{ $update->suhu_tubuh }}°C</span><br>
                                    @endif
                                    @if($update->tekanan_darah)
                                        <span class="{{ $update->tekanan_darah_sistolik >= 140 ? 'text-danger fw-bold' : '' }}">{{ $update->tekanan_darah }} mmHg</span>
                                    @endif
                                    @if(!$update->suhu_tubuh && !$update->tekanan_darah) - @endif
                                </small>
                            </td>
                            <td>
                                @if(!empty($update->gejala_list))
                                    <small>
                                        @foreach(array_slice($update->gejala_list, 0, 2) as $gejala)
                                            <span class="badge bg-warning text-dark">{{ $gejala }}</span>
                                        @endforeach
                                        @if(count($update->gejala_list) > 2)
                                            <span class="badge bg-secondary">+{{ count($update->gejala_list) - 2 }}</span>
                                        @endif
                                    </small>
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                            <td><small>{{ ucfirst($update->sumber_input) }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bidan.health-updates.show', $update->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bidan.health-updates.edit', $update->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('bidan.health-updates.destroy', $update->id) }}" method="POST" onsubmit="return confirm('Hapus update kesehatan ini?');">
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
@endsection
