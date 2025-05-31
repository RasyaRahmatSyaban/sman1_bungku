@props(['title', 'section_title' => 'Menu', 'section_description' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <title>{{ $title }} | School Management</title>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4 py-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center h-14 w-14 rounded-full bg-blue-100 text-blue-600 mb-4">
                <i class="ph ph-student text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">School Management</h1>
            <p class="text-sm text-gray-500">Manage your school efficiently</p>
        </div>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-8">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $section_title }}</h2>
                    @if($section_description)
                        <p class="mt-1 text-sm text-gray-500">{{ $section_description }}</p>
                    @endif
                </div>
                
                <div class="mt-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} School Management System. All rights reserved.
        </div>
    </div>
</body>

</html>