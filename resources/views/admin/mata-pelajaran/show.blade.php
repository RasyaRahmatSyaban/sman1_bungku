<x-admin-layout title="Mata Pelajaran" section_title="Informasi Mata Pelajaran">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mapel->nama_mapel }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Guru</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $mapel->guru->nama }}</dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-5 sm:px-6 bg-white border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.mata-pelajaran.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    Kembali
                </a>
                <a href="{{ route('admin.mata-pelajaran.edit', $mapel->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    <i class="ph ph-note-pencil mr-2"></i>
                    Ubah
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>