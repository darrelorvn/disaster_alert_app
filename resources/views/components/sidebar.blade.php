@php
    $routeName = Route::currentRouteName();
    $isOfficer = str_starts_with((string) $routeName, 'officer.');

    $userMenus = [
        ['label' => 'Beranda', 'route' => 'user.home', 'match' => ['user.home'], 'icon' => '⌂'],
        ['label' => 'Peta dan Evakuasi', 'route' => 'user.map', 'match' => ['user.map'], 'icon' => '⌖'],
        ['label' => 'Laporkan Bencana', 'route' => 'user.report', 'match' => ['user.report'], 'icon' => '△'],
        ['label' => 'Panduan Aman', 'route' => 'user.safety', 'match' => ['user.safety'], 'icon' => '◇'],
        ['label' => 'Profil', 'route' => 'user.profile', 'match' => ['user.profile'], 'icon' => '♙'],
    ];

    $officerMenus = [
        ['label' => 'Dashboard Petugas', 'route' => 'officer.home', 'match' => ['officer.home'], 'icon' => '⌂'],
        ['label' => 'Kelola Data', 'route' => 'officer.manage-data', 'match' => ['officer.manage-data'], 'icon' => '▤'],
        ['label' => 'Profil Petugas', 'route' => 'officer.profile', 'match' => ['officer.profile'], 'icon' => '♙'],
    ];

    $menus = $isOfficer ? $officerMenus : $userMenus;
@endphp

<aside class="app-sidebar">
    <div class="sidebar-heading">
        {{ $isOfficer ? 'Dashboard petugas' : 'Dashboard masyarakat' }}
    </div>

    <nav class="sidebar-menu" aria-label="Navigasi utama">
        @foreach ($menus as $menu)
            @php
                $isActive = in_array($routeName, $menu['match'], true);
            @endphp

            <a href="{{ route($menu['route']) }}" class="sidebar-link {{ $isActive ? 'active' : '' }}">
                <span class="sidebar-icon">{{ $menu['icon'] }}</span>
                <span>{{ $menu['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <a href="#"><span class="sidebar-icon">⚙</span><span>Settings</span></a>
        <a href="#"><span class="sidebar-icon">?</span><span>Support</span></a>
    </div>
</aside>
