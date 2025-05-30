<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Str;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::all();
        return view('guru.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        $nip = Str::upper($validated['username']);

        if (Guru::where('nip', $nip)->exists()) {
            throw ValidationException::withMessages([
                'username' => ['Username tidak valid karena NIP sudah digunakan.'],
            ]);
        }

        $user = User::create([
            'username' => $validated['username'],
            'password' => $validated['username'],
            'role' => 'guru',
        ]);

        Guru::create([
            'id_user' => $user->id,
            'nama' => $validated['nama'],
            'nip' => $nip,
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        $validated = $request->validate([
            'username' => 'required|unique:users,username,'. $guru->user->id. ',id',
            'nama' => 'required',
            'nip' => 'required|unique:guru,nip|max:9',
            'alamat' => 'required',
        ]);

        $guru->user->update([
            'username' => $request->username,
        ]);

        $guru->update([
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
