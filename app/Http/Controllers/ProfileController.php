<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        if($user->role === 'admin'){
            return view('admin.profile.show', compact('user'));
        }elseif($user->role === 'guru'){
            return view('guru.profile.show', compact('user'));
        }elseif($user->role === 'siswa'){
            return view('siswa.profile.show', compact('user'));
        }else{
            abort(403, 'Anda tidak memiliki akses');
        }
    }
    public function edit()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return view('admin.profile.edit', compact('user'));
        } elseif ($user->role === 'siswa') {
            $siswa = Siswa::where('id_user', $user->id)->firstOrFail();
            $kelas = Kelas::all();
            return view('siswa.profile.edit', compact('user', 'siswa', 'kelas'));
        } elseif ($user->role === 'guru') {
            $guru = Guru::where('id_user', $user->id)->firstOrFail();
            return view('guru.profile.edit', compact('user', 'guru'));
        }else{
            abort(403, 'Anda tidak memiliki akses');
        }
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi umum untuk user
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($user->role === 'siswa') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nis' => 'required|string|max:100',
                'alamat' => 'required|string',
                'jk' => 'required|in:Laki-laki,Perempuan',
            ]);

            $siswa = Siswa::where('id_user', $user->id)->first();
            $siswa->update($request->only(['nama', 'nis', 'alamat', 'jk']));
            return redirect()->route('siswa.profile.show')->with('success', 'Profil berhasil diperbarui.');
        }elseif ($user->role === 'guru') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:100',
                'alamat' => 'required|string',
            ]);

            $guru = Guru::where('id_user', $user->id)->first();
            $guru->update($request->only(['nama', 'nip', 'alamat']));
            return redirect()->route('guru.profile.show')->with('success', 'Profil berhasil diperbarui.');
        }
        return redirect()->route('admin.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
