<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role === 'admin'){
            $jadwal = Jadwal::with('kelas', 'mata_pelajaran')->get();
            return view('admin.jadwal.index', compact('jadwal'));
        }elseif($user->role === 'guru'){
            $guruId = $user->guru->id;
            $jadwal = Jadwal::with('mata_pelajaran.guru')->whereHas('mata_pelajaran.guru', function ($query) use ($guruId){
                $query->where('id', $guruId);
            })->get();
            return view('guru.jadwal.index', compact('jadwal'));
        }elseif($user->role === 'siswa'){
            $siswaId = $user->siswa->id;
            $jadwal = Jadwal::with('kelas.siswa')->whereHas('kelas.siswa', function ($query) use ($siswaId){
                $query->where('id', $siswaId);
            })->get();
            return view('siswa.jadwal.index', compact('jadwal'));
        }else{
            abort(403, "Anda tidak memiliki akses");
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwal = Jadwal::with('kelas', 'mata_pelajaran')->get();
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        return view('admin.jadwal.create', compact('jadwal', 'kelas', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|string|max:255',
            'jam_selesai' => 'required|string|max:255',
            'id_kelas' => 'required|exists:kelas,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'ruangan' => 'required',
        ]);
        
        Jadwal::create([
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'id_kelas' => $validated['id_kelas'],
            'id_mapel' => $validated['id_mapel'],
            'ruangan' => $validated['ruangan'],
        ]);
        
        return redirect()->route('admin.jadwal.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = Jadwal::with('kelas', 'mata_pelajaran')->findOrFail($id);
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|string|max:255',
            'jam_selesai' => 'required|string|max:255',
            'id_kelas' => 'required|exists:kelas,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'ruangan' => 'required|string|max:255',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        $jadwal->update([
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'id_kelas' => $validated['id_kelas'],
            'id_mapel' => $validated['id_mapel'],
            'ruangan' => $validated['ruangan'],
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
