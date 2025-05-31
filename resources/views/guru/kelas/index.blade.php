<x-guru-layout title="Kelas" section_title="Daftar Murid di Kelas Anda">
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="ph ph-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" onclick="this.closest('div.bg-green-50').remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <span class="sr-only">Dismiss</span>
                            <i class="ph ph-x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Informasi Kelas -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Nama Kelas: {{ $kelas->nama_kelas }}</h2>
        <p class="text-sm text-gray-600">Wali Kelas: {{ $kelas->waliKelas->nama }}</p>
    </div>

    <!-- Tabel Siswa -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kelas->siswa as $siswa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $siswa->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $siswa->nis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $siswa->jk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $siswa->alamat }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada siswa di kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-guru-layout>