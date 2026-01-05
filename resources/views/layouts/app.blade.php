<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Ruangan')</title>
    
    <!-- Option 1: Vite (preferred) -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Option 2: Tailwind CDN (fallback) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style type="text/tailwindcss">
            @layer base {
                body {
                    @apply bg-gray-50;
                }
            }
        </style>
    @endif
</head>
<body class="bg-gray-50">
    @yield('content')
</body>
</html>
