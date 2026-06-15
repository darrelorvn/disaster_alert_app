

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    #evacuationMap { height: 292px !important; width: 100% !important; background: #f8fafc; }
    .leaflet-routing-container { display: none !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">

    
    <section class="min-h-[106px] bg-gradient-to-br from-[#fb923c] via-[#f97316] to-[#ff8a3d] rounded-[18px] text-white flex flex-col md:flex-row md:items-center justify-between gap-6 py-[22px] px-6 shadow-[0_18px_35px_rgba(249,115,22,0.24)]">
        <div class="max-w-[720px] w-full">
            <span class="inline-flex mb-[7px] py-1 px-2 rounded-full bg-white/20 text-[#fff7ed] text-[9px] font-black tracking-[0.08em]">WASPADA</span>
            <h2 class="m-0 mb-1.5 text-lg leading-[1.25] font-bold">Potensi Banjir Kiriman: Bendung Katulampa Siaga 2</h2>
            <p class="m-0 text-white/90 text-xs font-semibold">Debit air berpotensi meningkat dalam 4-6 jam ke depan. Gunakan jalur evakuasi yang tersedia.</p>
        </div>
        <div class="flex flex-row md:flex-col gap-[9px] min-w-[150px] w-full md:w-auto">
            <a href="<?php echo e(route('user.map.evakuasi')); ?>" class="flex-1 text-white no-underline text-center text-xs font-black py-[9px] px-3 border border-white/50 rounded-[9px] bg-white/10 hover:bg-white/20 transition-colors">Jalur Evakuasi</a>
            <a href="<?php echo e(route('user.map.shelter')); ?>" class="flex-1 text-white no-underline text-center text-xs font-black py-[9px] px-3 border border-white/50 rounded-[9px] bg-white/10 hover:bg-white/20 transition-colors">Shelter Terdekat</a>
        </div>
    </section>

    
    <section class="mt-[22px] grid grid-cols-1 lg:grid-cols-[1fr_285px] gap-[22px] items-stretch">

        <article class="p-4 bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <div class="flex items-center justify-between gap-4 mb-3.5">
                <h3 class="m-0 text-[#172033] text-sm font-black">Peta Evakuasi</h3>
                <button id="btn-deteksi-lokasi" class="inline-flex items-center gap-1.5 rounded-lg border border-orange-200 bg-orange-50 px-3 py-1.5 text-[11px] font-bold text-orange-600 transition hover:bg-orange-100 cursor-pointer">
                    <i class="fa-solid fa-location-crosshairs text-xs"></i> Lokasi Saya
                </button>
            </div>
            <div id="lokasi-status" class="hidden mb-3 flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2">
                <i id="lokasi-status-icon" class="fa-solid fa-circle-check text-emerald-500 text-xs shrink-0"></i>
                <p id="lokasi-status-text" class="text-[11px] font-bold text-emerald-700"></p>
            </div>
            <div id="evacuationMap" class="relative overflow-hidden rounded-[14px] z-0"></div>
            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Legenda:</span>
                <div class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-full bg-orange-500 shrink-0"></span><span class="text-[11px] font-semibold text-slate-500">Jalur Evakuasi</span></div>
                <div class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span><span class="text-[11px] font-semibold text-slate-500">Shelter</span></div>
                <div class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-full bg-orange-400 shrink-0"></span><span class="text-[11px] font-semibold text-slate-500">Posko Darurat</span></div>
                <div class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-full bg-blue-500 shrink-0"></span><span class="text-[11px] font-semibold text-slate-500">Faskes</span></div>
                <div class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-full bg-violet-500 shrink-0"></span><span class="text-[11px] font-semibold text-slate-500">Lokasi Saya</span></div>
            </div>
        </article>

        <aside class="p-[18px] bg-[#162238] text-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <h3 class="m-0 mb-3.5 text-white text-sm font-black">Aksi Cepat Tanggap</h3>
            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="<?php echo e(route('user.map.faskes')); ?>">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-kit-medical"></i></span>
                <div><strong class="block text-xs font-black">Faskes Terdekat</strong><small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">RSUD & Klinik 24 jam</small></div>
            </a>
            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="<?php echo e(route('user.map.shelter')); ?>">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-building-columns"></i></span>
                <div><strong class="block text-xs font-black">Shelter Terdekat</strong><small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Titik kumpul & logistik</small></div>
            </a>
            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="<?php echo e(route('user.map.evakuasi')); ?>">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#10b981] inline-flex items-center justify-center text-sm shrink-0"><i class="fa-solid fa-route"></i></span>
                <div><strong class="block text-xs font-black">Jalur Evakuasi</strong><small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Rute aman menuju shelter</small></div>
            </a>
            <a href="<?php echo e(route('user.tindakan-preventif.index')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 mt-3 w-full justify-center text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">
                <i class="fa-solid fa-clipboard-list"></i> Daftar Tindakan Preventif
            </a>
        </aside>
    </section>

    
    <section class="mt-[22px] p-[18px] bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
        <div class="flex items-center justify-between gap-4">
            <h3 class="m-0 text-[#172033] text-sm font-black">Kejadian Terbaru Sekitarmu</h3>
            <a href="#" class="text-[#94a3b8] text-[11px] font-extrabold no-underline hover:text-orange-500 transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="mt-3.5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1 text-[#172033] text-xs font-black">Kenaikan Debit Air</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">9 menit yang lalu</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Siaga 3</strong>
            </article>
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info</span>
                <h4 class="m-0 mb-1 text-[#172033] text-xs font-black">Pohon Tumbang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Menteng</p>
                <strong class="text-[#16a34a] text-[10px] font-black uppercase">Telah Ditangani</strong>
            </article>
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#be123c] bg-[#fff1f2]">Darurat</span>
                <h4 class="m-0 mb-1 text-[#172033] text-xs font-black">Kebakaran Lahan</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Pulo Gadung</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Proses Pemadaman</strong>
            </article>
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span id="bmkg-tag" class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info BMKG</span>
                <h4 id="bmkg-judul" class="m-0 mb-1 text-[#172033] text-xs font-black">Memuat Data...</h4>
                <p id="bmkg-deskripsi" class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold line-clamp-2">Menghubungkan BMKG</p>
                <strong id="bmkg-status" class="text-[#16a34a] text-[10px] font-black uppercase">Pengecekan</strong>
            </article>
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1 text-[#172033] text-xs font-black">Jalan Tergenang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Kemayoran</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Waspada</strong>
            </article>
            <div class="mt-6 w-full col-span-1 sm:col-span-2 lg:col-span-5">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h3 class="m-0 text-[#172033] text-sm font-black">Daftar Gempa Bumi Terkini (Live BMKG)</h3>
                    <span class="text-[#16a34a] text-[10px] font-black uppercase tracking-wider bg-green-50 px-2.5 py-1 rounded-full animate-pulse">&#9679; Terhubung Sistem</span>
                </div>
                <div class="bg-white border border-[#e6ebf2] rounded-[14px] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[#e8edf5] text-[#94a3b8] text-[11px] font-extrabold uppercase tracking-wider bg-slate-50">
                                    <th class="p-3 pl-4">Waktu</th><th class="p-3">Kekuatan</th><th class="p-3">Kedalaman</th><th class="p-3">Wilayah Potensi</th><th class="p-3 pr-4 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody id="bmkg-list-container" class="text-xs text-[#172033] font-semibold divide-y divide-[#e8edf5]">
                                <tr><td colspan="5" class="p-4 text-center text-[#94a3b8] font-bold">Mengunduh riwayat bencana dari server BMKG...</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination-controls" class="flex items-center justify-between border-t border-[#e8edf5] bg-white px-4 py-3 sm:px-6"></div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('evacuationMap').setView([-6.2088, 106.8456], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);

    function buatMarkerIcon(warna) {
        return L.divIcon({
            className: 'bg-transparent border-0',
            html: '<div style="width:24px;height:32px;display:flex;justify-content:center;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width:24px;height:32px;filter:drop-shadow(0 2px 3px rgba(0,0,0,0.25));"><path fill="' + warna + '" stroke="#ffffff" stroke-width="18" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg></div>',
            iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -34]
        });
    }

    const warnaMarker = { shelter: '#10b981', emergency_post: '#f97316', health_post: '#3b82f6', health_facility: '#3b82f6', default: '#64748b' };
    const labelTipe   = { shelter: 'Shelter', emergency_post: 'Posko Darurat', health_post: 'Pos Kesehatan', health_facility: 'Fasilitas Kesehatan', default: 'Tempat Darurat' };

    const emergencyPlaces  = <?php echo json_encode($emergencyPlaces ?? []); ?>;
    const evacuationRoutes = <?php echo json_encode($evacuationRoutes ?? []); ?>;
    const allFeatures      = [];

    // Render marker emergency places
    emergencyPlaces.forEach(function (place) {
        const warna  = warnaMarker[place.type] ?? warnaMarker.default;
        const label  = labelTipe[place.type]   ?? labelTipe.default;
        const marker = L.marker([place.lat, place.lng], { icon: buatMarkerIcon(warna) })
            .bindPopup('<div style="min-width:140px"><p style="margin:0 0 3px;font-size:10px;font-weight:800;color:#64748b;text-transform:uppercase">' + label + '</p><p style="margin:0;font-size:12px;font-weight:700;color:#0f172a">' + place.name + '</p></div>')
            .addTo(map);
        allFeatures.push(marker);
    });

    // Render jalur evakuasi via Leaflet Routing Machine (OSRM)
    evacuationRoutes.forEach(function (route) {
        if (!route.start_lat || !route.start_lng || !route.end_lat || !route.end_lng) return;
        L.Routing.control({
            waypoints: [ L.latLng(route.start_lat, route.start_lng), L.latLng(route.end_lat, route.end_lng) ],
            lineOptions: { styles: [{ color: '#f97316', opacity: 0.85, weight: 4, dashArray: '8,5' }] },
            addWaypoints: false, draggableWaypoints: false, fitSelectedRoutes: false, show: false,
            createMarker: function (i, wp) {
                var warna = i === 0 ? '#10b981' : '#ef4444';
                return L.marker(wp.latLng, {
                    icon: L.divIcon({
                        className: 'bg-transparent border-0',
                        html: '<div style="width:10px;height:10px;background:' + warna + ';border:2px solid #fff;border-radius:50%;box-shadow:0 1px 3px rgba(0,0,0,0.3);"></div>',
                        iconSize: [10, 10], iconAnchor: [5, 5]
                    })
                }).bindPopup('<strong>' + (i === 0 ? 'Titik Awal' : 'Titik Akhir') + ':</strong> ' + route.name);
            }
        }).addTo(map);
    });

    if (allFeatures.length > 0) {
        map.fitBounds(L.featureGroup(allFeatures).getBounds(), { padding: [40, 40], maxZoom: 14 });
    }

    // Deteksi lokasi user
    let userMarker = null, userCircle = null, routingControl = null;
    const btnLokasi  = document.getElementById('btn-deteksi-lokasi');
    const statusEl   = document.getElementById('lokasi-status');
    const statusIcon = document.getElementById('lokasi-status-icon');
    const statusText = document.getElementById('lokasi-status-text');

    function tampilkanStatus(tipe, pesan) {
        statusEl.classList.remove('hidden');
        statusEl.classList.add('flex');
        if (tipe === 'sukses') {
            statusEl.className   = 'flex mb-3 items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2';
            statusIcon.className = 'fa-solid fa-circle-check text-emerald-500 text-xs shrink-0';
            statusText.className = 'text-[11px] font-bold text-emerald-700';
        } else {
            statusEl.className   = 'flex mb-3 items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2';
            statusIcon.className = 'fa-solid fa-circle-xmark text-red-500 text-xs shrink-0';
            statusText.className = 'text-[11px] font-bold text-red-700';
        }
        statusText.textContent = pesan;
    }

    btnLokasi.addEventListener('click', function () {
        btnLokasi.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Mendeteksi...';
        btnLokasi.disabled  = true;
        if (!navigator.geolocation) {
            tampilkanStatus('error', 'Browser tidak mendukung geolocation.');
            btnLokasi.innerHTML = '<i class="fa-solid fa-location-crosshairs text-xs"></i> Lokasi Saya';
            btnLokasi.disabled  = false;
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function (pos) {
                const lat = pos.coords.latitude, lng = pos.coords.longitude, acc = Math.round(pos.coords.accuracy);
                if (userMarker)     map.removeLayer(userMarker);
                if (userCircle)     map.removeLayer(userCircle);
                if (routingControl) map.removeControl(routingControl);

                userMarker = L.marker([lat, lng], { icon: buatMarkerIcon('#7c3aed') }).addTo(map)
                    .bindPopup('<div style="min-width:140px"><p style="margin:0 0 3px;font-size:10px;font-weight:800;color:#7c3aed;text-transform:uppercase">Lokasi Anda</p><p style="margin:0;font-size:11px;font-weight:600;color:#0f172a">' + lat.toFixed(5) + ', ' + lng.toFixed(5) + '</p></div>').openPopup();
                userCircle = L.circle([lat, lng], { radius: acc, color: '#7c3aed', fillColor: '#7c3aed', fillOpacity: 0.07, weight: 1.5 }).addTo(map);

                if (emergencyPlaces.length > 0) {
                    const userLL = L.latLng(lat, lng);
                    let terdekat = null, jarakMin = Infinity;
                    emergencyPlaces.forEach(function (p) {
                        const d = map.distance(userLL, L.latLng(p.lat, p.lng));
                        if (d < jarakMin) { jarakMin = d; terdekat = p; }
                    });
                    if (terdekat) {
                        routingControl = L.Routing.control({
                            waypoints: [userLL, L.latLng(terdekat.lat, terdekat.lng)],
                            lineOptions: { styles: [{ color: '#7c3aed', opacity: 0.8, weight: 4 }] },
                            addWaypoints: false, draggableWaypoints: false, fitSelectedRoutes: true, show: false,
                            createMarker: function () { return null; }
                        }).addTo(map);
                        tampilkanStatus('sukses', 'Lokasi terdeteksi (+/-' + acc + 'm). Rute ke: ' + terdekat.name);
                    }
                } else {
                    map.setView([lat, lng], 15);
                    tampilkanStatus('sukses', 'Lokasi terdeteksi - akurasi +/-' + acc + ' meter');
                }
                btnLokasi.innerHTML = '<i class="fa-solid fa-circle-check text-xs"></i> Terdeteksi';
                btnLokasi.className = 'inline-flex items-center gap-1.5 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] font-bold text-emerald-600 transition cursor-pointer';
                btnLokasi.disabled  = false;
            },
            function (err) {
                let pesan = 'Tidak dapat mendeteksi lokasi.';
                if (err.code === err.PERMISSION_DENIED) pesan = 'Izin lokasi ditolak. Aktifkan di browser.';
                else if (err.code === err.TIMEOUT)      pesan = 'Waktu deteksi habis. Coba lagi.';
                tampilkanStatus('error', pesan);
                btnLokasi.innerHTML = '<i class="fa-solid fa-location-crosshairs text-xs"></i> Lokasi Saya';
                btnLokasi.disabled  = false;
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    });

    setTimeout(() => map.invalidateSize(), 400);

    // BMKG card
    fetch('/bmkg-terbaru', { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
        .then(r => r.json()).then(res => {
            const data = res.data;
            if (!data || !data.judul) return;
            const j = document.getElementById('bmkg-judul'), d = document.getElementById('bmkg-deskripsi'), s = document.getElementById('bmkg-status');
            if (j) j.innerText = data.judul;
            if (d) d.innerText = data.deskripsi + ' (' + data.waktu + ')';
            if (s) {
                s.innerText  = data.status_aman.toUpperCase();
                const aman   = data.status_aman.toLowerCase().includes('tidak berpotensi') || data.status_aman.toLowerCase().includes('aman');
                s.className  = aman ? 'text-[#16a34a] text-[10px] font-black uppercase' : 'text-red-500 text-[10px] font-black uppercase';
            }
        }).catch(() => {
            const j = document.getElementById('bmkg-judul'), d = document.getElementById('bmkg-deskripsi');
            if (j) j.innerText = 'Gagal Memuat';
            if (d) d.innerText = 'Tidak dapat terhubung ke server internal.';
        });

    // BMKG tabel gempa
    let bmkgList = [], currPage = 1;
    const perPage = 5;
    function renderTable() {
        const c = document.getElementById('bmkg-list-container');
        if (!c) return;
        c.innerHTML = '';
        bmkgList.slice((currPage - 1) * perPage, currPage * perPage).forEach(item => {
            const danger = item.Potensi.toLowerCase().includes('waspada') || (item.Potensi.toLowerCase().includes('potensi tsunami') && !item.Potensi.toLowerCase().includes('tidak'));
            c.innerHTML += '<tr class="hover:bg-slate-50 transition-colors"><td class="p-3 pl-4 font-bold text-[#64748b]">' + item.Jam.split(' ')[0] + ' WIB<br><span class="text-[9px]">' + item.Tanggal + '</span></td><td class="p-3 font-black text-[#172033]">SR ' + item.Magnitude + '</td><td class="p-3 text-[#64748b]">' + item.Kedalaman + '</td><td class="p-3 text-[#172033] max-w-[320px] truncate" title="' + item.Wilayah + '">' + item.Wilayah + '</td><td class="p-3 pr-4 text-right"><span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase ' + (danger ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50') + '">' + item.Potensi + '</span></td></tr>';
        });
        renderPagination();
    }
    function renderPagination() {
        const el = document.getElementById('pagination-controls');
        if (!el) return;
        const total = Math.ceil(bmkgList.length / perPage);
        if (total <= 1) { el.innerHTML = ''; return; }
        const s = (currPage - 1) * perPage + 1, e = Math.min(currPage * perPage, bmkgList.length);
        let html = '<div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"><p class="text-[11px] font-semibold text-slate-500 m-0">Menampilkan <span class="font-black text-slate-800">' + s + '</span> sampai <span class="font-black text-slate-800">' + e + '</span> dari <span class="font-black text-slate-800">' + bmkgList.length + '</span> kejadian</p><nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"><button onclick="gantiHalaman(' + (currPage-1) + ')" ' + (currPage===1?'disabled':'') + ' class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ' + (currPage===1?'opacity-50 cursor-not-allowed':'') + '"><i class="fa-solid fa-chevron-left text-xs"></i></button>';
        for (let i = 1; i <= total; i++) {
            html += '<button onclick="gantiHalaman(' + i + ')" class="relative inline-flex items-center px-3 py-1.5 text-xs font-black ' + (i===currPage?'z-10 bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-500':'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50') + '">' + i + '</button>';
        }
        html += '<button onclick="gantiHalaman(' + (currPage+1) + ')" ' + (currPage===total?'disabled':'') + ' class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ' + (currPage===total?'opacity-50 cursor-not-allowed':'') + '"><i class="fa-solid fa-chevron-right text-xs"></i></button></nav></div>';
        el.innerHTML = html;
    }
    window.gantiHalaman = function (page) {
        const total = Math.ceil(bmkgList.length / perPage);
        if (page >= 1 && page <= total) { currPage = page; renderTable(); }
    };
    fetch('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json')
        .then(r => r.json()).then(data => {
            if (data.Infogempa && data.Infogempa.gempa) { bmkgList = data.Infogempa.gempa; currPage = 1; renderTable(); }
        }).catch(() => {
            const c = document.getElementById('bmkg-list-container');
            if (c) c.innerHTML = '<tr><td colspan="5" class="p-4 text-center text-red-500 font-bold">Gagal terhubung ke server BMKG.</td></tr>';
        });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views/pages/user/home.blade.php ENDPATH**/ ?>