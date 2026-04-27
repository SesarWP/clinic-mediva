<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return view('pasien.no-data');
        }

        $patient->load(['ancExaminations.bidan', 'anemiaScreenings.bidan']);

        // Jadwal kunjungan berikutnya
        $jadwalBerikutnya = $patient->ancExaminations
            ->whereNotNull('jadwal_kunjungan_berikutnya')
            ->where('jadwal_kunjungan_berikutnya', '>=', now()->toDateString())
            ->sortBy('jadwal_kunjungan_berikutnya')
            ->first();

        // Screening terakhir
        $screeningTerakhir = $patient->anemiaScreenings->first();

        // ANC terakhir
        $ancTerakhir = $patient->ancExaminations->first();

        return view('pasien.dashboard', compact('patient', 'jadwalBerikutnya', 'screeningTerakhir', 'ancTerakhir'));
    }

    public function riwayat()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return view('pasien.no-data');
        }

        $examinations = $patient->ancExaminations()->with('bidan')->paginate(10);

        return view('pasien.riwayat', compact('patient', 'examinations'));
    }

    public function screening()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return view('pasien.no-data');
        }

        $screenings = $patient->anemiaScreenings()->with('bidan')->paginate(10);

        return view('pasien.screening', compact('patient', 'screenings'));
    }
}
