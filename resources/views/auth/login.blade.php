<x-auth-layout title="Login" section_title="Welcome Back" section_description="Login to access your account">
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ph ph-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ph ph-x-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('auth.authenticate') }}" method="POST" class="space-y-6">
            @csrf
            @method("POST")
            
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph ph-user text-gray-400"></i>
                    </div>
                    <input type="text" id="username" name="username" 
                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2.5" 
                        placeholder="Your username" value="{{ old('username') }}" />
                </div>
                @error('username')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph ph-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password"
                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2.5" 
                        placeholder="Your Password" />
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <button type="submit" class="w-full flex justify-center items-center px-4 py-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <i class="ph ph-sign-in mr-2"></i>
                    Login
                </button>
            </div>
        </form>
        
        <div class="text-center space-y-2">
            <p class="text-sm text-gray-600">
                Don't have an account?
            </p>
            <p class="text-sm text-gray-600">
                Please contact your class teacher
            </p>
        </div>
    </div>
</x-auth-layout>