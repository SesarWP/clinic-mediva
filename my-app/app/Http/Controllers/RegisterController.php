<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi pasien
     */
    public function showRegistrationForm()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    /**
     * Proses registrasi pasien
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien', // Otomatis sebagai pasien
        ]);

        Auth::login($user);

        return redirect()->route('pasien.dashboard')->with('success', 'Registrasi berhasil! Selamat datang di Clinic Mediva.');
    }

    /**
     * Redirect berdasarkan role
     */
    private function redirectBasedOnRole()
    {
        if (Auth::user()->isBidan()) {
            return redirect()->route('bidan.dashboard');
        }
        return redirect()->route('pasien.dashboard');
    }
}
