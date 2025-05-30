<x-admin-layout title="Siswa" section_title="Edit Data Siswa">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- UserName -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <div class="mt-1">
                                <input type="text" id="username" name="username" value="{{ old('username', $siswa->user->username) }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md " 
                                    placeholder="username Siswa">
                                @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md " 
                                    placeholder="Nama Siswa">
                                @error('nama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- NIS -->
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                            <div class="mt-1">
                                <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md " 
                                    placeholder="Student ID (e.g., F55122081)">
                                @error('nis')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <div class="mt-1">
                                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $siswa->alamat) }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md " 
                                    placeholder="Student ID (e.g., F55122081)">
                                @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <div class="mt-1">
                                <select id="jenis_kelamin" name="jenis_kelamin" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md ">
                                    <option value="" disabled {{ old('jenis_kelamin', $siswa->jk) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <div class="mt-1">
                                <select id="kelas" name="id_kelas" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md ">
                                    <option value="" disabled>Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kelas', $siswa->id_kelas) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 p-2 focus:ring-sky-500">
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