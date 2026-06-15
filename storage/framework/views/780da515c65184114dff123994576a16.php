

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50 p-8 font-sans text-slate-800">
    
    <?php if(isset($recommendation) && $recommendation): ?>
    <div class="mb-6 bg-orange-500 rounded-xl shadow-md p-6 text-white">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 pb-4 border-b border-orange-400">
            <h2 class="text-xl font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Rekomendasi AI
            </h2>
            <div class="flex items-center gap-2 mt-3 md:mt-0 bg-orange-600 px-3 py-1.5 rounded-lg border border-orange-400">
                <span class="relative flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-300 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-green-400"></span>
                </span>
                <span class="text-sm font-bold text-white tracking-wide">BMKG Status: Connected</span>
            </div>
        </div>
        <p class="text-orange-50 leading-relaxed"><?php echo e($recommendation->recommendation_text); ?></p>
        <form method="POST" action="<?php echo e(route('officer.ai-recommendation.refresh')); ?>" class="mt-5 flex items-center gap-4">
            <?php echo csrf_field(); ?>
            <button type="submit" class="px-4 py-2.5 bg-white text-orange-600 font-bold rounded-lg hover:bg-orange-50 transition shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Perbarui Rekomendasi
            </button>
            <span class="text-sm text-orange-200 font-medium">Diperbarui <?php echo e($recommendation->generated_at->diffForHumans()); ?></span>
        </form>
    </div>
    <?php else: ?>
    <div class="mb-6 flex items-center gap-2 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <span class="relative flex h-3 w-3">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
        </span>
        <span class="text-sm font-bold text-green-600 tracking-wide">BMKG Status: Connected</span>
    </div>
    <?php endif; ?>

    
    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-green-600 border-l-4">
            <div>
                <p class="text-sm font-bold text-green-600">Total Laporan Masuk</p>
                <p class="text-4xl font-bold text-green-600 mt-1"><?php echo e($totalReports); ?></p>
            </div>
            <div class="rounded-full bg-green-50 p-3 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-4 border-l-red-500">
            <div>
                <p class="text-sm font-bold text-red-500">Belum Ditangani</p>
                <p class="text-4xl font-bold text-red-500 mt-1"><?php echo e($unhandledReports); ?></p>
            </div>
            <div class="rounded-full bg-red-50 p-3 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-4 border-l-orange-500">
            <div>
                <p class="text-sm font-bold text-orange-500">Total Wilayah Aktif</p>
                <p class="text-4xl font-bold text-orange-500 mt-1"><?php echo e($activeAreas); ?></p>
            </div>
            <div class="rounded-full bg-orange-50 p-3 text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>

    
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-red-600 rounded-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-red-900">Titik Pantau Rawan (Berulang)</h3>
                <p class="text-xs font-bold text-red-700 uppercase tracking-tight">Lokasi yang sering mengalami kejadian serupa dalam periode terakhir</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $recurringDisasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recurring): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-xl border border-red-100 shadow-sm flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center shrink-0 border border-red-100">
                    <span class="text-lg font-black text-red-600"><?php echo e($recurring->total_occurrences); ?>x</span>
                </div>
                <div class="min-w-0">
                    <h4 class="text-sm font-black text-slate-800 truncate uppercase"><?php echo e($recurring->location_name); ?></h4>
                    <p class="text-xs font-bold text-slate-500 mt-0.5">Jenis: <span class="text-red-600"><?php echo e(strtoupper(str_replace('_', ' ', $recurring->type))); ?></span></p>
                    <div class="mt-2 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="text-[10px] font-black text-red-500 uppercase">Prioritas Tindak Lanjut</span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full py-4 text-center text-red-800/50 italic text-sm font-bold">
                Belum terdeteksi adanya lokasi dengan kejadian berulang yang signifikan.
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        
        
        <form id="filterForm" method="GET" action="<?php echo e(route('officer.home')); ?>" class="mb-4 flex flex-wrap items-center gap-3">
            <div class="relative">
                <select name="type" onchange="document.getElementById('filterForm').submit()" class="appearance-none w-44 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 cursor-pointer">
                    <option value="">Semua Bencana</option>
                    <option value="banjir" <?php echo e(request('type') == 'banjir' ? 'selected' : ''); ?>>Banjir</option>
                    <option value="kebakaran" <?php echo e(request('type') == 'kebakaran' ? 'selected' : ''); ?>>Kebakaran</option>
                    <option value="gempa" <?php echo e(request('type') == 'gempa' ? 'selected' : ''); ?>>Gempa Bumi</option>
                    <option value="tanah_longsor" <?php echo e(request('type') == 'tanah_longsor' ? 'selected' : ''); ?>>Tanah Longsor</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>

            <div class="relative">
                <select name="status" onchange="document.getElementById('filterForm').submit()" class="appearance-none w-44 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="submitted" <?php echo e(request('status') == 'submitted' ? 'selected' : ''); ?>>Darurat (Baru)</option>
                    <option value="verified" <?php echo e(request('status') == 'verified' ? 'selected' : ''); ?>>Divalidasi</option>
                    <option value="in_progress" <?php echo e(request('status') == 'in_progress' ? 'selected' : ''); ?>>Diproses</option>
                    <option value="handled" <?php echo e(request('status') == 'handled' ? 'selected' : ''); ?>>Selesai</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>

            <?php if(request()->filled('type') || request()->filled('status')): ?>
                <a href="<?php echo e(route('officer.home')); ?>" class="text-sm font-bold text-red-500 hover:text-red-700 px-2 transition">
                    Reset Filter
                </a>
            <?php endif; ?>
        </form>
        
        
        <div class="relative h-[400px] w-full rounded-xl border border-slate-200 bg-slate-100 overflow-hidden">
            <div id="distributionMap" class="absolute inset-0 z-0"></div>
            
            <div class="absolute bottom-4 right-4 flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm z-[500]">
                <button id="zoomInBtn" class="p-2 text-slate-600 hover:bg-slate-100 border-b border-slate-200 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                </button>
                <button id="zoomOutBtn" class="p-2 text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                </button>
            </div>
        </div>
    </div>

    
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Daftar Laporan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="border-b border-slate-200 bg-slate-50/50 text-xs uppercase text-slate-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Waktu Kejadian</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Jenis Bencana</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Lokasi</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $latestReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-4">
                            <?php if($report->status === 'submitted'): ?>
                                <span class="rounded bg-red-100 px-2.5 py-1 text-xs font-bold text-red-600">DARURAT</span>
                            <?php elseif($report->status === 'verified'): ?>
                                <span class="rounded bg-orange-100 px-2.5 py-1 text-xs font-bold text-orange-600">DIVALIDASI</span>
                            <?php elseif($report->status === 'in_progress'): ?>
                                <span class="rounded bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-600">DIPROSES</span>
                            <?php elseif($report->status === 'handled'): ?>
                                <span class="rounded bg-green-100 px-2.5 py-1 text-xs font-bold text-green-600">SELESAI</span>
                            <?php else: ?>
                                <span class="rounded bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">DITOLAK</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap"><?php echo e($report->occurred_at ? \Carbon\Carbon::parse($report->occurred_at)->format('d M Y, H:i') : '-'); ?></td>
                        <td class="px-4 py-4 font-bold text-slate-800 uppercase"><?php echo e(str_replace('_', ' ', $report->type)); ?></td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <?php echo e($report->location_name ?? 'Titik Peta'); ?>

                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <a href="#" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-600 transition-colors hover:bg-orange-100 hover:text-orange-700">
                                Detail <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                Tidak ada data laporan sesuai filter ini.
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.heat/dist/leaflet-heat.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('distributionMap')) {
        var map = L.map('distributionMap', {
            zoomControl: false
        }).setView([-6.2250, 106.9004], 11);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        document.getElementById('zoomInBtn').addEventListener('click', function(e) {
            e.preventDefault(); map.zoomIn();
        });
        
        document.getElementById('zoomOutBtn').addEventListener('click', function(e) {
            e.preventDefault(); map.zoomOut();
        });

        // Inject Data dari Controller
        var incidentData = <?php echo json_encode($mapData); ?>;

        if (incidentData.length > 0) {
            var heatPoints = [];
            var bounds = [];
            
            incidentData.forEach(function(incident) {
                if (incident.lat && incident.lng) {
                    // Heatmap point: [lat, lng, intensity]
                    // Kita asumsikan intensitas 1 per laporan
                    heatPoints.push([incident.lat, incident.lng, 0.8]);
                    bounds.push([incident.lat, incident.lng]);
                }
            });

            // Konfigurasi Heatmap
            var heat = L.heatLayer(heatPoints, {
                radius: 25,
                blur: 15,
                maxZoom: 10,
                gradient: {
                    0.2: 'blue',
                    0.4: 'cyan',
                    0.6: 'lime',
                    0.8: 'yellow',
                    1.0: 'red'
                }
            }).addTo(map);

            // Otomatis menyesuaikan zoom dan posisi peta agar semua data terlihat
            if (bounds.length > 0) {
                map.fitBounds(bounds, { padding: [40, 40], maxZoom: 14 });
            }
        }

        setTimeout(function () {
            map.invalidateSize();
        }, 500);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views/pages/officer/home.blade.php ENDPATH**/ ?>