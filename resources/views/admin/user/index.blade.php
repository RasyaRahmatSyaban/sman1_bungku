<x-admin-layout title="Users" section_title="User Management">
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
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
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
        <a href="{{ route('admin.user.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
            <i class="ph ph-plus mr-2"></i>
            Add User
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="mb-6 bg-white p-4 shadow-sm rounded-lg border border-gray-100">
        <form action="{{ route('admin.user.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" name="search" id="search" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2" placeholder="Search by username or name" value="{{ request('search') }}">
                </div>
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Filter by Role</label>
                <select id="role" name="role" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>
            
            <div class="self-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <i class="ph ph-funnel mr-2"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($user as $u)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $u->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if ($u->guru)
                                {{ $u->guru->nama }}
                            @elseif ($u->siswa)
                                {{ $u->siswa->nama }}
                            @else
                                <span class="text-gray-400">No name</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->email ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($u->role == 'admin')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Admin
                                </span>
                            @elseif($u->role == 'guru')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Guru
                                </span>
                            @elseif($u->role == 'siswa')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Siswa
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $u->role }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.user.show', $u->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-md transition-colors duration-150">
                                    <i class="ph ph-eye"></i>
                                </a>
                                <a href="{{ route('admin.user.edit', $u->id) }}" class="text-amber-600 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 p-2 rounded-md transition-colors duration-150">
                                    <i class="ph ph-pencil-simple"></i>
                                </a>
                                <form onsubmit="return confirm('Are you sure you want to delete this user?')" method="POST" action="{{ route('admin.user.destroy', $u->id) }}" class="inline">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-md transition-colors duration-150">
                                        <i class="ph ph-trash-simple"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($user->hasPages())
        <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
            {{ $user->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>