@props(['title', 'section_title'=> 'Menu'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <title>{{ $title }} | School Management</title>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <header x-data="{ open: false, profileOpen: false }" class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="ph ph-student text-blue-600 text-2xl mr-2"></i>
                        <h2 class="text-lg font-bold text-gray-800">School Management</h2>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <nav class="hidden sm:ml-10 sm:flex sm:space-x-4">
                        <a href="{{ route('siswa.dashboard') }}" 
                           class="{{ request()->is('siswa/dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <i class="ph ph-chart-pie mr-1"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('siswa.jadwal.index') }}" 
                           class="{{ request()->is('siswa/jadwal*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <i class="ph ph-calendar mr-1"></i>
                            Jadwal
                        </a>
                        <a href="{{ route('siswa.kelas.index') }}" 
                           class="{{ request()->is('siswa/kelas*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <i class="ph ph-chalkboard mr-1"></i>
                            Kelas
                        </a>
                        <a href="{{ route('siswa.absensi.index') }}" 
                           class="{{ request()->is('siswa/absensi*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <i class="ph ph-clipboard mr-1"></i>
                            Absensi
                        </a>
                        <a href="{{ route('siswa.nilai.index') }}" 
                           class="{{ request()->is('siswa/nilai*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <i class="ph ph-medal mr-1"></i>
                            Nilai
                        </a>
                    </nav>
                </div>
                
                <!-- Profile dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            <i class="ph ph-user-circle text-xl"></i>
                            <span class="text-sm font-medium">Profile</span>
                            <i class="ph ph-caret-down text-sm"></i>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                             style="display: none;">
                            <div class="py-1">
                                <a href="{{ route('siswa.profile.show') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                    <i class="ph ph-user mr-3 text-gray-500 group-hover:text-gray-600"></i>
                                    Your Profile
                                </a>
                            </div>
                            <div class="py-1">
                                <form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="group flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                        <i class="ph ph-sign-out mr-3 text-gray-500 group-hover:text-gray-600"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        <i x-show="!open" class="ph ph-list text-xl"></i>
                        <i x-show="open" class="ph ph-x text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" class="sm:hidden border-t border-gray-200 bg-white" style="display: none;">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('siswa.dashboard') }}" 
                   class="{{ request()->is('siswa/dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-chart-pie mr-2"></i>
                    Dashboard
                </a>
                <a href="{{ route('siswa.jadwal.index') }}" 
                   class="{{ request()->is('siswa/jadwal*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-calendar mr-2"></i>
                    Jadwal
                </a>
                <a href="{{ route('siswa.kelas.index') }}" 
                   class="{{ request()->is('siswa/kelas*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-chalkboard mr-2"></i>
                    Kelas
                </a>
                <a href="{{ route('siswa.absensi.index') }}" 
                   class="{{ request()->is('siswa/absensi*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-clipboard mr-2"></i>
                    Absensi
                </a>
                <a href="{{ route('siswa.nilai.index') }}" 
                   class="{{ request()->is('siswa/nilai*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-medal mr-2"></i>
                    Nilai
                </a>
            </div>
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('siswa.profile.show') }}" class="hover:bg-gray-100 text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150" @click="open = false">
                    <i class="ph ph-user mr-2"></i>
                    Profile
                </a>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    @method("delete")
                    <button type="submit" class="hover:bg-gray-100 text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-150 w-full text-left" @click="open = false">
                        <i class="ph ph-sign-out mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $section_title }}</h1>
            </div>
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-gray-500">© {{ date('Y') }} School Management System</p>
        </div>
    </footer>
</body>
</html>