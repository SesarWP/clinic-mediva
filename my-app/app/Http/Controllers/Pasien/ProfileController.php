<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nama_lengkap'  => 'required|string|max:255',
            'alamat'        => 'nullable|string|max:500',
            'no_hp'         => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'profile_photo.image'   => 'File harus berupa gambar.',
            'profile_photo.mimes'   => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'profile_photo.max'     => 'Ukuran gambar maksimal 2MB.',
        ]);

        // ── Handle photo upload ──────────────────────────────────────────
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru ke storage/app/public/profile-photos/
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // ── Update tabel users (name + foto) ────────────────────────────
        $user->name = $validated['nama_lengkap'];
        $user->save();

        // ── Update tabel patients ────────────────────────────────────────
        $patient->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat'       => $validated['alamat'],
            'no_hp'        => $validated['no_hp'],
        ]);

        return redirect()->route('pasien.profil.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
