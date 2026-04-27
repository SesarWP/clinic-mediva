<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\AncExamination;
use App\Models\AnemiaScreening;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Patient::count();
        $kunjunganHariIni = AncExamination::whereDate('tanggal_periksa', Carbon::today())->count();
        $pasienAnemia = AnemiaScreening::where('status_anemia', '!=', 'normal')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('anemia_screenings')
                    ->groupBy('patient_id');
            })->count();

        // Pasien dengan kunjungan hari ini
        $kunjunganHariIniList = AncExamination::with('patient')
            ->whereDate('tanggal_periksa', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        // Pasien berisiko tinggi (ambil semua pasien dan filter)
        $semuaPasien = Patient::with(['ancExaminations', 'anemiaScreenings'])->get();
        $pasienRisikoTinggi = $semuaPasien->filter(function ($patient) {
            return $patient->is_risiko_tinggi;
        });

        // Jadwal kunjungan mendatang (7 hari ke depan)
        $jadwalMendatang = AncExamination::with('patient')
            ->whereNotNull('jadwal_kunjungan_berikutnya')
            ->whereBetween('jadwal_kunjungan_berikutnya', [Carbon::today(), Carbon::today()->addDays(7)])
            ->orderBy('jadwal_kunjungan_berikutnya', 'asc')
            ->get();

        return view('bidan.dashboard', compact(
            'totalPasien',
            'kunjunganHariIni',
            'pasienAnemia',
            'kunjunganHariIniList',
            'pasienRisikoTinggi',
            'jadwalMendatang'
        ));
    }
}
