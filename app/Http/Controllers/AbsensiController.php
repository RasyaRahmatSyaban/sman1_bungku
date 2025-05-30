<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $dosenId = auth()->user()->dosen->id_dosen;

        // $krs = KRS::with('jadwal.kelas.mata_kuliah')
        //     ->whereHas('jadwal.kelas.mata_kuliah', function ($query) use ($dosenId) {
        //         $query->where('dosen_pengampu_1_id', $dosenId)
        //             ->orWhere('dosen_pengampu_2_id', $dosenId)
        //             ->orWhere('dosen_pengampu_3_id', $dosenId);
        //     })
        //     ->get()
        //     ->unique(function ($item) {
        //         return $item->jadwal->kelas->id_kelas . '-' . $item->jadwal->kelas->mata_kuliah->id_mata_kuliah;
        //     });

        // return view('dosen.absensi.index', compact('krs'));

        $absensi = Absensi::all();
        return view('absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $mapel = MataPelajaran::with('kelas')->get();

        return view('absensi.create', compact('siswa', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'id_mapel' => 'required|exists:mata_pelajaran,id',
        'tanggal' => 'required|date',
        'absensi' => 'required|array',
        'absensi.*.id_siswa' => 'required|exists:siswa,id',
        'absensi.*.status' => 'required|in:Hadir,Alpa,Izin,Sakit',
    ]);

        foreach ($validated['absensi'] as $data) {
            Absensi::create([
                'id_mapel' => $validated['id_mapel'],
                'tanggal' => $validated['tanggal'],
                'id_siswa' => $data['id_siswa'],
                'status' => $data['status'],
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Absensi::with('siswa')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Alpa,Izin,Sakit',
        ]);

        $absensi->update($validated);
        return $absensi;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return response()->json(['message' => 'Absensi berhasil dihapus']);
    }
}
