<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Halaman utama - pilih login sebagai bidan atau pasien
     */
    public function showLoginChoice()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login-choice');
    }

    /**
     * Form login bidan
     */
    public function showBidanLogin()
    {
        if (Auth::check() && Auth::user()->isBidan()) {
            return redirect()->route('bidan.dashboard');
        }
        return view('auth.login-bidan');
    }

    /**
     * Form login pasien
     */
    public function showPasienLogin()
    {
        if (Auth::check() && Auth::user()->isPasien()) {
            return redirect()->route('pasien.dashboard');
        }
        return view('auth.login-pasien');
    }

    /**
     * Proses login bidan
     */
    public function loginBidan(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'bidan') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan akun bidan.'])->withInput();
            }
            $request->session()->regenerate();
            return redirect()->intended(route('bidan.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    /**
     * Proses login pasien
     */
    public function loginPasien(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'pasien') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan akun pasien.'])->withInput();
            }
            $request->session()->regenerate();
            return redirect()->intended(route('pasien.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
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
