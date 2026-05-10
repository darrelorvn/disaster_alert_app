<?php $__env->startSection('content'); ?>
    <section class="warning-banner">
        <div class="warning-copy">
            <span class="warning-badge">WASPADA</span>
            <h2>Potensi Banjir Kiriman: Bendung Katulampa Siaga 2</h2>
            <p>Debit air berpotensi meningkat dalam 4–6 jam ke depan. Gunakan jalur evakuasi yang tersedia.</p>
        </div>

        <div class="warning-actions">
            <a href="<?php echo e(route('user.map')); ?>">Jalur Evakuasi</a>
            <a href="<?php echo e(route('user.safety')); ?>">Shelter Terdekat</a>
        </div>
    </section>

    <section class="dashboard-grid">
        <article class="map-panel">
            <div class="panel-heading">
                <h3>Peta Evakuasi</h3>
                <span>Radius 5 km</span>
            </div>

            <div class="map-visual">
                <span class="map-pin pin-a"></span>
                <span class="map-pin pin-b"></span>
                <span class="map-pin pin-c"></span>
                <span class="map-pin blue pin-d"></span>
                <span class="route-line line-a"></span>
                <span class="route-line line-b"></span>
                <span class="route-line line-c"></span>

                <div class="map-legend">
                    <span><i class="legend-orange"></i> Titik Evakuasi</span>
                    <span><i class="legend-blue"></i> Fasilitas Kesehatan</span>
                    <span><i class="legend-line"></i> Jalur Evakuasi</span>
                </div>

                <div class="map-controls">
                    <button>+</button>
                    <button>−</button>
                </div>
            </div>
        </article>

        <aside class="quick-panel">
            <h3>Aksi Cepat Tanggap</h3>

            <a class="quick-action" href="#">
                <span>▣</span>
                <div>
                    <strong>Faskes Terdekat</strong>
                    <small>RSUD & Klinik 24 jam</small>
                </div>
            </a>

            <a class="quick-action" href="#">
                <span>⌖</span>
                <div>
                    <strong>Shelter Terdekat</strong>
                    <small>Titik kumpul & logistik</small>
                </div>
            </a>

            <a class="quick-action muted" href="#">
                <span>☎</span>
                <div>
                    <strong>Nomor Darurat</strong>
                    <small>Ambulans, Damkar, Polisi</small>
                </div>
            </a>
        </aside>
    </section>

    <section class="recent-section">
        <div class="section-title-row">
            <h3>Kejadian Terbaru Sekitarmu</h3>
            <a href="#">Lihat Semua →</a>
        </div>

        <div class="incident-list">
            <article class="incident-card">
                <span class="incident-type warning">Peringatan</span>
                <h4>Kenaikan Debit Air</h4>
                <p>9 menit yang lalu</p>
                <strong>Siaga 3</strong>
            </article>

            <article class="incident-card">
                <span class="incident-type info">Info</span>
                <h4>Pohon Tumbang</h4>
                <p>Menteng</p>
                <strong class="safe-text">Telah Ditangani</strong>
            </article>

            <article class="incident-card">
                <span class="incident-type danger">Darurat</span>
                <h4>Kebakaran Lahan</h4>
                <p>Pulo Gadung</p>
                <strong>Proses Pemadaman</strong>
            </article>

            <article class="incident-card">
                <span class="incident-type info">Info</span>
                <h4>Gempa M 4.2</h4>
                <p>Barat Daya Jakarta</p>
                <strong class="safe-text">Status Aman</strong>
            </article>

            <article class="incident-card">
                <span class="incident-type warning">Peringatan</span>
                <h4>Jalan Tergenang</h4>
                <p>Kemayoran</p>
                <strong>Waspada</strong>
            </article>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\golde\Downloads\alert_disaster_app\resources\views/pages/user/home.blade.php ENDPATH**/ ?>