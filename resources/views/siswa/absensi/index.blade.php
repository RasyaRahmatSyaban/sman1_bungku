<x-siswa-layout title="Riwayat Absensi" section_title="Riwayat Absensi Anda">
    <!-- Tabel Riwayat Absensi -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($absensiList as $absensi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $absensi->jadwal->mata_pelajaran->nama_mapel ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $absensi->jadwal->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ ucfirst($absensi->status) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-siswa-layout>