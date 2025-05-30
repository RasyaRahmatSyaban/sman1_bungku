<x-admin-layout title="Mata Pelajaran" section_title="Tambahkan Mata Pelajaran Baru">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.mata-pelajaran.store') }}" method="POST">
                    @csrf
                    @method("POST")
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
                            <div class="mt-1">
                                <input type="text" id="nama" name="nama_mapel" value="{{ old('nama_mapel') }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="MATEMATIKA">
                                @error('nama_mapel')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- GURU -->
                        <div>
                            <label for="guru" class="block text-sm font-medium text-gray-700">Guru</label>
                            <div class="mt-1">
                                <select name="id_guru" id="id_guru"
                                class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                required>
                                    <option value="" class="bg-gray-800 text-gray-400">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ old('id_guru') == $guru->id ? 'selected' : '' }}
                                            class="bg-gray-800 text-white py-2">
                                            {{ $guru->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_guru')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.mata-pelajaran.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 p-2 focus:ring-sky-500">
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
</x-admin-layout>