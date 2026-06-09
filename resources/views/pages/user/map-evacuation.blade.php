@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    .leaflet-routing-container { display: none !important; }
</style>
@endpush

@section('content')
<div class="flex h-screen bg-white overflow-hidden font-sans antialiased">

    {{-- ===== AREA PETA ===== --}}
    <div class="flex-1 relative bg-[#F1F5F9]">

        {{-- Overlay kontrol --}}
        <div class="absolute top-8 left-8 right-8 z-[500] flex flex-col gap-6 pointer-events-none">
            <div class="flex justify-between items-start w-full gap-4">

                {{-- Geofencing Radius --}}
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md px-6 py-4 rounded-xl shadow-md border border-white/50 flex flex-col gap-2 min-w-[240px]">
                    <label for="radiusSlider" class="text-xs font-bold text-slate-500 uppercase tracking-widest cursor-pointer">
                        Geofencing Radius
                    </label>
                    <div class="flex justify-between items-center gap-3">
                        <input type="range" id="radiusSlider" min="1" max="20" step="0.5" value="5"
                            class="w-full h-1.5 bg-slate-200 rounded-full appearance-none cursor-pointer accent-orange-500">
                        <span id="radiusLabel" class="text-sm font-black text-[#FF7F3E] whitespace-nowrap min-w-[55px] text-right">
                            5.0 KM
                        </span>
                    </div>
                </div>

                {{-- Tab Navigasi --}}
                <div class="pointer-events-auto flex p-1.5 bg-white/90 backdrop-blur-md rounded-xl shadow-md border border-white flex-wrap gap-1">
                    <a href="{{ route('user.map.laporan') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg transition-all text-xs font-bold tracking-wide uppercase
                        {{ $activeTab === 'laporan' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-triangle-exclamation text-sm"></i>
                        Laporan
                    </a>
                    <a href="{{ route('user.map.evakuasi') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg transition-all text-xs font-bold tracking-wide uppercase
                        {{ $activeTab === 'evakuasi' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-route text-sm"></i>
                        Jalur Evakuasi
                    </a>
                    <a href="{{ route('user.map.shelter') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg transition-all text-xs font-bold tracking-wide uppercase
                        {{ $activeTab === 'shelter' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-map-marker-alt text-sm"></i>
                        Shelter & Posko
                    </a>
                    <a href="{{ route('user.map.faskes') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg transition-all text-xs font-bold tracking-wide uppercase
                        {{ $activeTab === 'faskes' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-hospital text-sm"></i>
                        Faskes
                    </a>
                </div>

                {{-- Keterangan Pin --}}
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md p-5 rounded-xl shadow-md border border-white w-52">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 text-center">Keterangan Pin</h4>
                    <div class="space-y-3">
                        @foreach($legend as $item)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full shrink-0"
                                    style="background-color: {{ $item['color'] }}; box-shadow: 0 0 0 4px {{ $item['color'] }}20;"></div>
                                <span class="text-xs font-bold text-slate-700">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- Peta --}}
        <div id="map" class="w-full h-full bg-[#E2E8F0] relative z-0"></div>

        {{-- Tombol fokus lokasi --}}
        <button onclick="map.setView(window.currentCenterLatLng, 14)"
            class="absolute bottom-10 left-10 w-14 h-14 bg-[#FF7F3E] text-white rounded-2xl shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-[500]"
            title="Fokus ke lokasi saya">
            <i class="fas fa-location-crosshairs text-xl"></i>
        </button>
    </div>

    {{-- ===== SIDEBAR KANAN ===== --}}
    <aside class="w-[420px] bg-white border-l border-slate-200 flex flex-col z-[500] shadow-[-10px_0_30px_rgba(0,0,0,0.03)]">
        <div class="p-8 pb-5 border-b border-slate-100">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">{{ $pageTitle }}</h2>
                <span id="locationCount" class="text-xs font-bold text-slate-500 tracking-wider uppercase">0 Lokasi</span>
            </div>
        </div>
        <div id="sidebarList" class="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar">
            {{-- Diisi oleh JS --}}
        </div>
    </aside>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 20px; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    var defaultCenter = [-6.2000, 106.8166];

    var radiusSlider  = document.getElementById('radiusSlider');
    var radiusLabel   = document.getElementById('radiusLabel');
    var radiusMeters  = parseFloat(radiusSlider.value) * 1000;

    window.currentCenterLatLng = L.latLng(defaultCenter[0], defaultCenter[1]);
    window.isLocationDetected  = false;

    window.map = L.map('map', { zoomControl: false }).setView(defaultCenter, 13);
    L.control.zoom({ position: 'bottomright' }).addTo(map);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

    var geofenceCircle = L.circle(defaultCenter, {
        color: '#FF7F3E', fillColor: '#FF7F3E', fillOpacity: 0.08, radius: radiusMeters
    }).addTo(map);

    var rawData        = {!! json_encode($mapData ?? []) !!};
    var markersLayer   = L.featureGroup().addTo(map);
    var routingControl = null; // Rute user → lokasi tujuan
    var dbRouteLines   = [];   // Polyline jalur evakuasi dari DB

    // =============================================
    // HELPER: SVG PIN ICON
    // =============================================
    function buatPinIcon(warna) {
        return L.divIcon({
            className: 'bg-transparent border-0',
            html: `<div style="width:28px;height:38px;display:flex;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                    style="width:28px;height:38px;filter:drop-shadow(0 3px 4px rgba(0,0,0,0.25));">
                    <path fill="${warna}" stroke="#ffffff" stroke-width="18"
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                </svg>
            </div>`,
            iconSize: [28, 38], iconAnchor: [14, 38], popupAnchor: [0, -40]
        });
    }

    function buatDotIcon(warna) {
        return L.divIcon({
            className: 'bg-transparent border-0',
            html: `<div style="width:14px;height:14px;background:${warna};border:2px solid #fff;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.3);"></div>`,
            iconSize: [14, 14], iconAnchor: [7, 7]
        });
    }

    // =============================================
    // FUNGSI GLOBAL: HITUNG RUTE KE LOKASI
    // =============================================
    window.calculateRoute = function (event, targetLat, targetLng) {
        event.stopPropagation();
        if (!window.isLocationDetected) {
            alert('Lokasi Anda belum terdeteksi. Aktifkan GPS di browser Anda.');
            return;
        }
        if (routingControl) map.removeControl(routingControl);

        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(window.currentCenterLatLng.lat, window.currentCenterLatLng.lng),
                L.latLng(targetLat, targetLng)
            ],
            lineOptions:         { styles: [{ color: '#0096FF', opacity: 0.85, weight: 6 }] },
            addWaypoints:        false,
            draggableWaypoints:  false,
            fitSelectedRoutes:   true,
            show:                false,
            createMarker:        function () { return null; }
        }).addTo(map);
    };

    // =============================================
    // RENDER VIEW (MARKER + SIDEBAR)
    // =============================================
    function renderView(centerLatLng) {
        markersLayer.clearLayers();

        // Hapus polyline jalur evakuasi sebelumnya
        dbRouteLines.forEach(function (ctrl) { map.removeControl(ctrl); });
        dbRouteLines = [];

        const sidebar = document.getElementById('sidebarList');
        sidebar.innerHTML = '';
        let count = 0;

        if (!rawData.length) {
            tampilkanKosong(sidebar);
            document.getElementById('locationCount').innerText = '0 Lokasi';
            return;
        }

        // Hitung jarak & urutkan
        let processed = rawData.map(function (item) {
            let latlng = L.latLng(item.lat, item.lng);
            return { ...item, latlng: latlng, distance: map.distance(centerLatLng, latlng) };
        });
        processed.sort((a, b) => a.distance - b.distance);

        processed.forEach(function (item) {
            if (item.distance > radiusMeters) return;
            count++;

            var distanceText = (item.distance / 1000).toFixed(1) + ' KM';

            // ---- RENDER PETA ----
            if (item.is_route) {
                // Gambar jalur evakuasi mengikuti jalan raya (OSRM via Leaflet Routing)
                var routeCtrl = L.Routing.control({
                    waypoints: [
                        L.latLng(item.start_lat, item.start_lng),
                        L.latLng(item.end_lat, item.end_lng)
                    ],
                    lineOptions: {
                        styles: [{ color: item.color, opacity: 0.85, weight: 5 }]
                    },
                    addWaypoints:       false,
                    draggableWaypoints: false,
                    fitSelectedRoutes:  false,
                    show:               false,
                    createMarker: function (i, wp) {
                        var warna  = i === 0 ? '#10B981' : '#EF4444';
                        var teks   = i === 0 ? 'Titik Awal' : 'Titik Akhir';
                        return L.marker(wp.latLng, { icon: buatDotIcon(warna) })
                            .bindPopup(`<strong>${teks}:</strong> ${item.title}`);
                    }
                }).addTo(map);
                dbRouteLines.push(routeCtrl);

            } else {
                // Gambar pin biasa
                var marker = L.marker(item.latlng, { icon: buatPinIcon(item.color, item.type_slug, item.is_warning) });
                
                let popupContent = `<div class="p-1">
                    <strong style="color:${item.color}; font-size: 14px;">${item.title}</strong><br>
                    <span style="font-size: 12px; color: #64748b;">${item.subtitle}</span><br>
                    <hr style="margin: 8px 0; border: 0; border-top: 1px solid #e2e8f0;">
                    <p style="font-size: 11px; margin: 0;">${item.details}</p>
                </div>`;

                if (item.is_warning) {
                    popupContent = `<div class="p-2 border-2 border-red-500 rounded-lg bg-red-50">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-triangle-exclamation text-red-600"></i>
                            <strong class="text-red-700 text-sm uppercase">PERINGATAN BENCANA</strong>
                        </div>
                        <strong class="text-slate-800 text-base">${item.title}</strong><br>
                        <span class="text-slate-600 text-xs font-bold underline">${item.subtitle}</span>
                        <p class="text-slate-500 text-[10px] mt-2 leading-relaxed bg-white p-2 rounded border border-red-100">${item.details}</p>
                    </div>`;
                }

                marker.bindPopup(popupContent);
                markersLayer.addLayer(marker);
            }

            // ---- RENDER SIDEBAR CARD ----
            var navLat = item.is_route ? item.start_lat : item.lat;
            var navLng = item.is_route ? item.start_lng : item.lng;

            sidebar.innerHTML += `
                <div class="p-5 rounded-2xl border border-slate-200 bg-white hover:border-orange-200 hover:shadow-lg transition-all cursor-pointer"
                    onclick="map.setView([${item.lat}, ${item.lng}], 15)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1 min-w-0 pr-3">
                            <h3 class="text-sm font-black leading-tight truncate" style="color:${item.color}">${item.title}</h3>
                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-1 font-medium">
                                <i class="fas fa-map-marker-alt text-slate-400"></i>
                                ${distanceText} — ${item.subtitle}
                            </p>
                        </div>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide border shrink-0"
                            style="background:${item.badge_bg};color:${item.badge_color};border-color:${item.badge_color}30">
                            ${item.badge_text}
                        </span>
                    </div>
                    <p class="text-xs font-bold text-slate-400 mb-4">
                        <i class="fa-solid fa-circle-info mr-1"></i> ${item.details}
                    </p>
                    <button onclick="window.calculateRoute(event, ${navLat}, ${navLng})"
                        class="w-full py-2.5 text-xs font-bold text-white bg-[#FF7F3E] rounded-lg hover:bg-[#e66a2e] transition-all uppercase tracking-wide border-0 cursor-pointer">
                        Arahkan Rute
                    </button>
                </div>`;
        });

        document.getElementById('locationCount').innerText = count + ' Lokasi';
        if (count === 0) tampilkanKosong(sidebar);
    }

    function tampilkanKosong(sidebar) {
        sidebar.innerHTML = `
            <div class="flex flex-col items-center justify-center h-full text-slate-400 text-center mt-20">
                <i class="fa-solid fa-map-location-dot text-4xl mb-3 opacity-50"></i>
                <p class="text-sm font-bold">Tidak ada lokasi dalam radius ini</p>
                <p class="text-xs mt-1">Coba perbesar radius geofencing Anda.</p>
            </div>`;
    }

    // =============================================
    // RADIUS SLIDER
    // =============================================
    radiusSlider.addEventListener('input', function () {
        var km = parseFloat(this.value);
        radiusLabel.textContent = km.toFixed(1) + ' KM';
        radiusMeters = km * 1000;
        geofenceCircle.setRadius(radiusMeters);
        renderView(currentCenterLatLng);
    });

    // =============================================
    // DETEKSI GEOLOKASI USER
    // =============================================
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                window.isLocationDetected = true;
                currentCenterLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
                geofenceCircle.setLatLng(currentCenterLatLng);

                L.circleMarker(currentCenterLatLng, {
                    radius: 8, fillColor: '#3B82F6', color: '#ffffff', weight: 2, fillOpacity: 1
                }).addTo(map).bindPopup('<b>Posisi Anda Saat Ini</b>').openPopup();

                renderView(currentCenterLatLng);
                map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
            },
            function () {
                console.warn('Akses lokasi ditolak.');
                renderView(currentCenterLatLng);
            }
        );
    } else {
        renderView(currentCenterLatLng);
    }

});
</script>
@endpush: 1
                }).addTo(map).bindPopup('<b>Posisi Anda Saat Ini</b>').openPopup();

                renderView(currentCenterLatLng);
                map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
            },
            function () {
                console.warn('Akses lokasi ditolak.');
                renderView(currentCenterLatLng);
            }
        );
    } else {
        renderView(currentCenterLatLng);
    }

});
</script>
@endpush