<x-guru-layout title="Profile" section_title="Your Profile">
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Profil Guru</h2>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('guru.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="username" class="block font-semibold">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border p-2 rounded">
            @error('username') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="nama" class="block font-semibold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $guru->nama) }}" class="w-full border p-2 rounded">
            @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="nip" class="block font-semibold">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}" class="w-full border p-2 rounded">
            @error('nip') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded">{{ old('alamat', $guru->alamat) }}</textarea>
            @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold">Password (opsional)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded mt-2" placeholder="Konfirmasi password">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <a href="{{ route('guru.profile.show') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 p-2">
            Kembali
        </a>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
</x-guru-layout>