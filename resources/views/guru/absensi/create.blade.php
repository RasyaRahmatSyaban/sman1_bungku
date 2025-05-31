<x-guru-layout title="Absensi" section_title="Tambah Absensi Pertemuan">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('guru.absensi.store') }}" method="POST">
                    @csrf

                    <!-- Info Jadwal -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Informasi Jadwal</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Mata Pelajaran:</span> {{ $jadwal->mata_pelajaran->nama_mapel }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Kelas:</span> {{ $jadwal->kelas->nama_kelas }}
                        </p>
                        <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-6">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pertemuan</label>
                        <div class="mt-1">
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" 
                                class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('tanggal')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Daftar Siswa -->
                    <div class="border border-gray-200 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Absensi Siswa</h3>
                        <div class="space-y-4">
                            @foreach ($siswa as $index => $s)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                    <div class="flex-1">
                                        <input type="hidden" name="absensi[{{ $index }}][id_siswa]" value="{{ $s->id }}">
                                        <label class="block text-sm font-medium text-gray-700">{{ $s->nama }}</label>
                                        <p class="text-xs text-gray-500">NIS: {{ $s->nis ?? '-' }}</p>
                                    </div>
                                    <div class="ml-4">
                                        <select name="absensi[{{ $index }}][status]" class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            <option value="Hadir" {{ old("absensi.{$index}.status") == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Alpa" {{ old("absensi.{$index}.status") == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                                            <option value="Izin" {{ old("absensi.{$index}.status") == 'Izin' ? 'selected' : '' }}>Izin</option>
                                            <option value="Sakit" {{ old("absensi.{$index}.status") == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('guru.absensi.daftar-absensi') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guru-layout>
