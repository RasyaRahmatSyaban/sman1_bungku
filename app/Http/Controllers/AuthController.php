<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        $roles = ['admin', 'guru', 'siswa'];
        return view('auth.register', compact('roles'));
    }

    public function login()
    {
        $roles = ['admin', 'guru', 'siswa'];
        return view('auth.login', compact('roles'));
    }

    public function store(Request $request)
    {

        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

        return redirect()->route('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }elseif ($user->role === 'guru') {
                return redirect()->route('guru.dashboard');
            } else {
                auth()->logout();
                return redirect()->route('auth.register')->with('error', 'Role tidak dikenal');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
