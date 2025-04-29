<x-default-layout title="Guru" section_title="Tambahkan Guru Baru">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    @method("POST")
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="Rasya S. Kom">
                                @error('nama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                            <div class="mt-1">
                                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="862481">
                                @error('nip')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="sm:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <div class="mt-1">
                                <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" 
                                    class="shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="Jl. Lasoani">
                                @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('guru.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 p-2 focus:ring-sky-500">
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