<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="container">
        <nav class="nav">
            <a href="{{ route('user.home') }}">Beranda User</a>
            <a href="{{ route('user.map') }}">Peta & Evakuasi</a>
            <a href="{{ route('user.report') }}">Laporkan Bencana</a>
            <a href="{{ route('user.safety') }}">Panduan Aman</a>
            <a href="{{ route('user.profile') }}">Profil User</a>
            <a href="{{ route('officer.home') }}">Beranda Petugas</a>
            <a href="{{ route('officer.manage-data') }}">Kelola Data</a>
        </nav>

        @yield('content')
    </main>
</body>
</html>
