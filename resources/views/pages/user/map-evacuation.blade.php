@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    /* Menyembunyikan teks petunjuk arah turn-by-turn agar UI peta tetap bersih */
    .leaflet-routing-container {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="flex h-screen bg-white overflow-hidden font-sans antialiased">
    
    <div class="flex-1 relative bg-[#F1F5F9]">
        
        <div class="absolute top-8 left-8 right-8 z-[500] flex flex-col gap-6 pointer-events-none">
            
            <div class="flex justify-between items-start w-full">
                {{-- Geofencing Slider --}}
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md px-6 py-4 rounded-xl shadow-md border border-white/50 flex flex-col gap-2 min-w-[260px]">
                    <label for="radiusSlider" class="text-xs font-bold text-slate-500 uppercase tracking-widest cursor-pointer">
                        Geofencing Radius
                    </label>
                    <div class="flex justify-between items-center gap-3">
                        <input type="range" id="radiusSlider" min="1" max="20" step="0.5" value="5" 
                            class="w-full h-1.5 bg-slate-200 rounded-full appearance-none cursor-pointer accent-orange-500 hover:accent-orange-600 focus:outline-none">
                        
                        <span id="radiusLabel" class="text-sm font-black text-[#FF7F3E] whitespace-nowrap min-w-[55px] text-right">
                            5.0 KM
                        </span>
                    </div>
                </div>

                {{-- Tab Navigasi Dinamis --}}
                <div class="pointer-events-auto flex p-1.5 bg-white/90 backdrop-blur-md rounded-xl shadow-md border border-white">
                    <a href="{{ route('user.map.laporan') }}" class="flex items-center gap-3 px-6 py-3 rounded-lg transition-all {{ $activeTab === 'laporan' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-route text-sm"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Jalur Evakuasi</span>
                    </a>
                    <a href="{{ route('user.map.shelter') }}" class="flex items-center gap-3 px-6 py-3 rounded-lg transition-all {{ $activeTab === 'shelter' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-map-marker-alt text-sm"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Shelter & Posko</span>
                    </a>
                    <a href="{{ route('user.map.faskes') }}" class="flex items-center gap-3 px-6 py-3 rounded-lg transition-all {{ $activeTab === 'faskes' ? 'bg-[#FF7F3E] text-white shadow-md shadow-orange-200/50' : 'text-slate-600 hover:bg-slate-50 hover:text-orange-500' }}">
                        <i class="fas fa-hospital text-sm"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Fasilitas Kesehatan</span>
                    </a>
                </div>

                {{-- Keterangan Pin Dinamis --}}
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md p-6 rounded-xl shadow-md border border-white w-56">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 text-center">Keterangan Pin</h4>
                    <div class="space-y-4">
                        @foreach($legend as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}; box-shadow: 0 0 0 4px {{ $item['color'] }}20;"></div>
                            <span class="text-sm font-bold text-slate-700 tracking-tight">{{ $item['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="map" class="w-full h-full bg-[#E2E8F0] relative z-0"></div>

        <button onclick="map.setView(window.currentCenterLatLng, 14)" class="absolute bottom-10 left-10 w-14 h-14 bg-[#FF7F3E] text-white rounded-2xl shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-[500]" title="Fokus ke lokasi saya">
            <i class="fas fa-location-crosshairs text-xl"></i>
        </button>
    </div>

    {{-- Sidebar Kanan --}}
    <aside class="w-[450px] bg-white border-l border-slate-200 flex flex-col z-[500] shadow-[-10px_0_30px_rgba(0,0,0,0.03)] relative">
        <div class="p-8 pb-6 border-b border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">{{ $pageTitle }}</h2>
                <span id="locationCount" class="text-xs font-bold text-slate-500 tracking-wider uppercase">0 Lokasi</span>
            </div>
        </div>

        <div id="sidebarList" class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar">
            {{-- Konten diinjeksi oleh JS --}}
        </div>
    </aside>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var defaultCenter = [-6.2000, 106.8166];
    
    var radiusSlider = document.getElementById('radiusSlider');
    var radiusLabel = document.getElementById('radiusLabel');
    var radiusMeters = parseFloat(radiusSlider.value) * 1000; 
    
    window.currentCenterLatLng = L.latLng(defaultCenter[0], defaultCenter[1]);
    window.isLocationDetected = false; // Flag status geolokasi user
    window.map = L.map('map', { zoomControl: false }).setView(defaultCenter, 13);
    
    L.control.zoom({ position: 'bottomright' }).addTo(map);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

    var geofenceCircle = L.circle(defaultCenter, {
        color: '#FF7F3E', fillColor: '#FF7F3E', fillOpacity: 0.1, radius: radiusMeters            
    }).addTo(map);

    var rawData = {!! json_encode($mapData ?? []) !!};
    var markersLayer = L.featureGroup().addTo(map);
    var routingControl = null; // Menyimpan instance rute aktif peta

    // Fungsi global kalkulasi rute dari titik user ke fasilitas terkait
    window.calculateRoute = function(event, targetLat, targetLng) {
        event.stopPropagation(); // Mencegah trigger fungsi 'onclick' milik parent card container

        if (!window.isLocationDetected) {
            alert("Lokasi Anda belum berhasil terdeteksi. Pastikan izin GPS aktif pada browser Anda.");
            return;
        }

        // Reset rute lama jika sebelumnya sudah ada rute aktif di peta
        if (routingControl) {
            map.removeControl(routingControl);
        }

        // Membuat visualisasi jalur rute jalan raya
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(window.currentCenterLatLng.lat, window.currentCenterLatLng.lng),
                L.latLng(targetLat, targetLng)
            ],
            lineOptions: {
                styles: [{ color: '#0096FF', opacity: 0.85, weight: 6 }] // Style alur rute tebal oranye
            },
            addWaypoints: false,
            draggableWaypoints: false,
            fitSelectedRoutes: true, // Otomatis menyesuaikan kamera peta agar jalur terlihat utuh
            show: false,
            createMarker: function() { return null; } // Agar tidak menduplikasi/menimpa penanda marker kustom
        }).addTo(map);
    };

    function renderView(centerLatLng) {
        markersLayer.clearLayers(); 
        const sidebarList = document.getElementById('sidebarList');
        sidebarList.innerHTML = '';
        let count = 0;

        if (rawData.length > 0) {
            let processedData = rawData.map(item => {
                let latlng = L.latLng(item.lat, item.lng);
                return { ...item, latlng: latlng, distance: map.distance(centerLatLng, latlng) };
            });

            processedData.sort((a, b) => a.distance - b.distance);

            processedData.forEach(function(item) {
                if (item.distance <= radiusMeters) {
                    count++;

                    // 1. Render Marker di Peta
                    var pinSVG = `
                        <div style="position: relative; width: 32px; height: 42px; display: flex; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 32px; height: 42px; filter: drop-shadow(0px 5px 4px rgba(0,0,0,0.3));">
                                <path fill="${item.color}" stroke="#ffffff" stroke-width="20" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                            </svg>
                        </div>
                    `;

                    var customIcon = L.divIcon({ className: 'bg-transparent border-0', html: pinSVG, iconSize: [32, 42], iconAnchor: [16, 42], popupAnchor: [0, -42] });
                    var marker = L.marker(item.latlng, {icon: customIcon}).bindPopup('<strong style="color:' + item.color + '">' + item.title + '</strong><br>' + item.subtitle);
                    markersLayer.addLayer(marker);

                    // 2. Render Card item di Sidebar Kanan
                    var distanceText = (item.distance / 1000).toFixed(1) + ' KM';
                    sidebarList.innerHTML += `
                        <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:border-orange-200 hover:shadow-lg transition-all group relative overflow-hidden cursor-pointer" onclick="map.setView([${item.lat}, ${item.lng}], 16)">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 transition-colors leading-tight" style="color: ${item.color}">${item.title}</h3>
                                    <p class="text-xs text-slate-600 flex items-center gap-2 mt-1.5 font-medium">
                                        <i class="fas fa-map-marker-alt text-slate-400"></i> ${distanceText} - ${item.subtitle}
                                    </p>
                                </div>
                                <span class="text-xs font-bold px-3 py-1 rounded-md uppercase tracking-wide border" style="background-color: ${item.badge_bg}; color: ${item.badge_color}; border-color: ${item.badge_color}30;">
                                    ${item.badge_text}
                                </span>
                            </div>
                            <div class="flex items-center gap-3 mb-6 mt-5">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide"><i class="fa-solid fa-circle-info mr-1"></i> ${item.details}</span>
                            </div>
                            <div class="flex gap-3">
                                <button onclick="window.calculateRoute(event, ${item.lat}, ${item.lng})" class="flex-1 py-3 text-xs font-bold text-white bg-[#FF7F3E] rounded-lg shadow-md shadow-orange-100 hover:bg-[#e66a2e] transition-all uppercase tracking-wide border-0 cursor-pointer">Arahkan Rute</button>
                            </div>
                        </div>
                    `;
                }
            });
        }
        
        document.getElementById('locationCount').innerText = count + ' Lokasi';
        if (count === 0) {
            sidebarList.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full text-slate-400 text-center mt-20">
                    <i class="fa-solid fa-map-location-dot text-4xl mb-3 opacity-50"></i>
                    <p class="text-sm font-bold">Tidak ada lokasi dalam radius ini</p>
                    <p class="text-xs mt-1">Coba perbesar radius geofencing Anda.</p>
                </div>
            `;
        }
    }

    radiusSlider.addEventListener('input', function() {
        var kmValue = parseFloat(this.value);
        radiusLabel.textContent = kmValue.toFixed(1) + ' KM';
        radiusMeters = kmValue * 1000;
        geofenceCircle.setRadius(radiusMeters);
        
        renderView(currentCenterLatLng);
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                window.isLocationDetected = true;
                currentCenterLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
                geofenceCircle.setLatLng(currentCenterLatLng);

                L.circleMarker(currentCenterLatLng, {
                    radius: 7, fillColor: "#3B82F6", color: "#ffffff", weight: 2, fillOpacity: 1
                }).addTo(map).bindPopup("<b>Posisi Anda Saat Ini</b>").openPopup();

                renderView(currentCenterLatLng);
                map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
            },
            function(error) {
                console.warn("Akses lokasi ditolak browser.");
                renderView(currentCenterLatLng);
            }
        );
    } else {
        renderView(currentCenterLatLng);
    }

    setTimeout(function () { map.invalidateSize(); }, 400);
});
</script>
@endpush