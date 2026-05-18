@extends('layouts.app')

@push('styles')
<!-- Library CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')
<div class="flex h-screen bg-white overflow-hidden font-sans antialiased">
    
    <div class="flex-1 relative bg-[#F1F5F9]">
        
        <div class="absolute top-8 left-8 right-8 z-[500] flex flex-col gap-6 pointer-events-none">
            
            <div class="flex justify-between items-start w-full">
                <!-- Info Radius (Interaktif) -->
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md px-6 py-4 rounded-xl shadow-md border border-white/50 flex flex-col gap-2 min-w-[260px]">
                    <label for="radiusSlider" class="text-xs font-bold text-slate-500 uppercase tracking-widest cursor-pointer">
                        Geofencing Radius
                    </label>
                    <div class="flex justify-between items-center gap-3">
                        <!-- Input range dari 1 KM sampai 20 KM dengan step 0.5 -->
                        <input type="range" id="radiusSlider" min="1" max="20" step="0.5" value="5" 
                            class="w-full h-1.5 bg-slate-200 rounded-full appearance-none cursor-pointer accent-orange-500 hover:accent-orange-600 focus:outline-none">
                        
                        <!-- Label Angka KM -->
                        <span id="radiusLabel" class="text-sm font-black text-[#FF7F3E] whitespace-nowrap min-w-[55px] text-right">
                            5.0 KM
                        </span>
                    </div>
                </div>

                <!-- Navigasi Tengah -->
                <div class="pointer-events-auto flex p-1.5 bg-white/90 backdrop-blur-md rounded-xl shadow-md border border-white">
                    <button class="flex items-center gap-3 px-6 py-3 bg-[#FF7F3E] text-white rounded-lg shadow-md shadow-orange-200/50 transition-all">
                        <i class="fas fa-route text-sm"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Jalur Evakuasi</span>
                    </button>
                    <button class="flex items-center gap-3 px-6 py-3 text-slate-600 hover:bg-slate-50 hover:text-orange-500 rounded-lg transition-all group">
                        <i class="fas fa-map-marker-alt text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Shelter & Posko</span>
                    </button>
                    <button class="flex items-center gap-3 px-6 py-3 text-slate-600 hover:bg-slate-50 hover:text-orange-500 rounded-lg transition-all group">
                        <i class="fas fa-hospital text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-bold tracking-wide uppercase">Fasilitas Kesehatan</span>
                    </button>
                </div>

                <!-- Kategori Bencana -->
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md p-6 rounded-xl shadow-md border border-white w-56">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 text-center">Kategori Bencana</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#FF4D4D] ring-4 ring-red-100"></div>
                            <span class="text-sm font-bold text-slate-700 tracking-tight">Banjir & Arus</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#F59E0B] ring-4 ring-orange-100"></div>
                            <span class="text-sm font-bold text-slate-700 tracking-tight">Zona Kebakaran</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#3B82F6] ring-4 ring-blue-100"></div>
                            <span class="text-sm font-bold text-slate-700 tracking-tight">Area Tsunami</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Container Peta Leaflet --}}
        <div id="map" class="w-full h-full bg-[#E2E8F0] relative z-0"></div>

        <button class="absolute bottom-10 left-10 w-14 h-14 bg-[#FF7F3E] text-white rounded-2xl shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-[500]">
            <i class="fas fa-paper-plane text-xl transform -rotate-45 -translate-y-0.5"></i>
        </button>
    </div>

    {{-- Sidebar Kanan --}}
    <aside class="w-[450px] bg-white border-l border-slate-200 flex flex-col z-[500] shadow-[-10px_0_30px_rgba(0,0,0,0.03)] relative">
        <div class="p-8 pb-6 border-b border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Daftar Shelter</h2>
                <span class="text-xs font-bold text-slate-500 tracking-wider uppercase">8 Lokasi</span>
            </div>
            
            <div class="flex gap-2">
                <button class="px-5 py-2 bg-[#FFF4EE] text-[#FF7F3E] text-xs font-bold rounded-lg uppercase tracking-wide border border-orange-100">Semua</button>
                <button class="px-5 py-2 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 uppercase tracking-wide transition border border-slate-100">Tersedia</button>
                <button class="px-5 py-2 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 uppercase tracking-wide transition border border-slate-100">Hampir Penuh</button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar">
            
            <!-- Card Shelter 1 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:border-orange-200 hover:shadow-lg transition-all group relative overflow-hidden">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 group-hover:text-[#FF7F3E] transition-colors leading-tight">SDN 01 Menteng</h3>
                        <p class="text-xs text-slate-600 flex items-center gap-2 mt-1.5 font-medium">
                            <i class="fas fa-map-marker-alt text-slate-400"></i> 
                            0.8 KM - Menteng, Jakpus
                        </p>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 rounded-md bg-[#ECFDF5] text-[#10B981] uppercase tracking-wide border border-green-100">Siaga</span>
                </div>

                <div class="flex items-center gap-3 mb-6 mt-5">
                    <div class="flex -space-x-3">
                        <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-slate-300 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-slate-400 border-2 border-white"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">120 Terdaftar</span>
                </div>

                <div class="flex gap-3">
                    <button class="flex-1 py-3 text-xs font-bold text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-all uppercase tracking-wide border border-slate-200">Kontak</button>
                    <button class="flex-[1.6] py-3 text-xs font-bold text-white bg-[#FF7F3E] rounded-lg shadow-md shadow-orange-200 hover:bg-[#e66a2e] transition-all uppercase tracking-wide">Lihat di Peta</button>
                </div>
            </div>

            <!-- Card Shelter 2 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:border-orange-200 hover:shadow-lg transition-all relative overflow-hidden">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 leading-tight">Masjid Istiqlal</h3>
                        <p class="text-xs text-slate-600 flex items-center gap-2 mt-1.5 font-medium">
                            <i class="fas fa-map-marker-alt text-slate-400"></i> 2.4 KM - Gambir, Jakpus
                        </p>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 rounded-md bg-[#FEF2F2] text-[#EF4444] uppercase tracking-wide border border-red-100">Penuh</span>
                </div>
                <div class="mt-6 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kapasitas</span>
                        <span class="text-xs font-bold text-[#EF4444]">100%</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                        <div class="w-full h-full bg-[#FF7F3E] rounded-full"></div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="flex-1 py-3 text-xs font-bold text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-all uppercase tracking-wide border border-slate-200">Kontak</button>
                    <button class="flex-[1.6] py-3 text-xs font-bold text-white bg-[#FF7F3E] rounded-lg shadow-md shadow-orange-200 hover:bg-[#e66a2e] transition-all uppercase tracking-wide">Lihat di Peta</button>
                </div>
            </div>

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
<!-- Library JS Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Inisialisasi Peta & Variabel Global
    var defaultCenter = [-6.2000, 106.8166];
    
    // Ambil elemen slider dan atur radius awal dari slider
    var radiusSlider = document.getElementById('radiusSlider');
    var radiusLabel = document.getElementById('radiusLabel');
    var radiusMeters = parseFloat(radiusSlider.value) * 1000; 
    
    // Variabel untuk menyimpan titik pusat pengguna saat ini
    var currentCenterLatLng = L.latLng(defaultCenter[0], defaultCenter[1]);

    var map = L.map('map', { zoomControl: false }).setView(defaultCenter, 13);
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // 2. Buat Lingkaran Geofencing (Radar)
    var geofenceCircle = L.circle(defaultCenter, {
        color: '#FF7F3E',        
        fillColor: '#FF7F3E',    
        fillOpacity: 0.1,        
        radius: radiusMeters            
    }).addTo(map);

    var incidentData = {!! json_encode($mapData ?? []) !!};
    var markersLayer = L.featureGroup().addTo(map);

    // 3. Fungsi Render Marker (Hanya yang di dalam Radius)
    function renderMarkersInRadius(centerLatLng) {
        markersLayer.clearLayers(); 

        if (incidentData.length > 0) {
            incidentData.forEach(function(incident) {
                if (incident.lat && incident.lng) {
                    var incidentLatLng = L.latLng(incident.lat, incident.lng);
                    var distance = map.distance(centerLatLng, incidentLatLng);

                    // Cek radius
                    if (distance <= radiusMeters) {
                        var pinSVG = `
                            <div style="position: relative; width: 32px; height: 42px; display: flex; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 32px; height: 42px; filter: drop-shadow(0px 5px 4px rgba(0,0,0,0.3));">
                                    <path fill="${incident.status}" stroke="#ffffff" stroke-width="20" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                                </svg>
                            </div>
                        `;

                        var customIcon = L.divIcon({
                            className: 'bg-transparent border-0',
                            html: pinSVG,
                            iconSize: [32, 42],
                            iconAnchor: [16, 42], 
                            popupAnchor: [0, -42] 
                        });

                        var marker = L.marker(incidentLatLng, {icon: customIcon})
                            .bindPopup(
                                '<strong style="color:' + incident.status + '">' + incident.title + '</strong><br>' + 
                                (incident.desc || 'Titik Laporan') + 
                                '<br><small class="text-slate-500 font-bold">Jarak: ' + (distance/1000).toFixed(1) + ' KM</small>'
                            );
                        
                        markersLayer.addLayer(marker);
                    }
                }
            });
        }
    }

    // 4. EVENT LISTENER: Slider Radius Berubah
    radiusSlider.addEventListener('input', function() {
        var kmValue = parseFloat(this.value);
        radiusLabel.textContent = kmValue.toFixed(1) + ' KM'; // Update text UI
        
        radiusMeters = kmValue * 1000; // Update variabel radius
        geofenceCircle.setRadius(radiusMeters); // Ubah besar lingkaran di peta
        
        // Render ulang marker dan zoom animasi perlahan
        renderMarkersInRadius(currentCenterLatLng);
        map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] }); 
    });

    // 5. Deteksi Lokasi User (Geolocation)
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                currentCenterLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

                geofenceCircle.setLatLng(currentCenterLatLng);

                L.circleMarker(currentCenterLatLng, {
                    radius: 7,
                    fillColor: "#3B82F6", 
                    color: "#ffffff",
                    weight: 2,
                    fillOpacity: 1
                }).addTo(map).bindPopup("<b>Posisi Anda</b>").openPopup();

                renderMarkersInRadius(currentCenterLatLng);
                map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
            },
            function(error) {
                console.warn("Akses lokasi ditolak. Menggunakan lokasi default.");
                renderMarkersInRadius(currentCenterLatLng);
                map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
            }
        );
    } else {
        renderMarkersInRadius(currentCenterLatLng);
        map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] });
    }

    setTimeout(function () { map.invalidateSize(); }, 400);
});
</script>
@endpush