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

<header class="app-header">
    <div class="topbar">
        <div class="topbar-left">
            <p class="header-eyebrow"><?php echo e($currentTitle); ?></p>

            <div class="topbar-brand">
                <span class="header-logo">S</span>
                <h1>SENTINEL PUBLIC SAFETY</h1>
            </div>
        </div>
    </div>

    <section class="situation-strip" aria-label="Ringkasan situasi">
        <div class="situation-card location-card">
            <span class="card-kicker">Cakupan Wilayah</span>
            <strong>Jakarta Pusat, DKI Jakarta</strong>
            <small>Pembaruan terakhir: 2 menit yang lalu</small>
        </div>

        <div class="situation-card status-card">
            <span class="status-pulse"></span>
            <div>
                <span class="card-kicker">Status Wilayah</span>
                <strong>Aman</strong>
            </div>
        </div>

        <div class="situation-card ai-card">
            <span class="card-kicker">Rekomendasi AI</span>
            <strong>Situasi terkendali</strong>
            <small>Gunakan peta evakuasi saat kondisi berubah.</small>
        </div>
    </section>
</header>
<?php /**PATH C:\Users\golde\Downloads\alert_disaster_app\resources\views/components/header.blade.php ENDPATH**/ ?>