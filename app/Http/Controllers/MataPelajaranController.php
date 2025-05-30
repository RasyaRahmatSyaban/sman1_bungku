<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataPelajaran::with('guru')->get();
        return view('mata-pelajaran.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('mata-pelajaran.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id',
        ]);
        
        MataPelajaran::create([
            'nama_mapel' => $validated['nama_mapel'],
            'id_guru' => $validated['id_guru'],
        ]);
        
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.show', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gurus = Guru::all();
        $mapel = MataPelajaran::with('guru')->findOrFail($id);
        return view('mata-pelajaran.edit', compact('mapel', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id',
        ]);

        $mapel->update($validated);
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();
        return response()->json(['message' => 'Mata pelajaran berhasil dihapus']);
    }
}
