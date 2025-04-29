<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MataPelajaran::with('kelas')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'hari' => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        return MataPelajaran::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return MataPelajaran::with('kelas')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'hari' => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mapel->update($validated);
        return $mapel;
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
