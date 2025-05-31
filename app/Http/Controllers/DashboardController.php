<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->role === 'admin'){
            $kelas = Kelas::with('walikelas')
                    ->withCount('siswa')
                    ->get();
            $guru = Guru::all()->count();
            $siswa = Siswa::all()->count();
            return view('admin.dashboard', compact('kelas', 'guru', 'siswa'));
        }elseif($user->role === 'guru'){
            $guru = Guru::with(['mataPelajaran.jadwal.kelas', 'kelas.siswa'])
            ->where('id_user', $user->id)->firstOrFail();

            $jadwalMapel = $guru->mataPelajaran->flatMap(function($mapel) {
                return $mapel->jadwal;
            });

            $jumlahMapel = $guru->mataPelajaran->count();
            $jumlahSiswaWali = $guru->kelas?->siswa->count() ?? 0;

            return view('guru.dashboard', compact('guru', 'jumlahMapel', 'jumlahSiswaWali', 'jadwalMapel'));
        }elseif($user->role === 'siswa'){
            $siswa = Siswa::with(['kelas', 'absensi', 'nilai'])->where('id_user', $user->id)->firstOrFail();
            $jadwal = Jadwal::where('id_kelas', $siswa->id_kelas)->get();

            return view('siswa.dashboard', compact('siswa', 'jadwal'));
        }else{
            abort(403, "Anda tidak memiliki akses");
        }
    }
}
