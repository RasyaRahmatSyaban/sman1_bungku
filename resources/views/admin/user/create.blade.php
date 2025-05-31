<x-admin-layout title="Create User" section_title="Add New User">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
            <div class="p-6">
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <div class="mt-1">
                                <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                    placeholder="Username" required>
                                @error('username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" id="email" name="email" value="{{ old('email') }}" 
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
                                <select id="role" name="role" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                </select>
                                @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input type="password" id="password" name="password" 
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" 
                                    placeholder="Password" required>
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
                                    placeholder="Confirm password" required>
                            </div>
                        </div>
                        
                        <div id="related_id_container" class="hidden">
                            <label for="related_id" class="block text-sm font-medium text-gray-700">
                                <span id="related_label">Select Related User</span>
                            </label>
                            <div class="mt-1">
                                <select id="related_id" name="related_id" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
                                    <option value="" selected disabled>Select a user</option>
                                    <!-- Options will be populated via JavaScript -->
                                </select>
                                @error('related_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.user.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            <i class="ph ph-floppy-disk mr-2"></i>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const relatedContainer = document.getElementById('related_id_container');
            const relatedSelect = document.getElementById('related_id');
            const relatedLabel = document.getElementById('related_label');
            
            roleSelect.addEventListener('change', function() {
                const role = this.value;
                
                // Clear previous options
                relatedSelect.innerHTML = '<option value="" selected disabled>Select a user</option>';
                
                if (role === 'guru') {
                    relatedLabel.textContent = 'Select Teacher';
                    relatedContainer.classList.remove('hidden');
                    // Here you would fetch teachers via AJAX and populate the select
                    // For now, we'll just show the container
                } else if (role === 'siswa') {
                    relatedLabel.textContent = 'Select Student';
                    relatedContainer.classList.remove('hidden');
                    // Here you would fetch students via AJAX and populate the select
                } else {
                    relatedContainer.classList.add('hidden');
                }
            });
            
            // Trigger change event if a role is already selected (e.g., on form validation error)
            if (roleSelect.value) {
                roleSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-admin-layout>