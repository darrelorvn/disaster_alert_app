@extends('layouts.app')

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

                <div class="pointer-events-auto flex p-1.5 bg-white/90 backdrop-blur-md rounded-[26px] shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-white">
                    <button class="flex items-center gap-3 px-9 py-4 bg-[#FF7F3E] text-white rounded-[22px] shadow-xl shadow-orange-200/50 transition-all">
                        <i class="fas fa-route text-xs"></i>
                        <span class="text-[10px] font-black tracking-[0.05em] uppercase">Jalur Evakuasi</span>
                    </button>
                    <button class="flex items-center gap-3 px-9 py-4 text-slate-400 hover:text-slate-600 transition-all group">
                        <i class="fas fa-map-marker-alt text-xs group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black tracking-[0.05em] uppercase">Shelter & Posko</span>
                    </button>
                    <button class="flex items-center gap-3 px-9 py-4 text-slate-400 hover:text-slate-600 transition-all group">
                        <i class="fas fa-hospital text-xs group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black tracking-[0.05em] uppercase">Fasilitas Kesehatan</span>
                    </button>
                </div>

                <div class="pointer-events-auto bg-white/95 backdrop-blur-md p-7 rounded-[28px] shadow-[0_15px_45px_rgba(0,0,0,0.05)] border border-white w-56">
                    <h4 class="text-[8px] font-black text-slate-300 uppercase tracking-[0.3em] mb-6 text-center">Kategori Bencana</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#FF4D4D] ring-[5px] ring-red-50/50"></div>
                            <span class="text-[11px] font-bold text-slate-600 tracking-tight">Banjir & Arus</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#F59E0B] ring-[5px] ring-orange-50/50"></div>
                            <span class="text-[11px] font-bold text-slate-600 tracking-tight">Zona Kebakaran</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-3 h-3 rounded-full bg-[#3B82F6] ring-[5px] ring-blue-50/50"></div>
                            <span class="text-[11px] font-bold text-slate-600 tracking-tight">Area Tsunami</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Container Peta Leaflet --}}
        <div id="map" class="w-full h-full bg-[#E2E8F0] relative z-0"></div>

        <button class="absolute bottom-10 left-10 w-16 h-16 bg-[#FF7F3E] text-white rounded-full shadow-[0_20px_50px_rgba(255,127,62,0.35)] flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-[500]">
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
                <button class="px-7 py-2.5 bg-[#FFF4EE] text-[#FF7F3E] text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Semua</button>
                <button class="px-7 py-2.5 text-slate-300 text-[10px] font-black rounded-full hover:bg-slate-50 uppercase tracking-widest transition">Tersedia</button>
                <button class="px-7 py-2.5 text-slate-300 text-[10px] font-black rounded-full hover:bg-slate-50 uppercase tracking-widest transition">Hampir Penuh</button>
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
    var mapCenter = [-6.2000, 106.8166];
    var map = L.map('map', {
        zoomControl: false
    }).setView(mapCenter, 13);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var geofenceRadius = L.circle(mapCenter, {
        color: '#FF7F3E',        
        fillColor: '#FF7F3E',    
        fillOpacity: 0.1,        
        radius: 5200            
    }).addTo(map);

    var markerMenteng = L.marker([-6.1944, 106.8330]).addTo(map)
        .bindPopup('<b>SDN 01 Menteng</b><br>Status: Siaga<br>Terdaftar: 120 Orang');

    var markerIstiqlal = L.marker([-6.1702, 106.8310]).addTo(map)
        .bindPopup('<b>Masjid Istiqlal</b><br>Status: <span style="color:red;">Penuh</span><br>Kapasitas: 100%');

    var group = new L.featureGroup([markerMenteng, markerIstiqlal, geofenceRadius]);
    map.fitBounds(group.getBounds(), { padding: [50, 50] });
});
</script>
@endpush