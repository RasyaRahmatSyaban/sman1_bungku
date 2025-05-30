<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
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
        $absensiGroups = Absensi::with(['jadwal'])
        ->selectRaw('MIN(id) as id, id_jadwal, tanggal') 
        ->groupBy('id_jadwal', 'tanggal') 
        ->get();

        $jadwals = Jadwal::with(['kelas', 'mata_pelajaran'])->get();

        return view('admin.absensi.index', compact('absensiGroups', 'jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($jadwal_id)
    {
        // Ambil jadwal, termasuk kelas dan siswa di dalam kelas itu
        $jadwal = Jadwal::with(['mata_pelajaran', 'kelas.siswa'])->findOrFail($jadwal_id);

        // Siswa dari kelas terkait
        $siswa = $jadwal->kelas->siswa;

        return view('admin.absensi.create', compact('jadwal', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id',
        'tanggal' => 'required|date',
        'absensi' => 'required|array',
        'absensi.*.id_siswa' => 'required|exists:siswa,id',
        'absensi.*.status' => 'required|in:Hadir,Alpa,Izin,Sakit',
    ]);

        foreach ($validated['absensi'] as $data) {
            Absensi::create([
                'id_jadwal' => $validated['id_jadwal'],
                'tanggal' => $validated['tanggal'],
                'id_siswa' => $data['id_siswa'],
                'status' => $data['status'],
            ]);
        }

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarAbsensi()
    {
        $jadwals = Jadwal::with(['kelas', 'mata_pelajaran'])->get();
        return view('admin.absensi.daftar-absensi', compact('jadwals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
        $jadwalId = $request->query('id_jadwal');
        $tanggal = $request->query('tanggal');

        $absensi = Absensi::with('siswa', 'jadwal')
            ->where('id_jadwal', $jadwalId)
            ->where('tanggal', $tanggal)
            ->get();

        $jadwal = Jadwal::with('kelas', 'mata_pelajaran')->get();
        return view('admin.absensi.edit', compact('absensi', 'jadwal', 'jadwalId', 'tanggal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
        'id_mapel' => 'required|exists:mata_pelajaran,id',
        'tanggal' => 'required|date',
        'absensi' => 'required|array',
        'absensi.*.id' => 'required|exists:absensi,id',
        'absensi.*.id_siswa' => 'required|exists:siswa,id',
        'absensi.*.status' => 'required|in:Hadir,Alpa,Izin,Sakit',
    ]);

    foreach ($validated['absensi'] as $item) {
        Absensi::where('id', $item['id'])->update([
            'status' => $item['status']
        ]);
    }

    return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        Absensi::where('id_jadwal', $request->id_jadwal)
            ->where('tanggal', $request->tanggal)
            ->delete();

        return redirect()->back()->with('success', 'Semua data absensi pada tanggal tersebut berhasil dihapus.');
    }
}
