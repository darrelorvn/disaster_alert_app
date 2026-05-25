@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #evacuationMap {
        height: 292px !important;
        width: 100% !important;
        background: #f8fafc;
    }
</style>
@endpush

@section('content')
<div class="p-6">

    {{-- ===== BANNER PERINGATAN ===== --}}
    <section class="min-h-[106px] bg-gradient-to-br from-[#fb923c] via-[#f97316] to-[#ff8a3d] rounded-[18px] text-white flex flex-col md:flex-row md:items-center justify-between gap-6 py-[22px] px-6 shadow-[0_18px_35px_rgba(249,115,22,0.24)]">
        <div class="max-w-[720px] w-full">
            <span class="inline-flex mb-[7px] py-1 px-2 rounded-full bg-white/20 text-[#fff7ed] text-[9px] font-black tracking-[0.08em]">WASPADA</span>
            <h2 class="m-0 mb-1.5 text-lg leading-[1.25] font-bold">Potensi Banjir Kiriman: Bendung Katulampa Siaga 2</h2>
            <p class="m-0 text-white/90 text-xs font-semibold">Debit air berpotensi meningkat dalam 4–6 jam ke depan. Gunakan jalur evakuasi yang tersedia.</p>
        </div>
        <div class="flex flex-row md:flex-col gap-[9px] min-w-[150px] w-full md:w-auto">
            <a href="{{ route('user.map') }}" class="flex-1 text-white no-underline text-center text-xs font-black py-[9px] px-3 border border-white/50 rounded-[9px] bg-white/10 hover:bg-white/20 transition-colors">Jalur Evakuasi</a>
            <a href="{{ route('user.safety') }}" class="flex-1 text-white no-underline text-center text-xs font-black py-[9px] px-3 border border-white/50 rounded-[9px] bg-white/10 hover:bg-white/20 transition-colors">Shelter Terdekat</a>
        </div>
    </section>

    {{-- ===== PETA & AKSI CEPAT ===== --}}
    <section class="mt-[22px] grid grid-cols-1 lg:grid-cols-[1fr_285px] gap-[22px] items-stretch">

        {{-- Peta Evakuasi --}}
        <article class="p-4 bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <div class="flex items-center justify-between gap-4 mb-3.5">
                <h3 class="m-0 text-[#172033] text-sm font-black">Peta Evakuasi</h3>

                {{-- Tombol deteksi lokasi --}}
                <button id="btn-deteksi-lokasi"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-orange-200 bg-orange-50 px-3 py-1.5 text-[11px] font-bold text-orange-600 transition hover:bg-orange-100">
                    <i class="fa-solid fa-location-crosshairs text-xs"></i>
                    Lokasi Saya
                </button>
            </div>

            {{-- Status lokasi --}}
            <div id="lokasi-status" class="hidden mb-3 flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2">
                <i id="lokasi-status-icon" class="fa-solid fa-circle-check text-emerald-500 text-xs shrink-0"></i>
                <p id="lokasi-status-text" class="text-[11px] font-bold text-emerald-700"></p>
            </div>

            <div id="evacuationMap" class="relative overflow-hidden rounded-[14px] z-0"></div>

            {{-- Legenda --}}
            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Legenda:</span>
                <div class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span>
                    <span class="text-[11px] font-semibold text-slate-500">Shelter</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-full bg-orange-500 shrink-0"></span>
                    <span class="text-[11px] font-semibold text-slate-500">Posko Darurat</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-full bg-blue-500 shrink-0"></span>
                    <span class="text-[11px] font-semibold text-slate-500">Fasilitas Kesehatan</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-full bg-violet-500 shrink-0"></span>
                    <span class="text-[11px] font-semibold text-slate-500">Lokasi Saya</span>
                </div>
            </div>
        </article>

        {{-- Aksi Cepat Tanggap --}}
        <aside class="p-[18px] bg-[#162238] text-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <h3 class="m-0 mb-3.5 text-white text-sm font-black">Aksi Cepat Tanggap</h3>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-kit-medical"></i>
                </span>
                <div>
                    <strong class="block text-xs font-black">Faskes Terdekat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">RSUD & Klinik 24 jam</small>
                </div>
            </a>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-building-columns"></i>
                </span>
                <div>
                    <strong class="block text-xs font-black">Shelter Terdekat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Titik kumpul & logistik</small>
                </div>
            </a>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#64748b] inline-flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-phone"></i>
                </span>
                <div>
                    <strong class="block text-xs font-black">Nomor Darurat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Ambulans, Damkar, Polisi</small>
                </div>
            </a>

            <a href="{{ route('user.tindakan-preventif.index') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 mt-3 w-full justify-center text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">
                <i class="fa-solid fa-clipboard-list"></i>
                Daftar Tindakan Preventif
            </a>
        </aside>

    </section>

    {{-- ===== KEJADIAN TERBARU ===== --}}
    <section class="mt-[22px] p-[18px] bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
        <div class="flex items-center justify-between gap-4">
            <h3 class="m-0 text-[#172033] text-sm font-black">Kejadian Terbaru Sekitarmu</h3>
            <a href="#" class="text-[#94a3b8] text-[11px] font-extrabold no-underline hover:text-orange-500 transition-colors">Lihat Semua →</a>
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

            {{-- Tabel BMKG --}}
            <div class="mt-6 w-full col-span-1 sm:col-span-2 lg:col-span-5">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h3 class="m-0 text-[#172033] text-sm font-black">Daftar Gempa Bumi Terkini (Live BMKG)</h3>
                    <span class="text-[#16a34a] text-[10px] font-black uppercase tracking-wider bg-green-50 px-2.5 py-1 rounded-full animate-pulse">● Terhubung Sistem</span>
                </div>
                <div class="bg-white border border-[#e6ebf2] rounded-[14px] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[#e8edf5] text-[#94a3b8] text-[11px] font-extrabold uppercase tracking-wider bg-slate-50">
                                    <th class="p-3 pl-4">Waktu</th>
                                    <th class="p-3">Kekuatan</th>
                                    <th class="p-3">Kedalaman</th>
                                    <th class="p-3">Wilayah Potensi</th>
                                    <th class="p-3 pr-4 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody id="bmkg-list-container" class="text-xs text-[#172033] font-semibold divide-y divide-[#e8edf5]">
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-[#94a3b8] font-bold">Mengunduh riwayat bencana dari server BMKG...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination-controls" class="flex items-center justify-between border-t border-[#e8edf5] bg-white px-4 py-3 sm:px-6"></div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // INISIALISASI PETA
    // =============================================
    const defaultLat = -6.2088;
    const defaultLng = 106.8456;

    const map = L.map('evacuationMap').setView([defaultLat, defaultLng], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // =============================================
    // HELPER: BUAT SVG PIN MARKER
    // =============================================
    function buatMarkerIcon(warna) {
        const svg = `
            <div style="position:relative;width:28px;height:38px;display:flex;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                    style="width:28px;height:38px;filter:drop-shadow(0 3px 4px rgba(0,0,0,0.25));">
                    <path fill="${warna}" stroke="#ffffff" stroke-width="18"
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                </svg>
            </div>`;
        return L.divIcon({
            className: 'bg-transparent border-0',
            html: svg,
            iconSize: [28, 38],
            iconAnchor: [14, 38],
            popupAnchor: [0, -40]
        });
    }

    // Warna marker per tipe
    const warnaMarker = {
        shelter:          '#10b981', // emerald
        emergency_post:   '#f97316', // orange
        health_post:      '#3b82f6', // blue
        health_facility:  '#3b82f6', // blue
        default:          '#64748b', // slate
    };

    // Label tipe dalam Bahasa Indonesia
    const labelTipe = {
        shelter:          'Shelter',
        emergency_post:   'Posko Darurat',
        health_post:      'Pos Kesehatan',
        health_facility:  'Fasilitas Kesehatan',
        default:          'Tempat Darurat',
    };

    // =============================================
    // RENDER MARKER EMERGENCY PLACES DARI BACKEND
    // =============================================
    const emergencyPlaces = {!! json_encode($emergencyPlaces ?? []) !!};
    const mapFeatures = [];

    if (emergencyPlaces.length > 0) {
        emergencyPlaces.forEach(function (place) {
            const warna = warnaMarker[place.type] ?? warnaMarker.default;
            const label = labelTipe[place.type]  ?? labelTipe.default;

            const marker = L.marker([place.lat, place.lng], { icon: buatMarkerIcon(warna) })
                .bindPopup(`
                    <div style="min-width:160px">
                        <p style="margin:0 0 4px;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em">${label}</p>
                        <p style="margin:0;font-size:13px;font-weight:700;color:#0f172a">${place.name}</p>
                    </div>
                `);

            marker.addTo(map);
            mapFeatures.push(marker);
        });

        // Fit bounds ke semua marker agar semua terlihat
        if (mapFeatures.length > 0) {
            const group = L.featureGroup(mapFeatures);
            map.fitBounds(group.getBounds(), { padding: [50, 50], maxZoom: 15 });
        }
    }

    // =============================================
    // DETEKSI LOKASI USER
    // =============================================
    let userMarker   = null;
    let userCircle   = null;

    const btnLokasi    = document.getElementById('btn-deteksi-lokasi');
    const statusEl     = document.getElementById('lokasi-status');
    const statusIcon   = document.getElementById('lokasi-status-icon');
    const statusText   = document.getElementById('lokasi-status-text');

    function tampilkanStatus(tipe, pesan) {
        statusEl.classList.remove('hidden');
        statusEl.classList.add('flex');

        if (tipe === 'sukses') {
            statusEl.className   = statusEl.className.replace(/border-\S+/g, '').replace(/bg-\S+/g, '').trim();
            statusEl.classList.add('border-emerald-200', 'bg-emerald-50');
            statusIcon.className = 'fa-solid fa-circle-check text-emerald-500 text-xs shrink-0';
            statusText.className = 'text-[11px] font-bold text-emerald-700';
        } else {
            statusEl.className   = statusEl.className.replace(/border-\S+/g, '').replace(/bg-\S+/g, '').trim();
            statusEl.classList.add('border-red-200', 'bg-red-50');
            statusIcon.className = 'fa-solid fa-circle-xmark text-red-500 text-xs shrink-0';
            statusText.className = 'text-[11px] font-bold text-red-700';
        }

        statusText.textContent = pesan;
    }

    btnLokasi.addEventListener('click', function () {
        btnLokasi.innerHTML  = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Mendeteksi...';
        btnLokasi.disabled   = true;

        if (!navigator.geolocation) {
            tampilkanStatus('error', 'Browser Anda tidak mendukung geolocation.');
            btnLokasi.innerHTML = '<i class="fa-solid fa-location-crosshairs text-xs"></i> Lokasi Saya';
            btnLokasi.disabled  = false;
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const acc = Math.round(position.coords.accuracy);

                // Hapus marker & lingkaran user sebelumnya jika ada
                if (userMarker) map.removeLayer(userMarker);
                if (userCircle) map.removeLayer(userCircle);

                // Marker lokasi user (warna violet)
                userMarker = L.marker([lat, lng], { icon: buatMarkerIcon('#7c3aed') })
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width:160px">
                            <p style="margin:0 0 4px;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em">Lokasi Anda</p>
                            <p style="margin:0;font-size:12px;font-weight:600;color:#0f172a">${lat.toFixed(5)}, ${lng.toFixed(5)}</p>
                            <p style="margin:4px 0 0;font-size:10px;color:#94a3b8">Akurasi: ±${acc} meter</p>
                        </div>
                    `)
                    .openPopup();

                // Lingkaran akurasi
                userCircle = L.circle([lat, lng], {
                    radius:      acc,
                    color:       '#7c3aed',
                    fillColor:   '#7c3aed',
                    fillOpacity: 0.08,
                    weight:      1.5,
                }).addTo(map);

                map.setView([lat, lng], 15);

                tampilkanStatus('sukses', `Lokasi terdeteksi — akurasi ±${acc} meter`);

                btnLokasi.innerHTML = '<i class="fa-solid fa-circle-check text-xs"></i> Terdeteksi';
                btnLokasi.classList.remove('border-orange-200', 'bg-orange-50', 'text-orange-600');
                btnLokasi.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-600');
                btnLokasi.disabled = false;
            },
            function (error) {
                let pesan = 'Tidak dapat mendeteksi lokasi.';
                if (error.code === error.PERMISSION_DENIED) {
                    pesan = 'Izin lokasi ditolak. Aktifkan akses lokasi di browser Anda.';
                } else if (error.code === error.TIMEOUT) {
                    pesan = 'Waktu deteksi habis. Coba lagi.';
                }

                tampilkanStatus('error', pesan);
                btnLokasi.innerHTML = '<i class="fa-solid fa-location-crosshairs text-xs"></i> Lokasi Saya';
                btnLokasi.disabled  = false;
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    });

    // Invalidate size setelah render
    setTimeout(() => map.invalidateSize(), 400);

    // =============================================
    // BMKG: DATA GEMPA TERBARU (CARD)
    // =============================================
    fetch('/bmkg-terbaru', {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(res => {
        const data = res.data;
        if (data && data.judul) {
            const judulEl   = document.getElementById('bmkg-judul');
            const deskEl    = document.getElementById('bmkg-deskripsi');
            const statusEl2 = document.getElementById('bmkg-status');

            if (judulEl) judulEl.innerText = data.judul;
            if (deskEl)  deskEl.innerText  = data.deskripsi + ' (' + data.waktu + ')';
            if (statusEl2) {
                statusEl2.innerText  = data.status_aman.toUpperCase();
                const aman = data.status_aman.toLowerCase().includes('tidak berpotensi') || data.status_aman.toLowerCase().includes('aman');
                statusEl2.className  = aman
                    ? 'text-[#16a34a] text-[10px] font-black uppercase'
                    : 'text-red-500 text-[10px] font-black uppercase';
            }
        }
    })
    .catch(() => {
        const judulEl = document.getElementById('bmkg-judul');
        const deskEl  = document.getElementById('bmkg-deskripsi');
        if (judulEl) judulEl.innerText = 'Gagal Memuat';
        if (deskEl)  deskEl.innerText  = 'Tidak dapat terhubung ke server internal.';
    });

    // =============================================
    // BMKG: TABEL RIWAYAT GEMPA (LIVE)
    // =============================================
    let bmkgDataList = [];
    let currentPage  = 1;
    const itemsPerPage = 5;

    function renderTable() {
        const container = document.getElementById('bmkg-list-container');
        if (!container) return;

        container.innerHTML = '';

        const start = (currentPage - 1) * itemsPerPage;
        const slice = bmkgDataList.slice(start, start + itemsPerPage);

        slice.forEach(item => {
            const isDanger    = item.Potensi.toLowerCase().includes('waspada') ||
                                (item.Potensi.toLowerCase().includes('potensi tsunami') && !item.Potensi.toLowerCase().includes('tidak'));
            const badgeClass  = isDanger ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50';

            container.innerHTML += `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-3 pl-4 font-bold text-[#64748b]">${item.Jam.split(' ')[0]} WIB<br><span class="text-[9px]">${item.Tanggal}</span></td>
                    <td class="p-3 font-black text-[#172033]">SR ${item.Magnitude}</td>
                    <td class="p-3 text-[#64748b]">${item.Kedalaman}</td>
                    <td class="p-3 text-[#172033] max-w-[320px] truncate" title="${item.Wilayah}">${item.Wilayah}</td>
                    <td class="p-3 pr-4 text-right">
                        <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase ${badgeClass}">${item.Potensi}</span>
                    </td>
                </tr>`;
        });

        renderPagination();
    }

    function renderPagination() {
        const el = document.getElementById('pagination-controls');
        if (!el) return;

        const total      = Math.ceil(bmkgDataList.length / itemsPerPage);
        if (total <= 1) { el.innerHTML = ''; return; }

        const startCount = (currentPage - 1) * itemsPerPage + 1;
        const endCount   = Math.min(currentPage * itemsPerPage, bmkgDataList.length);

        let html = `
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <p class="text-[11px] font-semibold text-slate-500 m-0">
                    Menampilkan <span class="font-black text-slate-800">${startCount}</span> sampai
                    <span class="font-black text-slate-800">${endCount}</span> dari
                    <span class="font-black text-slate-800">${bmkgDataList.length}</span> kejadian
                </p>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm">
                    <button onclick="gantiHalaman(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>`;

        for (let i = 1; i <= total; i++) {
            const cls = i === currentPage
                ? 'z-10 bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-500'
                : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50';
            html += `<button onclick="gantiHalaman(${i})" class="relative inline-flex items-center px-3 py-1.5 text-xs font-black ${cls}">${i}</button>`;
        }

        html += `
                    <button onclick="gantiHalaman(${currentPage + 1})" ${currentPage === total ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ${currentPage === total ? 'opacity-50 cursor-not-allowed' : ''}">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </nav>
            </div>
            <div class="flex flex-1 justify-between sm:hidden text-xs">
                <button onclick="gantiHalaman(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-black text-gray-700 hover:bg-gray-50 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}">Sebelumnya</button>
                <button onclick="gantiHalaman(${currentPage + 1})" ${currentPage === total ? 'disabled' : ''}
                    class="ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-black text-gray-700 hover:bg-gray-50 ${currentPage === total ? 'opacity-50 cursor-not-allowed' : ''}">Selanjutnya</button>
            </div>`;

        el.innerHTML = html;
    }

    window.gantiHalaman = function (page) {
        const total = Math.ceil(bmkgDataList.length / itemsPerPage);
        if (page >= 1 && page <= total) {
            currentPage = page;
            renderTable();
        }
    };

    fetch('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json')
        .then(r => r.json())
        .then(data => {
            if (data.Infogempa && data.Infogempa.gempa) {
                bmkgDataList = data.Infogempa.gempa;
                currentPage  = 1;
                renderTable();
            }
        })
        .catch(() => {
            const container = document.getElementById('bmkg-list-container');
            if (container) {
                container.innerHTML = `
                    <tr>
                        <td colspan="5" class="p-4 text-center text-red-500 font-bold">
                            Gagal terhubung ke server BMKG. Coba muat ulang halaman.
                        </td>
                    </tr>`;
            }
        });

}); // end DOMContentLoaded
</script>
@endpush