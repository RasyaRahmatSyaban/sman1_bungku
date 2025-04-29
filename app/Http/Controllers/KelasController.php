<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private function getAvailableWaliKelas($currentWaliKelasId = null)
    {
        $waliKelasQuery = Guru::where(function ($query) use ($currentWaliKelasId) {
            $query->whereNotIn('id', function ($subQuery) {
                $subQuery->select('wali_kelas_id')->from('kelas');
            });

            if ($currentWaliKelasId) {
                $query->orWhere('id', $currentWaliKelasId);
            }
        });

        return $waliKelasQuery->orderBy('nama')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('walikelas')
                ->withCount('siswa')
                ->get();
        return view('kelas.index', compact('kelas'));;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wali_kelas = $this->getAvailableWaliKelas();
        return view('kelas.create', compact('wali_kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required',
        ]);

        Kelas::create([
            'nama_kelas' => $validated['nama_kelas'],
            'wali_kelas_id' => $validated['wali_kelas'],
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        $jumlah_siswa = Siswa::where('kelas_id', $id)->count();
        return view('kelas.show', compact('kelas', 'jumlah_siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::find($id);
        $wali_kelas = $this->getAvailableWaliKelas($kelas->wali_kelas_id);
        return view('kelas.edit', compact('kelas', 'wali_kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required',
        ]);

        $kelas->update([
            'nama_kelas' => $validated['nama_kelas'],
            'wali_kelas_id' => $validated['wali_kelas'],
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}