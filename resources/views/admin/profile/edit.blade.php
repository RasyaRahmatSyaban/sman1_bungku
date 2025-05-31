<x-admin-layout title="Profile" section_title="Your Profile">
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Profil Admin</h2>
    <form method="POST" action="{{ route('admin.profile.update') }}">
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
            <label for="password" class="block font-semibold">Password (opsional)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded mt-2" placeholder="Konfirmasi password">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <a href="{{ route('admin.profile.show') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 p-2">
            Kembali
        </a>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
</x-admin-layout>