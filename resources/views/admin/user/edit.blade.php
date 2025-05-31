<x-admin-layout title="Edit User" section_title="Edit User Information">
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
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <div class="mt-1">
                                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                        placeholder="Username">
                                    @error('username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                        placeholder="Email">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <div class="mt-1">
                                    <select id="role" name="role" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    </select>
                                    @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
                                <div class="mt-1">
                                    <input type="password" id="password" name="password" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                        placeholder="New password">
                                    @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <div class="mt-1">
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                        placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.user.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                <i class="ph ph-floppy-disk mr-2"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>