<x-siswa-layout title="Profile" section_title="Your Profile">
    <div class="max-w-3xl mx-auto">
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
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
            <div class="p-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-500">
                        <i class="ph ph-student text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $user->siswa->nama ?? $user->username ?? 'Student' }}</h2>
                        <p class="text-sm text-gray-500">{{ $user->role ?? 'Role not assigned' }}</p>
                    </div>
                </div>

                @if(!$user)
                    <div class="bg-amber-50 border-l-4 border-amber-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="ph ph-warning text-amber-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-amber-700">
                                    User data not found. Please contact the administrator.
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                            <div class="text-gray-800">{{ $user->username ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                            <div class="text-gray-800">{{ $user->email ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                            <div class="text-gray-800">{{ $user->role ?? 'Not available' }}</div>
                        </div>

                        @if($user->siswa)
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">NIS</label>
                            <div class="text-gray-800">{{ $user->siswa->nis ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Kelas</label>
                            <div class="text-gray-800">{{ $user->siswa->kelas->nama_kelas ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                            <div class="text-gray-800">{{ $user->siswa->alamat ?? 'Not available' }}</div>
                        </div>
                        @endif
                    </div>
                @endif

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('siswa.profile.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                    <i class="ph ph-note-pencil mr-2"></i>
                                    Edit
                                </a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                            <i class="ph ph-sign-out mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-siswa-layout>