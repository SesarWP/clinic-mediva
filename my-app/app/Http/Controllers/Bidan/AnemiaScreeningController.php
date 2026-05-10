<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\AnemiaScreening;
use App\Models\AncExamination;
use Illuminate\Http\Request;

class AnemiaScreeningController extends Controller
{
    public function selectPatient(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $patients = $query->orderBy('nama_lengkap')->paginate(10);
        return view('bidan.screening.select-patient', compact('patients'));
    }

    public function create(string $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $ancExaminations = AncExamination::where('patient_id', $patientId)
            ->orderBy('tanggal_periksa', 'desc')
            ->get();
        return view('bidan.screening.create', compact('patient', 'ancExaminations'));
    }

    public function store(Request $request, string $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $validated = $request->validate([
            'tanggal_screening' => 'required|date',
            'kadar_hb' => 'required|numeric|min:1|max:20',
            'anc_examination_id' => 'nullable|exists:anc_examinations,id',
            'tindakan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ], [
            'tanggal_screening.required' => 'Tanggal screening wajib diisi.',
            'kadar_hb.required' => 'Kadar HB wajib diisi.',
            'kadar_hb.numeric' => 'Kadar HB harus berupa angka.',
        ]);

        // Auto-calculate status anemia
        $validated['status_anemia'] = AnemiaScreening::hitungStatusAnemia((float) $validated['kadar_hb']);
        $validated['patient_id'] = $patient->id;
        $validated['bidan_id'] = auth()->id();

        AnemiaScreening::create($validated);

        return redirect()->route('bidan.patients.show', $patient->id)
            ->with('success', 'Data screening anemia berhasil disimpan. Status: ' . ucfirst($validated['status_anemia']));
    }

    public function show(string $id)
    {
        $screening = AnemiaScreening::with(['patient', 'bidan', 'ancExamination'])->findOrFail($id);
        $patient = $screening->patient;
        return view('bidan.screening.show', compact('screening', 'patient'));
    }

    public function edit(string $id)
    {
        $screening = AnemiaScreening::with('patient')->findOrFail($id);
        $patient = $screening->patient;
        $ancExaminations = AncExamination::where('patient_id', $patient->id)
            ->orderBy('tanggal_periksa', 'desc')
            ->get();
        return view('bidan.screening.edit', compact('screening', 'patient', 'ancExaminations'));
    }

    public function update(Request $request, string $id)
    {
        $screening = AnemiaScreening::findOrFail($id);

        $validated = $request->validate([
            'tanggal_screening' => 'required|date',
            'kadar_hb' => 'required|numeric|min:1|max:20',
            'anc_examination_id' => 'nullable|exists:anc_examinations,id',
            'tindakan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $validated['status_anemia'] = AnemiaScreening::hitungStatusAnemia((float) $validated['kadar_hb']);

        $screening->update($validated);

        return redirect()->route('bidan.patients.show', $screening->patient_id)
            ->with('success', 'Data screening anemia berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $screening = AnemiaScreening::findOrFail($id);
        $patientId = $screening->patient_id;
        $screening->delete();

        return redirect()->route('bidan.patients.show', $patientId)
            ->with('success', 'Data screening anemia berhasil dihapus.');
    }
}
