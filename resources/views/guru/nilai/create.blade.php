<x-guru-layout title="Nilai" section_title="Input Nilai Siswa">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('nilai.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">

                    <!-- Info Jadwal -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Informasi Jadwal</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Mata Pelajaran:</span> {{ $jadwal->mata_pelajaran->nama_mapel }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Kelas:</span> {{ $jadwal->kelas->nama_kelas }}
                        </p>
                    </div>

                    <!-- Daftar Siswa -->
                    <div class="border border-gray-200 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Input Nilai Siswa</h3>
                        <div class="space-y-4">
                            @foreach ($siswa as $index => $s)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                    <div class="flex-1">
                                        <input type="hidden" name="nilai[{{ $index }}][id_siswa]" value="{{ $s->id }}">
                                        <label class="block text-sm font-medium text-gray-700">{{ $s->nama }}</label>
                                        <p class="text-xs text-gray-500">NIS: {{ $s->nis ?? '-' }}</p>
                                    </div>
                                    <div class="ml-4">
                                        <input type="number" 
                                            name="nilai[{{ $index }}][nilai]" 
                                            value="{{ old("nilai.{$index}.nilai") }}"
                                            class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-24 sm:text-sm border-gray-300 rounded-md text-center" 
                                            placeholder="0-100"
                                            min="0" 
                                            max="100" 
                                            required>
                                        @error("nilai.{$index}.nilai")
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('nilai.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guru-layout>