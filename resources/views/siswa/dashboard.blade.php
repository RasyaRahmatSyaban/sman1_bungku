<x-siswa-layout title="Dashboard" section_title="Selamat datang, {{ $siswa->nama }}">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Kelas -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-sky-500">
            <p class="text-sm text-gray-500">Kelas Anda</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $siswa->kelas->nama_kelas ?? '-' }}</h3>
        </div>

        <!-- Total Jadwal -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Total Jadwal</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $jadwal->count() }}</h3>
        </div>

        <!-- Absensi -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Total Absensi</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $siswa->absensi->count() }}</h3>
        </div>

        <!-- Nilai -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-purple-500">
            <p class="text-sm text-gray-500">Total Nilai</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $siswa->nilai->count() }}</h3>
        </div>
    </div>

    <!-- Jadwal Kelas -->
    <div class="bg-white shadow rounded-lg p-6 mt-4">
        <h2 class="text-lg font-semibold mb-4">Jadwal Kelas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Hari</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Jam</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($jadwal as $item)
                        <tr>
                            <td class="px-4 py-2">{{ Str::upper($item->hari) }}</td>
                            <td class="px-4 py-2">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td class="px-4 py-2">{{ $item->mata_pelajaran->nama_mapel }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center px-4 py-2 text-gray-500">Tidak ada jadwal ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-siswa-layout>