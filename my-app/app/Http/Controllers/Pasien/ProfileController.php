<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return view('pasien.no-data');
        }

        return view('pasien.profil', compact('patient'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return redirect()->route('pasien.dashboard');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|numeric',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        $patient->update($validated);

        return redirect()->route('pasien.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
