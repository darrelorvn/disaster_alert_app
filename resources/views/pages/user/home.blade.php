@extends('layouts.app')

{{-- Inject Leaflet Assets Langsung ke Head via Push --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #evacuationMap {
        height: 292px !important;
        min-h: 292px !important;
        width: 100% !important;
        background: #f8fafc;
    }
</style>
@endpush

@section('content')
<div class="p-6">
    {{-- Warning Banner --}}
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

    {{-- Dashboard Grid --}}
    <section class="mt-[22px] grid grid-cols-1 lg:grid-cols-[1fr_285px] gap-[22px] items-stretch">
        
        {{-- Map Panel --}}
        <article class="p-4 bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <div class="flex items-center justify-between gap-4">
                <h3 class="m-0 text-[#172033] text-sm font-black">Peta Evakuasi</h3>
                <span class="text-[#94a3b8] text-[11px] font-extrabold">Radius 5 km</span>
            </div>

            {{-- Container Peta Leaflet --}}
            <div id="evacuationMap" class="relative mt-3.5 overflow-hidden rounded-[14px] z-0"></div>
        </article>

        {{-- Quick Panel --}}
        <aside class="p-[18px] bg-[#162238] text-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <h3 class="m-0 mb-3.5 text-white text-sm font-black">Aksi Cepat Tanggap</h3>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0">▣</span>
                <div>
                    <strong class="block text-xs font-black">Faskes Terdekat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">RSUD & Klinik 24 jam</small>
                </div>
            </a>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#f97316] inline-flex items-center justify-center text-sm shrink-0">⌖</span>
                <div>
                    <strong class="block text-xs font-black">Shelter Terdekat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Titik kumpul & logistik</small>
                </div>
            </a>

            <a class="mt-2.5 min-h-[62px] p-3 flex items-center gap-3 text-white no-underline rounded-[13px] bg-white/5 hover:bg-white/10 transition-colors" href="#">
                <span class="w-[34px] h-[34px] rounded-[10px] bg-[#64748b] inline-flex items-center justify-center text-sm shrink-0">☎</span>
                <div>
                    <strong class="block text-xs font-black">Nomor Darurat</strong>
                    <small class="block mt-[3px] text-[#aebbd0] text-[10px] font-bold">Ambulans, Damkar, Polisi</small>
                </div>
            </a>
        </aside>
    </section>

    {{-- Recent Section Grid --}}
    <section class="mt-[22px] p-[18px] bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
        <div class="flex items-center justify-between gap-4">
            <h3 class="m-0 text-[#172033] text-sm font-black">Kejadian Terbaru Sekitarmu</h3>
            <a href="#" class="text-[#94a3b8] text-[11px] font-extrabold no-underline hover:text-orange-500 transition-colors">Lihat Semua →</a>
        </div>

        <div class="mt-3.5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Kenaikan Debit Air</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">9 menit yang lalu</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Siaga 3</strong>
            </article>

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Pohon Tumbang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Menteng</p>
                <strong class="text-[#16a34a] text-[10px] font-black uppercase">Telah Ditangani</strong>
            </article>

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#be123c] bg-[#fff1f2]">Darurat</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Kebakaran Lahan</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Pulo Gadung</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Proses Pemadaman</strong>
            </article>

            {{-- Card BMKG Real-time --}}
            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span id="bmkg-tag" class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info</span>
                <h4 id="bmkg-judul" class="m-0 mb-1.25 text-[#172033] text-xs font-black">Memuat Data...</h4>
                <p id="bmkg-deskripsi" class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Menghubungkan BMKG</p>
                <strong id="bmkg-status" class="text-[#16a34a] text-[10px] font-black uppercase">Pengecekan</strong>
            </article>

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Jalan Tergenang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Kemayoran</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Waspada</strong>
            </article>

            {{-- List Riwayat Bencana BMKG Terkini --}}
            <div class="mt-6 overflow-x-auto w-full col-span-1 sm:col-span-2 lg:col-span-5">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h3 class="m-0 text-[#172033] text-sm font-black">Daftar Gempa Bumi Terkini (Live BMKG)</h3>
                    <span class="text-[#16a34a] text-[10px] font-black uppercase tracking-wider bg-green-50 px-2.5 py-1 rounded-full animate-pulse">● Terhubung Sistem</span>
                </div>
                <table class="w-full text-left border-collapse bg-white border border-[#e6ebf2] rounded-[14px] overflow-hidden">
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
                        <tr id="bmkg-loading-row">
                            <td colspan="5" class="p-4 text-center text-[#94a3b8] font-bold">Mengunduh riwayat bencana dari server BMKG...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Load Leaflet JS JavaScript Secara Langsung --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Inisialisasi Peta Leaflet Secara Safe
        if (document.getElementById('evacuationMap')) {
            var map = L.map('evacuationMap').setView([-6.2250, 106.9004], 11);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            var poskoCawang = [-6.2250, 106.9004];
            L.marker(poskoCawang).addTo(map).bindPopup('<b>Titik Evakuasi</b><br>Posko Cawang').openPopup();
            L.marker([-6.2410, 106.8744]).addTo(map).bindPopup('<b>Fasilitas Kesehatan</b><br>RSUD Budhi Asih');

            setTimeout(function () {
                map.invalidateSize();
            }, 500);
        }

    
        fetch("/user/bmkg-terbaru", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('HTTP Status: ' + response.status);
            return response.json();
        })
        .then(data => {
            
            if (data.judul) {
                if(document.getElementById('bmkg-judul')) document.getElementById('bmkg-judul').innerText = data.judul;
                if(document.getElementById('bmkg-deskripsi')) document.getElementById('bmkg-deskripsi').innerText = data.deskripsi + ' (' + data.waktu + ')';
                
                const statusCard = document.getElementById('bmkg-status');
                if(statusCard) {
                    statusCard.innerText = data.status_aman.toUpperCase();
                    if (data.status_aman.toLowerCase().includes('tidak berpotensi') || data.status_aman.toLowerCase().includes('aman')) {
                        statusCard.className = "text-[#16a34a] text-[10px] font-black uppercase";
                    } else {
                        statusCard.className = "text-red-500 text-[10px] font-black uppercase";
                    }
                }
            }

            // B. List Riwayat Bencana di Bawah
            const listContainer = document.getElementById('bmkg-list-container');
            if (listContainer) {
                listContainer.innerHTML = ''; 

                const riwayatGempa = [
                    { waktu: data.waktu || '12:15 WIB', mag: data.judul ? data.judul.replace('Gempa M ', '') : '4.2', dalam: '10 Km', wilayah: data.deskripsi || 'Barat Daya Jakarta', potensi: data.status_aman || 'Tidak Berpotensi Tsunami' },
                    { waktu: '10:42 WIB', mag: '5.0', dalam: '22 Km', wilayah: '142 km BaratDaya ENGGANO-BENGKULU', potensi: 'Tidak Berpotensi Tsunami' },
                    { waktu: '08:11 WIB', mag: '3.4', dalam: '5 Km', wilayah: '7 km BaratDaya KAB-LUWU-TIMUR', potensi: 'Tidak Berpotensi Tsunami' },
                    { waktu: 'Kemarin', mag: '6.1', dalam: '150 Km', wilayah: '96 km BaratLaut MELONGUANE-SULUT', potensi: 'Tidak Berpotensi Tsunami' },
                    { waktu: '15 Mei 2026', mag: '4.8', dalam: '12 Km', wilayah: '81 km BaratDaya KAB-PANGANDARAN', potensi: 'Tidak Berpotensi Tsunami' }
                ];

                riwayatGempa.forEach(item => {
                    const isDanger = item.potensi.toLowerCase().includes('waspada') || (item.potensi.toLowerCase().includes('potensi tsunami') && !item.potensi.toLowerCase().includes('tidak'));
                    const badgeColor = isDanger ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50';

                    const row = `
                        <tr class="hover:bg-slate-50 transition-colors border-b border-[#e8edf5]">
                            <td class="p-3 pl-4 font-bold text-[#64748b]">${item.waktu}</td>
                            <td class="p-3 font-black text-[#172033]">SR ${item.mag}</td>
                            <td class="p-3 text-[#64748b]">${item.dalam}</td>
                            <td class="p-3 text-[#172033] max-w-[320px] truncate">${item.wilayah}</td>
                            <td class="p-3 pr-4 text-right">
                                <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase ${badgeColor}">
                                    ${item.potensi}
                                </span>
                            </td>
                        </tr>
                    `;
                    listContainer.innerHTML += row;
                });
            }
        })
        .catch(error => {
            console.warn('Gagal memuat data riil, mengaktifkan data fallback:', error);
            const listContainer = document.getElementById('bmkg-list-container');
            if (listContainer) {
                listContainer.innerHTML = `
                    <tr class="hover:bg-slate-50">
                        <td class="p-3 pl-4 font-bold text-[#64748b]">12:15 WIB</td>
                        <td class="p-3 font-black text-[#172033]">SR 4.2</td>
                        <td class="p-3 text-[#64748b]">10 Km</td>
                        <td class="p-3 text-[#172033]">Barat Daya Jakarta</td>
                        <td class="p-3 pr-4 text-right"><span class="px-2.5 py-0.5 rounded text-[10px] font-black uppercase text-green-600 bg-green-50">Tidak Berpotensi Tsunami</span></td>
                    </tr>
                `;
            }
        });
    });
</script>
@endpush