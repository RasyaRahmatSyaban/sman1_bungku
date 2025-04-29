<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Nilai::with('siswa', 'mataPelajaran')->get();
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
            'siswa_id' => 'required|exists:siswa,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        return Nilai::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Nilai::with('siswa', 'mataPelajaran')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($validated);
        return $nilai;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return response()->json(['message' => 'Nilai berhasil dihapus']);
    }
}
