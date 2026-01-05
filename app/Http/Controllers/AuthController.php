<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'USERNAME' => 'required|string',
            'PASSWORD' => 'required|string',
        ], [
            'USERNAME.required' => 'Username harus diisi',
            'PASSWORD.required' => 'Password harus diisi',
        ]);

        $user = Pengguna::where('USERNAME', $request->USERNAME)->first();

        if (!$user) {
            return back()->withErrors([
                'USERNAME' => 'Username atau password salah.',
            ])->onlyInput('USERNAME');
        }

        // Cek password dengan bcrypt
        $isPasswordValid = false;
        
        if (str_starts_with($user->PASSWORD, '$2y$')) {
            // Password sudah di-hash
            $isPasswordValid = Hash::check($request->PASSWORD, $user->PASSWORD);
        } else {
            // Password plain text (backward compatibility)
            $isPasswordValid = ($request->PASSWORD === $user->PASSWORD);
            
            // Auto-hash password jika login berhasil
            if ($isPasswordValid) {
                $user->PASSWORD = Hash::make($request->PASSWORD);
                $user->save();
            }
        }

        if ($isPasswordValid) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'USERNAME' => 'Username atau password salah.',
        ])->onlyInput('USERNAME');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
