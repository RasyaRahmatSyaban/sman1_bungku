<x-guru-layout title="Absensi" section_title="Edit Absensi Pertemuan">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('guru.absensi.update') }}" method="POST">
                    @csrf
                    @METHOD('PUT')

                    <input type="hidden" name="id_mapel" value="{{ $jadwalId }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    <!-- Info Jadwal -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Informasi Jadwal</h3>
                        <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <input type="text" readonly class="mt-1 shadow-sm p-2 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-100"
                                    value="{{ $jadwal->firstWhere('id', $jadwalId)?->mata_pelajaran->nama_mapel }} - {{ $jadwal->firstWhere('id', $jadwalId)?->kelas->nama_kelas }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Pertemuan</label>
                                <input type="date" name="tanggal_display" value="{{ $tanggal }}" readonly class="mt-1 shadow-sm p-2 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-100">
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Siswa dan Absensi -->
                    <div class="border border-gray-200 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Edit Absensi Siswa</h3>
                        <div class="space-y-4">
                            @foreach ($absensi as $index => $data)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                    <div class="flex-1">
                                        <input type="hidden" name="absensi[{{ $index }}][id]" value="{{ $data->id }}">
                                        <input type="hidden" name="absensi[{{ $index }}][id_siswa]" value="{{ $data->id_siswa }}">
                                        <label class="block text-sm font-medium text-gray-700">{{ $data->siswa->nama }}</label>
                                        <p class="text-xs text-gray-500">NIS: {{ $data->siswa->nis ?? '-' }}</p>
                                    </div>
                                    <div class="ml-4">
                                        <select name="absensi[{{ $index }}][status]" class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            @foreach (['Hadir', 'Alpa', 'Izin', 'Sakit'] as $status)
                                                <option value="{{ $status }}" {{ $data->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('guru.absensi.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Update Absensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guru-layout>