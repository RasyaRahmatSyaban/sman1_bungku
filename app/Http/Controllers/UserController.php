<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            // Cari berdasarkan username di users
            $q->where('username', 'like', "%{$search}%");

            // Cari berdasarkan nama di relasi dosen
            $q->orWhereHas('guru', function ($q2) use ($search) {
                $q2->where('nama', 'like', "%{$search}%");
            });

            // Cari berdasarkan nama di relasi siswa
            $q->orWhereHas('siswa', function ($q2) use ($search) {
                $q2->where('nama', 'like', "%{$search}%");
            });
        });
    }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        $user = $query->paginate(5); // <- PENTING, jangan pakai ->get()

        return view('admin.user.index', compact('user'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,guru,siswa',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        // Hanya update password jika diisi
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
