<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetupProfileController extends Controller
{
    /**
     * Tampilkan form untuk melengkapi profil pasien.
     */
    public function create()
    {
        $user = Auth::user();

        // Jika user sudah memiliki data pasien, arahkan kembali ke dashboard
        if ($user->patient) {
            return redirect()->route('pasien.dashboard');
        }

        return view('pasien.setup-profile');
    }

    /**
     * Simpan data pasien baru ke dalam database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek lagi untuk menghindari double submission
        if ($user->patient) {
            return redirect()->route('pasien.dashboard');
        }

        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus berjumlah 16 angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        ]);

        // Buat record di tabel patients
        Patient::create([
            'user_id' => $user->id,
            'nik' => $validated['nik'],
            'nama_lengkap' => $user->name, // Gunakan nama dari user login
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
        ]);

        return redirect()->route('pasien.dashboard')->with('success', 'Data profil Anda berhasil dilengkapi!');
    }
}
