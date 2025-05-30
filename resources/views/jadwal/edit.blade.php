<x-default-layout title="Jadwal" section_title="Perbarui Informasi Jadwal">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- hari -->
                        <div>
                            <label for="hari" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <div class="mt-1">
                                <select name="id_kelas" id="id_kelas"
                                class="shadow-sm focus:ring-sky-500 p-2 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                required>
                                    <option value="" class="text-gray-400">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('id_kelas', $jadwal->id_kelas) == $k->id ? 'selected' : '' }}
                                            class="text-gray-700 py-2">
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- kelas -->
                        <div>
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <div class="mt-1">
                                <select id="hari" name="hari" 
                                class="shadow-sm focus:ring-sky-500 p-2 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="" selected>Pilih Hari</option>
                                @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                        {{ ucfirst($hari) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hari')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- MAPEL -->
                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                        <div class="mt-1">
                            <select name="id_mapel" id="id_mapel"
                            class="shadow-sm focus:ring-sky-500 p-2 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            required>
                                <option value="" class="text-gray-400">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id }}"
                                        {{ old('id_mapel', $jadwal->id_mapel) == $m->id ? 'selected' : '' }}
                                        class="text-gray-700 py-2">
                                        {{ $m->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_mapel')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                        
                        <!-- Ruangan -->
                        <div>
                            <label for="ruangan" class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <div class="mt-1">
                                <input type="text" id="ruangan" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}" 
                                class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                placeholder="Kelas X IPA 2">
                                @error('ruangan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Jam Mulai -->
                        <div>
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                            <div class="mt-1">
                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai',$jadwal->jam_mulai) }}" 
                                class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                placeholder="19.20">
                                @error('jam_mulai')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Jam Selesai -->
                        <div>
                            <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                            <div class="mt-1">
                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai',$jadwal->jam_selesai) }}" 
                                class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                placeholder="19.20">
                                @error('jam_selesai')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('jadwal.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 p-2 focus:ring-sky-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 p-2 focus:ring-sky-500">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>