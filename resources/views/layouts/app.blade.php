<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Siaga Bencana') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://kit.fontawesome.com/c6a35e66f0.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>
<body class="flex flex-col h-screen m-0 overflow-hidden font-sans text-gray-100">
    
    <x-header />

    <div class="flex flex-1 overflow-hidden">
        
        <x-sidebar />

        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
        
    </div>
    @stack('scripts')
</body>
</html>