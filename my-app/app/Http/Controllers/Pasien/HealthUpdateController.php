<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\HealthUpdate;
use Illuminate\Http\Request;

class HealthUpdateController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;
        
        if (!$patient) {
            return redirect()->route('pasien.dashboard')
                ->with('error', 'Data pasien tidak ditemukan.');
        }

        $updates = $patient->healthUpdates()->paginate(20);
        $consultations = \App\Models\Consultation::where('patient_id', $patient->id)
            ->orderBy('created_at', 'asc')->get();
        $messageCount = \App\Models\Consultation::where('patient_id', $patient->id)
            ->where('sender_role', 'pasien')->count();
        $isLocked = (bool) $patient->requires_clinic_visit;
        
        return view('pasien.health-updates.index', compact('patient', 'updates', 'consultations', 'messageCount', 'isLocked'));
    }

    public function create()
    {
        $patient = auth()->user()->patient;
        
        if (!$patient) {
            return redirect()->route('pasien.dashboard')
                ->with('error', 'Data pasien tidak ditemukan.');
        }

        return view('pasien.health-updates.create', compact('patient'));
    }

    public function store(Request $request)
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            return redirect()->route('pasien.dashboard')
                ->with('error', 'Data pasien tidak ditemukan.');
        }

        $validated = $request->validate([
            'tanggal_update' => 'required|date',
            'tipe_update' => 'required|in:harian,mingguan',
            'keluhan' => 'nullable|string',
            'kondisi_umum' => 'required|in:baik,cukup,kurang',
            'suhu_tubuh' => 'nullable|numeric|min:35|max:42',
            'tekanan_darah_sistolik' => 'nullable|integer|min:60|max:250',
            'tekanan_darah_diastolik' => 'nullable|integer|min:40|max:180',
            'mual_muntah' => 'nullable|boolean',
            'pusing' => 'nullable|boolean',
            'nyeri_perut' => 'nullable|boolean',
            'pendarahan' => 'nullable|boolean',
            'kontraksi' => 'nullable|boolean',
            'gerakan_janin_berkurang' => 'nullable|boolean',
            'kualitas_tidur' => 'nullable|in:baik,cukup,buruk',
            'nafsu_makan' => 'nullable|in:baik,cukup,buruk',
            'aktivitas_fisik' => 'nullable|in:ringan,sedang,berat',
            'catatan_pasien' => 'nullable|string',
        ]);

        $validated['patient_id'] = $patient->id;
        $validated['sumber_input'] = 'pasien';
        $validated['perlu_tindak_lanjut'] = false;
        // Pastikan checkbox yang tidak dicentang tersimpan sebagai false
        foreach (['mual_muntah','pusing','nyeri_perut','pendarahan','kontraksi','gerakan_janin_berkurang'] as $flag) {
            $validated[$flag] = $request->boolean($flag);
        }

        $update = HealthUpdate::create($validated);

        $message = 'Update kesehatan berhasil disimpan. Terima kasih!';
        if ($update->has_gejala_bahaya) {
            $message = '⚠️ Update kesehatan tersimpan. Kami mendeteksi gejala yang perlu perhatian. Segera hubungi bidan Anda!';
        }

        return redirect()->route('pasien.health-updates.index')
            ->with($update->has_gejala_bahaya ? 'warning' : 'success', $message);
    }

    public function show(string $id)
    {
        $patient = auth()->user()->patient;
        $update = HealthUpdate::where('patient_id', $patient->id)->findOrFail($id);
        
        return view('pasien.health-updates.show', compact('update', 'patient'));
    }
}
