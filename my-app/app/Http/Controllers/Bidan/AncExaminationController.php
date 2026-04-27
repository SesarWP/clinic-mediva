<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\AncExamination;
use Illuminate\Http\Request;

class AncExaminationController extends Controller
{
    public function create(string $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('bidan.anc.create', compact('patient'));
    }

    public function store(Request $request, string $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $validated = $request->validate([
            'tanggal_periksa' => 'required|date',
            'usia_kehamilan_minggu' => 'required|integer|min:1|max:45',
            'tekanan_darah_sistolik' => 'required|integer|min:60|max:250',
            'tekanan_darah_diastolik' => 'required|integer|min:40|max:180',
            'berat_badan' => 'required|numeric|min:20|max:200',
            'tinggi_fundus' => 'nullable|numeric|min:0|max:50',
            'lingkar_lengan_atas' => 'nullable|numeric|min:10|max:50',
            'denyut_jantung_janin' => 'nullable|integer|min:60|max:200',
            'keluhan' => 'nullable|string',
            'catatan_bidan' => 'nullable|string',
            'jadwal_kunjungan_berikutnya' => 'nullable|date|after:today',
        ], [
            'tanggal_periksa.required' => 'Tanggal periksa wajib diisi.',
            'usia_kehamilan_minggu.required' => 'Usia kehamilan wajib diisi.',
            'tekanan_darah_sistolik.required' => 'Tekanan darah sistolik wajib diisi.',
            'tekanan_darah_diastolik.required' => 'Tekanan darah diastolik wajib diisi.',
            'berat_badan.required' => 'Berat badan wajib diisi.',
        ]);

        $validated['patient_id'] = $patient->id;
        $validated['bidan_id'] = auth()->id();

        AncExamination::create($validated);

        return redirect()->route('bidan.patients.show', $patient->id)
            ->with('success', 'Data pemeriksaan ANC berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $anc = AncExamination::with('patient')->findOrFail($id);
        $patient = $anc->patient;
        return view('bidan.anc.edit', compact('anc', 'patient'));
    }

    public function update(Request $request, string $id)
    {
        $anc = AncExamination::findOrFail($id);

        $validated = $request->validate([
            'tanggal_periksa' => 'required|date',
            'usia_kehamilan_minggu' => 'required|integer|min:1|max:45',
            'tekanan_darah_sistolik' => 'required|integer|min:60|max:250',
            'tekanan_darah_diastolik' => 'required|integer|min:40|max:180',
            'berat_badan' => 'required|numeric|min:20|max:200',
            'tinggi_fundus' => 'nullable|numeric|min:0|max:50',
            'lingkar_lengan_atas' => 'nullable|numeric|min:10|max:50',
            'denyut_jantung_janin' => 'nullable|integer|min:60|max:200',
            'keluhan' => 'nullable|string',
            'catatan_bidan' => 'nullable|string',
            'jadwal_kunjungan_berikutnya' => 'nullable|date',
        ]);

        $anc->update($validated);

        return redirect()->route('bidan.patients.show', $anc->patient_id)
            ->with('success', 'Data pemeriksaan ANC berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $anc = AncExamination::findOrFail($id);
        $patientId = $anc->patient_id;
        $anc->delete();

        return redirect()->route('bidan.patients.show', $patientId)
            ->with('success', 'Data pemeriksaan ANC berhasil dihapus.');
    }
}
