<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role === 'admin'){
            $nilaiGroups = Nilai::with(['jadwal.mata_pelajaran', 'jadwal.kelas'])
            ->selectRaw('MIN(id) as id, id_jadwal')
            ->groupBy('id_jadwal')
            ->get();

            return view('admin.nilai.index', compact('nilaiGroups'));
        }elseif($user->role === 'guru'){
            $guruId = $user->guru->id;

            // Ambil semua jadwal yang dimiliki guru ini
            $jadwalIds = Jadwal::whereHas('mata_pelajaran', function ($query) use ($guruId) {
                $query->where('id_guru', $guruId);
            })->pluck('id');

            // Ambil absensi yang hanya berkaitan dengan jadwal milik guru ini
            $nilaiGroups = Nilai::with(['jadwal'])
                ->whereIn('id_jadwal', $jadwalIds)
                ->selectRaw('MIN(id) as id, id_jadwal')
                ->groupBy('id_jadwal')
                ->get();
            return view('guru.nilai.index', compact('nilaiGroups'));
        }elseif($user->role === 'siswa'){
            $siswaId = $user->siswa->id;

            $nilaiList = Nilai::with(['jadwal.kelas', 'jadwal.mata_pelajaran'])
                ->where('id_siswa', $siswaId)
                ->orderBy('id_jadwal') // Urutkan berdasarkan mata pelajaran
                ->get();

            return view('siswa.nilai.index', compact('nilaiList'));
        }else{
            abort(403, "Anda tidak memiliki akses");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($jadwal_id)
    {
        $jadwal = Jadwal::with(['mata_pelajaran', 'kelas.siswa'])->findOrFail($jadwal_id);
        $siswa = $jadwal->kelas->siswa;

        return view('guru.nilai.create', compact('jadwal', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal,id',
            'nilai' => 'required|array',
            'admin.nilai.*.id_siswa' => 'required|exists:siswa,id',
            'admin.nilai.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($validated['nilai'] as $data) {
            Nilai::updateOrCreate(
                [
                    'id_jadwal' => $validated['id_jadwal'],
                    'id_siswa' => $data['id_siswa']
                ],
                [
                    'nilai' => $data['nilai']
                ]
            );
        }

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarNilai()
    {
        $user = auth()->user();
        $guruId = $user->guru->id;
        $jadwals = Jadwal::with(['mata_pelajaran', 'kelas'])->whereHas('mata_pelajaran.guru', function ($query) use ($guruId){
                $query->where('id', $guruId);
            })->get();

        return view('guru.nilai.daftar-nilai', compact('jadwals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $jadwalId = $request->query('id_jadwal');

        // Ambil semua data nilai berdasarkan id_jadwal, termasuk relasi siswa
        $nilai = Nilai::with('siswa', 'jadwal')
            ->where('id_jadwal', $jadwalId)
            ->get();

        $jadwal = Jadwal::with('kelas', 'mata_pelajaran')->findOrFail($jadwalId);

        return view('guru.nilai.edit', compact('nilai', 'jadwal', 'jadwalId'));
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
    public function destroy(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|integer',
        ]);

        Nilai::where('id_jadwal', $request->id_jadwal)
            ->delete();

        return redirect()->back()->with('success', 'Semua data niali pada mapel tersebut berhasil dihapus.');
    }
}
