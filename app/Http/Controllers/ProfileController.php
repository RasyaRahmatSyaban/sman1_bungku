<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user->role === 'admin'){
            return view('admin.profile', compact('user'));
        }elseif($user->role === 'guru'){
            return view('guru.profile', compact('user'));
        }elseif($user->role === 'siswa'){
            return view('siswa.profile', compact('user'));
        }else{
            abort(403, 'Anda tidak memiliki akses');
        }
    }
}
