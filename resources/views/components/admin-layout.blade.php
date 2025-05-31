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

<body class="bg-zinc-50 min-h-screen flex flex-col">
    <header x-data="{ open: false }" class="bg-white border-b border-zinc-200 sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h2 class="text-xl font-bold text-gray-800">School Management</h2>
                    
                    <!-- Desktop Navigation -->
                    <nav class="hidden sm:ml-10 sm:flex sm:space-x-4">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->is('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.guru.index') }}" 
                           class="{{ request()->is('guru*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Guru
                        </a>
                        <a href="{{ route('admin.kelas.index') }}" 
                           class="{{ request()->is('kelas*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Kelas
                        </a>
                        <a href="{{ route('admin.siswa.index') }}" 
                           class="{{ request()->is('siswa*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Siswa
                        </a>
                        <a href="{{ route('admin.mata-pelajaran.index') }}" 
                           class="{{ request()->is('mata-pelajaran*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Mata Pelajaran
                        </a>
                        <a href="{{ route('admin.jadwal.index') }}" 
                           class="{{ request()->is('jadwal*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Jadwal
                        </a>
                        <a href="{{ route('admin.absensi.index') }}" 
                           class="{{ request()->is('absensi*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            Absensi
                        </a>
                        <a href="{{ route('admin.user.index') }}" 
                           class="{{ request()->is('user*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                           px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            User
                        </a>
                    </nav>
                </div>
                
                <!-- Profile dropdown (optional) -->
                <div class="hidden sm:flex sm:items-center">
                    <a href="{{route('admin.profile')}}" class="text-gray-600 hover:text-gray-900 p-2 rounded-full hover:bg-gray-100">
                        <i class="ph ph-user-circle text-xl"></i>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button x-on:click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                        <i class="ph ph-list text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" class="sm:hidden border-t border-gray-200 bg-white">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="{{ request()->is('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Dashboard
                </a>
                <a href="{{ route('admin.guru.index') }}" 
                   class="{{ request()->is('guru*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Guru
                </a>
                <a href="{{ route('admin.kelas.index') }}" 
                   class="{{ request()->is('kelas*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Kelas
                </a>
                <a href="{{ route('admin.siswa.index') }}" 
                   class="{{ request()->is('siswa*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Siswa
                </a>
                <a href="{{ route('admin.mata-pelajaran.index') }}" 
                   class="{{ request()->is('mata-pelajaran*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Mata Pelajaran
                </a>
                <a href="{{ route('admin.jadwal.index') }}" 
                   class="{{ request()->is('jadwal*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Jadwal
                </a>
                <a href="{{ route('admin.absensi.index') }}" 
                   class="{{ request()->is('absensi*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    Absensi
                </a>
                <a href="{{ route('admin.user.index') }}" 
                   class="{{ request()->is('user*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} 
                   block px-3 py-2 rounded-md text-base font-medium" x-on:click="open = false">
                    User
                </a>
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