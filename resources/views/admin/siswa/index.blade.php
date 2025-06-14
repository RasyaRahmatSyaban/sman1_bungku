<x-admin-layout title="Siswa" section_title="Daftar Siswa">
    <!-- Notification -->
    @if (session('success'))
    <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="ph ph-check-circle text-green-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="sr-only">Dismiss</span>
                        <i class="ph ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Action Button -->
    <div class="mb-6">
        <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <i class="ph ph-plus mr-2"></i>
            Tambah Siswa
        </a>
    </div>

    <!-- Students Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($siswa as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->alamat }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->jk }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->kelas->nama_kelas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.siswa.show', $student->id) }}" class="text-sky-600 hover:text-sky-900 bg-sky-50 hover:bg-sky-100 p-2 rounded-md transition-colors">
                                    <i class="ph ph-eye"></i>
                                </a>
                                <a href="{{ route('admin.siswa.edit', $student->id) }}" class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-md transition-colors">
                                    <i class="ph ph-note-pencil"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')" method="POST" action="{{ route('admin.siswa.destroy', $student->id) }}" class="inline">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-md transition-colors">
                                        <i class="ph ph-trash-simple"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak Ada Siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>