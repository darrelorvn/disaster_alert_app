@php
    $routeName = Route::currentRouteName();
    $isOfficer = \Illuminate\Support\Str::startsWith((string) $routeName, 'officer.');

    $userMenus = [
        ['label' => 'Beranda', 'route' => 'user.home', 'match' => ['user.home', 'user.home.public'], 'icon' => 'fa-solid fa-bullseye'],
        ['label' => 'Peta dan Evakuasi', 'route' => 'user.map', 'match' => ['user.map'], 'icon' => 'fa-regular fa-map'],
        ['label' => 'Laporkan Bencana', 'route' => 'user.report', 'match' => ['user.report'], 'icon' => 'fa-solid fa-triangle-exclamation'],
        ['label' => 'Panduan Aman', 'route' => 'user.safety', 'match' => ['user.safety'], 'icon' => 'fa-solid fa-shield-halved'],
        ['label' => 'Profil', 'route' => 'user.profile', 'match' => ['user.profile'], 'icon' => 'fa-regular fa-user'],
    ];

    $officerMenus = [
        ['label' => 'Dashboard Petugas', 'route' => 'officer.home', 'match' => ['officer.home'], 'icon' => 'fa-solid fa-bullseye'],
        ['label' => 'Kelola Data', 'route' => 'officer.manage-data', 'match' => ['officer.manage-data', 'officer.kelola-data.*'], 'icon' => 'fa-solid fa-database'],
        ['label' => 'Profil Petugas', 'route' => 'officer.profile', 'match' => ['officer.profile'], 'icon' => 'fa-regular fa-user'],
    ];

    $menus = $isOfficer ? $officerMenus : $userMenus;
@endphp

<aside class="flex flex-col w-64 h-full bg-slate-800 text-gray-400">
    <nav class="flex-1 py-4" aria-label="Navigasi utama">
        <ul class="space-y-1">
            @foreach ($menus as $menu)
                @php
                    $isActive = false;
                    foreach ($menu['match'] as $pattern) {
                        if (\Illuminate\Support\Str::is($pattern, $routeName)) {
                            $isActive = true;
                            break;
                        }
                    }
                @endphp

                <li>
                    <a href="{{ route($menu['route']) }}"
                        class="flex items-center gap-4 px-6 py-3 text-sm transition-colors duration-200 
                                {{ $isActive ? 'bg-slate-700 text-orange-500 border-r-2 border-orange-500' : 'hover:bg-slate-700 hover:text-gray-200' }}">
                        <i class="{{ $menu['icon'] }} w-5 text-center {{ $isActive ? 'text-orange-500' : 'text-gray-400' }}"></i>
                        <span>{{ $menu['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="px-2 py-4 mt-auto mb-4 space-y-1">
        <a href="#" class="flex items-center gap-4 px-4 py-2 text-sm transition-colors duration-200 rounded text-gray-400 hover:bg-slate-700 hover:text-gray-200">
            <i class="fa-solid fa-gear w-5 text-center"></i>
            <span>Settings</span>
        </a>
        <a href="#" class="flex items-center gap-4 px-4 py-2 text-sm transition-colors duration-200 rounded text-gray-400 hover:bg-slate-700 hover:text-gray-200">
            <i class="fa-regular fa-circle-question w-5 text-center"></i>
            <span>Support</span>
        </a>
    </div>
</aside>