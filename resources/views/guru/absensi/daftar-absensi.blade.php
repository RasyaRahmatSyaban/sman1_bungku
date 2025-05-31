<x-guru-layout title="Daftar Absensi Kelas Anda" section_title="Daftar Absensi Kelas Anda, {{ $user->guru->nama }}">
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

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Pilih Mapel Kelas yang ingin Anda buat absensinya</h2>
    </div>

    <!-- Jadwal Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($jadwals as $jadwal)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $jadwal->kelas->nama_kelas }}</h3>
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-medium">Mata Pelajaran:</span> {{ $jadwal->mata_pelajaran->nama_mapel }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('guru.absensi.create', $jadwal->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 w-full justify-center">
                            <i class="ph ph-plus mr-2"></i>
                            Tambah Absensi
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <i class="ph ph-calendar-x text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Jadwal</h3>
                    <p class="text-sm text-gray-500">Belum ada jadwal yang tersedia untuk membuat absensi.</p>
                </div>
            </div>
        @endforelse
    </div>
</x-guru-layout>