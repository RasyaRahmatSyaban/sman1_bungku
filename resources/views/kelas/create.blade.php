<x-default-layout title="Kelas" section_title="Tambahkan Kelas Baru">
    <div class="max-w-full mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    @method("POST")
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Nama Kelas -->
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <div class="mt-1">
                                <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" 
                                    class="shadow-sm focus:ring-sky-500 p-2 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    placeholder="X IPA II">
                                @error('nama_kelas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Wali Kelas -->
                        <div>
                            <label for="wali_kelas" class="block text-sm font-medium text-gray-700">Wali Kelas</label>
                            <div class="mt-1">
                                <select id="wali_kelas" name="wali_kelas" 
                                    class="shadow-sm focus:ring-sky-500 p-2 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="" disabled selected>Pilih Wali Kelas</option>
                                    @foreach ($wali_kelas as $wali)
                                    <option value="{{ $wali->id }}" {{ old('wali_kelas') == $wali->id ? 'selected' : '' }}>
                                        {{ $wali->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('wali_kelas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('kelas.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 p-2">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 p-2">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>