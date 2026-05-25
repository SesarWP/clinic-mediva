<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Patient::with(['ancExaminations', 'anemiaScreenings']);

        if ($search) {
            $query->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%');
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('bidan.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('bidan.patients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
            'gravida' => 'nullable|integer|min:0',
            'para' => 'nullable|integer|min:0',
            'abortus' => 'nullable|integer|min:0',
            'hpht' => 'nullable|date',
            'taksiran_persalinan' => 'nullable|date',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus pas 16 angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        ]);

        Patient::create($validatedData);

        return redirect()->route('bidan.patients.index')->with('success', 'Data pasien baru berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $patient = Patient::with([
            'ancExaminations.bidan',
            'anemiaScreenings.bidan',
            'healthUpdates.bidan',
            'consultations.bidan',
        ])->findOrFail($id);

        $consultationCount = $patient->consultations
            ->where('sender_role', 'pasien')->count();

        return view('bidan.patients.show', compact('patient', 'consultationCount'));
    }

    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('bidan.patients.edit', compact('patient'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
            'gravida' => 'nullable|integer|min:0',
            'para' => 'nullable|integer|min:0',
            'abortus' => 'nullable|integer|min:0',
            'hpht' => 'nullable|date',
            'taksiran_persalinan' => 'nullable|date',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus pas 16 angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($validatedData);

        return redirect()->route('bidan.patients.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('bidan.patients.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
