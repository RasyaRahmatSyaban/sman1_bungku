<?php

namespace App\Http\Controllers;

use App\Models\Guru;
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
            return view('guru.dashboard');
        }elseif($user->role === 'siswa'){
            return view('siswa.dashboard');
        }else{
            abort(403, "Anda tidak memiliki akses");
        }
    }
}
