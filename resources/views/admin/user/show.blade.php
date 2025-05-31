<x-admin-layout title="User Details" section_title="User Information">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
            @if(!isset($user))
                <div class="p-6">
                    <div class="bg-amber-50 border-l-4 border-amber-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="ph ph-warning text-amber-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-amber-700">
                                    User data not found. Please go back to the user list.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-500">
                            <i class="ph ph-user text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $user->username }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                            <div class="text-gray-800">{{ $user->username }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                            <div class="text-gray-800">{{ $user->email ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                            <div class="text-gray-800">{{ ucfirst($user->role) }}</div>
                        </div>

                        @if($user->guru)
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Teacher Name</label>
                            <div class="text-gray-800">{{ $user->guru->nama }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">NIP</label>
                            <div class="text-gray-800">{{ $user->guru->nip ?? 'Not available' }}</div>
                        </div>
                        @endif

                        @if($user->siswa)
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Student Name</label>
                            <div class="text-gray-800">{{ $user->siswa->nama }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">NIS</label>
                            <div class="text-gray-800">{{ $user->siswa->nis ?? 'Not available' }}</div>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Class</label>
                            <div class="text-gray-800">{{ $user->siswa->kelas->nama_kelas ?? 'Not available' }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                    <a href="{{ route('admin.user.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        <i class="ph ph-arrow-left mr-2"></i>
                        Back
                    </a>
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        <i class="ph ph-pencil-simple mr-2"></i>
                        Edit
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>