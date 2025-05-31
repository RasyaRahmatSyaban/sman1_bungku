<x-siswa-layout title="Jadwal" section_title="Jadwal Mengajar Anda">
    <!-- Notification -->
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
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="sr-only">Dismiss</span>
                        <i class="ph ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Teachers Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai - Jam Selesai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($jadwal as  $j)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ Str::upper($j->hari) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $j->ruangan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $j->kelas->nama_kelas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $j->mata_pelajaran->nama_mapel }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $j->mata_pelajaran->guru->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $j->jam_mulai . " - " . $j->jam_selesai }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak Ada jadwal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-siswa-layout>