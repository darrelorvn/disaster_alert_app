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
                <div class="pointer-events-auto bg-white/95 backdrop-blur-md px-7 py-4 rounded-[24px] shadow-[0_12px_40px_rgba(0,0,0,0.04)] border border-white/50 flex flex-col gap-1 min-w-[240px]">
                    <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em]">Geofencing Radius</span>
                    <div class="flex justify-between items-center">
                         <div class="h-1 w-24 bg-slate-100 rounded-full overflow-hidden">
                            <div class="bg-orange-500 h-full w-[52%]"></div>
                         </div>
                        <span class="text-[13px] font-black text-[#FF7F3E]">5.2 KM</span>
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

    {{-- Sidebar Kanan - Z-index ditingkatkan --}}
    <aside class="w-[450px] bg-white border-l border-slate-100 flex flex-col z-[500] shadow-[-25px_0_60px_rgba(0,0,0,0.02)] relative">
        <div class="p-9 pb-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-[24px] font-black text-slate-800 tracking-tighter">Daftar Shelter</h2>
                <span class="text-[9px] font-black text-slate-300 tracking-[0.2em] uppercase">8 Lokasi</span>
            </div>
            
            <div class="flex gap-2">
                <button class="px-5 py-2 bg-[#FFF4EE] text-[#FF7F3E] text-xs font-bold rounded-lg uppercase tracking-wide border border-orange-100">Semua</button>
                <button class="px-5 py-2 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 uppercase tracking-wide transition border border-slate-100">Tersedia</button>
                <button class="px-5 py-2 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 uppercase tracking-wide transition border border-slate-100">Hampir Penuh</button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-9 pt-2 space-y-7 custom-scrollbar">
            
            <div class="p-7 rounded-[36px] border border-slate-50 bg-white hover:shadow-[0_30px_70px_rgba(0,0,0,0.07)] transition-all duration-500 group relative overflow-hidden">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-[17px] font-black text-slate-800 group-hover:text-[#FF7F3E] transition-colors leading-tight">SDN 01 Menteng</h3>
                        <p class="text-[11px] text-slate-400 flex items-center gap-2 mt-2 font-medium italic">
                            <i class="fas fa-map-marker-alt text-slate-200"></i> 
                            0.8 KM - Menteng, Jakpus
                        </p>
                    </div>
                    <span class="text-[9px] font-black px-4 py-2 rounded-full bg-[#ECFDF5] text-[#10B981] uppercase tracking-[0.15em]">Siaga</span>
                </div>

                <div class="flex items-center gap-4 mb-9 mt-7">
                    <div class="flex -space-x-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 border-[3px] border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-slate-200 border-[3px] border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-slate-300 border-[3px] border-white"></div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-wider">120 Terdaftar</span>
                </div>

                <div class="flex gap-4">
                    <button class="flex-1 py-4 text-[10px] font-black text-slate-400 bg-slate-50 rounded-[20px] hover:bg-slate-100 transition-all uppercase tracking-[0.1em]">Kontak</button>
                    <button class="flex-[1.6] py-4 text-[10px] font-black text-white bg-[#FF7F3E] rounded-[20px] shadow-2xl shadow-orange-200/50 hover:bg-[#e66a2e] transition-all uppercase tracking-[0.1em]">Lihat di Peta</button>
                </div>
            </div>

            <div class="p-7 rounded-[36px] border border-slate-50 bg-white shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-[17px] font-black text-slate-800 leading-tight">Masjid Istiqlal</h3>
                        <p class="text-[11px] text-slate-400 flex items-center gap-2 mt-2 font-medium italic">
                            <i class="fas fa-map-marker-alt text-slate-200"></i> 2.4 KM - Gambir, Jakpus
                        </p>
                    </div>
                    <span class="text-[9px] font-black px-4 py-2 rounded-full bg-[#FEF2F2] text-[#EF4444] uppercase tracking-[0.15em]">Penuh</span>
                </div>
                <div class="mt-9 mb-9">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Kapasitas</span>
                        <span class="text-[11px] font-black text-[#EF4444]">100%</span>
                    </div>
                    <div class="w-full h-3 bg-slate-50 rounded-full overflow-hidden p-0.5 border border-slate-100">
                        <div class="w-full h-full bg-[#FF7F3E] rounded-full shadow-[0_0_15px_rgba(255,127,62,0.5)]"></div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button class="flex-1 py-4 text-[10px] font-black text-slate-400 bg-slate-50 rounded-[20px] uppercase tracking-[0.1em]">Kontak</button>
                    <button class="flex-[1.6] py-4 text-[10px] font-black text-white bg-[#FF7F3E] rounded-[20px] shadow-2xl shadow-orange-200/50 uppercase tracking-[0.1em]">Lihat di Peta</button>
                </div>
            </div>
            @endforelse

        </div>
    </aside>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #F1F5F9; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #E2E8F0; }
    /* Animasi pulse telah dihapus karena sudah digantikan oleh peta asli */
</style>
@endsection

@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', function () {
    
    var defaultCenter = [-6.2000, 106.8166];
    
    var radiusSlider = document.getElementById('radiusSlider');
    var radiusLabel = document.getElementById('radiusLabel');
    var radiusMeters = parseFloat(radiusSlider.value) * 1000; 
    
    var currentCenterLatLng = L.latLng(defaultCenter[0], defaultCenter[1]);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var geofenceCircle = L.circle(defaultCenter, {
        color: '#FF7F3E',        
        fillColor: '#FF7F3E',    
        fillOpacity: 0.1,        
        radius: radiusMeters            
    }).addTo(map);

    var incidentData = {!! json_encode($mapData ?? []) !!};
    var markersLayer = L.featureGroup().addTo(map);

    function renderMarkersInRadius(centerLatLng) {
        markersLayer.clearLayers(); 

        if (incidentData.length > 0) {
            incidentData.forEach(function(incident) {
                if (incident.lat && incident.lng) {
                    var incidentLatLng = L.latLng(incident.lat, incident.lng);
                    var distance = map.distance(centerLatLng, incidentLatLng);

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

    radiusSlider.addEventListener('input', function() {
        var kmValue = parseFloat(this.value);
        radiusLabel.textContent = kmValue.toFixed(1) + ' KM';
        radiusMeters = kmValue * 1000;
        geofenceCircle.setRadius(radiusMeters);
        
        renderMarkersInRadius(currentCenterLatLng);
        map.fitBounds(geofenceCircle.getBounds(), { padding: [30, 30] }); 
    });

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

    var markerIstiqlal = L.marker([-6.1702, 106.8310]).addTo(map)
        .bindPopup('<b>Masjid Istiqlal</b><br>Status: <span style="color:red;">Penuh</span><br>Kapasitas: 100%');

    var group = new L.featureGroup([markerMenteng, markerIstiqlal, geofenceRadius]);
    map.fitBounds(group.getBounds(), { padding: [50, 50] });
});
</script>
@endpush