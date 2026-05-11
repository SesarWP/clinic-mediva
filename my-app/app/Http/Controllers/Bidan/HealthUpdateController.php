<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\HealthUpdate;
use Illuminate\Http\Request;

class HealthUpdateController extends Controller
{
    public function index(string $patientId)
    {
        $patient = Patient::with(['healthUpdates.bidan'])->findOrFail($patientId);
        $updates = $patient->healthUpdates()->paginate(20);
        
        return view('bidan.health-updates.index', compact('patient', 'updates'));
    }

    public function create(string $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('bidan.health-updates.create', compact('patient'));
    }

    public function store(Request $request, string $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $validated = $request->validate([
            'tanggal_update' => 'required|date',
            'tipe_update' => 'required|in:harian,mingguan',
            'keluhan' => 'nullable|string',
            'kondisi_umum' => 'required|in:baik,cukup,kurang',
            'suhu_tubuh' => 'nullable|numeric|min:35|max:42',
            'tekanan_darah_sistolik' => 'nullable|integer|min:60|max:250',
            'tekanan_darah_diastolik' => 'nullable|integer|min:40|max:180',
            'mual_muntah' => 'boolean',
            'pusing' => 'boolean',
            'nyeri_perut' => 'boolean',
            'pendarahan' => 'boolean',
            'kontraksi' => 'boolean',
            'gerakan_janin_berkurang' => 'boolean',
            'kualitas_tidur' => 'nullable|in:baik,cukup,buruk',
            'nafsu_makan' => 'nullable|in:baik,cukup,buruk',
            'aktivitas_fisik' => 'nullable|in:ringan,sedang,berat',
            'catatan_pasien' => 'nullable|string',
            'catatan_bidan' => 'nullable|string',
            'perlu_tindak_lanjut' => 'boolean',
        ]);

        $validated['patient_id'] = $patient->id;
        $validated['bidan_id'] = auth()->id();
        $validated['sumber_input'] = 'bidan';

        $update = HealthUpdate::create($validated);

        $message = 'Update kesehatan berhasil disimpan.';
        if ($update->has_gejala_bahaya) {
            $message .= ' ⚠️ Terdeteksi gejala bahaya, perlu tindak lanjut segera!';
        }

        return redirect()->route('bidan.patients.show', $patient->id)
            ->with($update->has_gejala_bahaya ? 'warning' : 'success', $message);
    }

    public function show(string $id)
    {
        $update = HealthUpdate::with(['patient', 'bidan'])->findOrFail($id);
        $patient = $update->patient;
        return view('bidan.health-updates.show', compact('update', 'patient'));
    }

    public function edit(string $id)
    {
        $update = HealthUpdate::with('patient')->findOrFail($id);
        $patient = $update->patient;
        return view('bidan.health-updates.edit', compact('update', 'patient'));
    }

    public function update(Request $request, string $id)
    {
        $update = HealthUpdate::findOrFail($id);

        $validated = $request->validate([
            'tanggal_update' => 'required|date',
            'tipe_update' => 'required|in:harian,mingguan',
            'keluhan' => 'nullable|string',
            'kondisi_umum' => 'required|in:baik,cukup,kurang',
            'suhu_tubuh' => 'nullable|numeric|min:35|max:42',
            'tekanan_darah_sistolik' => 'nullable|integer|min:60|max:250',
            'tekanan_darah_diastolik' => 'nullable|integer|min:40|max:180',
            'mual_muntah' => 'boolean',
            'pusing' => 'boolean',
            'nyeri_perut' => 'boolean',
            'pendarahan' => 'boolean',
            'kontraksi' => 'boolean',
            'gerakan_janin_berkurang' => 'boolean',
            'kualitas_tidur' => 'nullable|in:baik,cukup,buruk',
            'nafsu_makan' => 'nullable|in:baik,cukup,buruk',
            'aktivitas_fisik' => 'nullable|in:ringan,sedang,berat',
            'catatan_pasien' => 'nullable|string',
            'catatan_bidan' => 'nullable|string',
            'perlu_tindak_lanjut' => 'boolean',
        ]);

        $update->update($validated);

        return redirect()->route('bidan.patients.show', $update->patient_id)
            ->with('success', 'Update kesehatan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $update = HealthUpdate::findOrFail($id);
        $patientId = $update->patient_id;
        $update->delete();

        return redirect()->route('bidan.patients.show', $patientId)
            ->with('success', 'Update kesehatan berhasil dihapus.');
    }

    // ============================================
    // GAMIFIED KIA TRACKING METHODS
    // ============================================

    public function resolveAlert(string $alertId)
    {
        $alert = \App\Models\KiaAlert::findOrFail($alertId);
        $alert->update(['is_resolved' => true]);

        return back()->with('success', 'Peringatan tanda bahaya berhasil ditandai selesai.');
    }

    public function kiaCheckins(string $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $checkins = \App\Models\KiaCheckin::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $consultations = \App\Models\Consultation::where('patient_id', $patientId)
            ->orderBy('created_at', 'asc')
            ->get();
        $messageCount = \App\Models\Consultation::where('patient_id', $patientId)->where('sender_role', 'pasien')->count();

        return view('bidan.health-updates.kia-checkins', compact('patient', 'checkins', 'consultations', 'messageCount'));
    }

    public function storeKiaNote(Request $request, string $checkinId)
    {
        $request->validate(['bidan_note' => 'required|string']);
        
        $checkin = \App\Models\KiaCheckin::findOrFail($checkinId);
        $checkin->update(['bidan_note' => $request->bidan_note]);

        return back()->with('success', 'Tindak lanjut / Catatan klinis berhasil disimpan.');
    }

    public function replyConsultation(Request $request, string $patientId)
    {
        $request->validate(['message' => 'required|string']);
        
        \App\Models\Consultation::create([
            'patient_id' => $patientId,
            'bidan_id' => auth()->id(),
            'sender_role' => 'bidan',
            'message' => $request->message
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    public function requireClinicVisit(string $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $patient->update(['requires_clinic_visit' => true]);

        // Send an automated chat message
        \App\Models\Consultation::create([
            'patient_id' => $patientId,
            'bidan_id' => auth()->id(),
            'sender_role' => 'bidan',
            'message' => '⚠️ [SISTEM] Bidan meminta Anda untuk segera melakukan kunjungan langsung ke Klinik Mediva untuk pemeriksaan komprehensif.'
        ]);

        return back()->with('success', 'Pasien telah ditandai untuk wajib kunjungan klinik.');
    }
}
