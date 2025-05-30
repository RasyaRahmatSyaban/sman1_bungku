<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Str;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('siswa.create', compact('siswa', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $nis = Str::upper($validated['username']);

        if (Siswa::where('nis', $nis)->exists()) {
            throw ValidationException::withMessages([
                'username' => ['Username tidak valid karena NIS sudah digunakan.'],
            ]);
        }

        $user = User::create([
            'username' => $validated['username'],
            'password' => $validated['username'],
            'role' => 'siswa',
        ]);
        
        Siswa::create([
            'id_user' => $user->id,
            'nama' => $validated['nama'],
            'nis' => $nis,
            'alamat' => $validated['alamat'],
            'id_kelas' => $validated['id_kelas'],
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = Siswa::with('kelas')->find($id);

        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::with('kelas')->find($id);
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|unique:users,username,'. $siswa->user->id. ',id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswa,nis,' . $id,
            'alamat' => 'required|string|max:255|',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas' => 'required',
        ]);

        $siswa->user->update([
            'username' => $request->username,
        ]);

        $siswa->update([
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
            'alamat' => $validated['alamat'],
            'jk' => $validated['jenis_kelamin'],
            'kelas' => $validated['kelas'],
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
