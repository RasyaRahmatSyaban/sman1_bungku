<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $kelas = Kelas::with('walikelas')
                ->withCount('siswa')
                ->get();
        $guru = Guru::all()->count();
        $siswa = Siswa::all()->count();
        return view('dashboard', compact('kelas', 'guru', 'siswa'));
    }
}
