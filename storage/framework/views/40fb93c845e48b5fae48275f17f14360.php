<?php
    $pageTitles = [
        'user.home' => 'Dashboard masyarakat',
        'user.map' => 'Peta dan Evakuasi',
        'user.report' => 'Laporkan Bencana',
        'user.safety' => 'Panduan Aman',
        'user.profile' => 'Profil Pengguna',
        'officer.home' => 'Dashboard petugas',
        'officer.manage-data' => 'Kelola Data Petugas',
        'officer.profile' => 'Profil Petugas',
    ];

    $currentTitle = $pageTitles[Route::currentRouteName()] ?? 'Dashboard masyarakat';
?>

<header class="flex items-center w-full h-14 px-6 bg-slate-900 text-white shadow-sm z-10 relative">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-shield-halved text-orange-500 text-lg"></i>
        <h1 class="text-sm font-bold tracking-widest uppercase">Sentinel Public Safety</h1>
    </div>
</header><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views/components/header.blade.php ENDPATH**/ ?>