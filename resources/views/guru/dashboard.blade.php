<x-guru-layout title="Dashboard" section_title="Selamat datang, {{ $guru->nama }}">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Jumlah Mapel -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Jumlah Mapel Diampu</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $jumlahMapel }}</h3>
        </div>

        <!-- Jumlah Siswa (Jika Wali Kelas) -->
        <div class="bg-white shadow rounded-lg p-4 border-l-4 border-purple-500">
            <p class="text-sm text-gray-500">Jumlah Siswa Kelas (Sebagai Wali)</p>
            <h3 class="text-xl font-semibold text-gray-800">{{ $jumlahSiswaWali }}</h3>
        </div>
    </div>

    <!-- Jadwal Guru -->
    <div class="bg-white shadow rounded-lg p-6 mt-4">
        <h2 class="text-lg font-semibold mb-4">Jadwal Mengajar</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Hari</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Jam</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Kelas</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($jadwalMapel as $item)
                        <tr>
                            <td class="px-4 py-2">{{ Str::upper($item->hari) }}</td>
                            <td class="px-4 py-2">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td class="px-4 py-2">{{ $item->kelas->nama_kelas }}</td>
                            <td class="px-4 py-2">{{ $item->mata_pelajaran->nama_mapel }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-4 py-2 text-gray-500">Tidak ada jadwal ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($guru->kelas_wali)
        <!-- Siswa dalam kelas wali -->
        <div class="bg-white shadow rounded-lg p-6 mt-8">
            <h2 class="text-lg font-semibold mb-4">Siswa Kelas {{ $guru->kelas_wali->nama_kelas }}</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">NIS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($guru->kelas_wali->siswa as $siswa)
                            <tr>
                                <td class="px-4 py-2">{{ $siswa->nama }}</td>
                                <td class="px-4 py-2">{{ $siswa->nis }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center px-4 py-2 text-gray-500">Belum ada siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-guru-layout>