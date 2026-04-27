@extends('layouts.pasien')

@section('title', 'Riwayat Pemeriksaan - Klinik Mediva')
@section('page-title', 'Riwayat Pemeriksaan')

@section('content')
<div class="card custom-card">
    <div class="card-header">
        <i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i> Riwayat Pemeriksaan ANC Saya
    </div>
    <div class="card-body p-0">
        @if($examinations->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox" style="font-size:3rem;"></i>
                <p class="mt-2">Belum ada riwayat pemeriksaan.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>UK</th>
                            <th>Tekanan Darah</th>
                            <th>BB</th>
                            <th>TFU</th>
                            <th>DJJ</th>
                            <th>Keluhan</th>
                            <th>Catatan Bidan</th>
                            <th>Jadwal Berikutnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examinations as $exam)
                        <tr>
                            <td>{{ $exam->tanggal_periksa->format('d/m/Y') }}</td>
                            <td>{{ $exam->usia_kehamilan_minggu }} mg</td>
                            <td>
                                <span class="{{ $exam->is_hipertensi ? 'text-danger fw-bold' : '' }}">
                                    {{ $exam->tekanan_darah_sistolik }}/{{ $exam->tekanan_darah_diastolik }}
                                </span>
                            </td>
                            <td>{{ $exam->berat_badan }} kg</td>
                            <td>{{ $exam->tinggi_fundus ? $exam->tinggi_fundus.' cm' : '-' }}</td>
                            <td>{{ $exam->denyut_jantung_janin ?: '-' }}</td>
                            <td><small>{{ $exam->keluhan ?: '-' }}</small></td>
                            <td><small>{{ $exam->catatan_bidan ?: '-' }}</small></td>
                            <td>
                                @if($exam->jadwal_kunjungan_berikutnya)
                                    <span class="badge bg-primary bg-opacity-10 text-primary badge-risk">
                                        {{ $exam->jadwal_kunjungan_berikutnya->format('d/m/Y') }}
                                    </span>
                                @else - @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center py-3">
                {{ $examinations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
