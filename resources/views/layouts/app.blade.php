<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Siaga Bencana') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <x-sidebar />

        <section class="app-main">
            <x-header />

            <main class="app-content">
                @yield('content')
            </main>
        </section>
    </div>
</body>
</html>
