<x-default-layout title="Absensi" section_title="Tambah Absensi Pertemuan">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Pilih Mata Pelajaran -->
                    <div class="mb-4">
                        <label for="id_mapel" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                        <select name="id_mapel" id="id_mapel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($mapel as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->kelas->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_mapel')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pertemuan</label>
                        <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('tanggal')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Daftar Siswa dan Absensi -->
                    <div class="border p-4 rounded-md">
                        <h3 class="font-semibold mb-3">Absensi Siswa</h3>
                        @foreach ($siswa as $index => $s)
                            <div class="mb-3">
                                <input type="hidden" name="absensi[{{ $index }}][id_siswa]" value="{{ $s->id }}">
                                <label class="block text-sm font-medium text-gray-700">{{ $s->nama }}</label>
                                <select name="absensi[{{ $index }}][status]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="Hadir">Hadir</option>
                                    <option value="Alpa">Alpa</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('absensi.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md text-white bg-sky-600 hover:bg-sky-700">
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
