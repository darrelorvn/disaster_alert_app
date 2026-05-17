@extends('layouts.app')

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

    <section class="mt-[22px] grid grid-cols-1 lg:grid-cols-[1fr_285px] gap-[22px] items-stretch">
        <article class="p-4 bg-white border border-[#e6ebf2] rounded-[18px] shadow-[0_14px_34px_rgba(15,23,42,0.06)]">
            <div class="flex items-center justify-between gap-4">
                <h3 class="m-0 text-[#172033] text-sm font-black">Peta Evakuasi</h3>
                <span class="text-[#94a3b8] text-[11px] font-extrabold">Radius 5 km</span>
            </div>
            <div id="evacuationMap" class="relative mt-3.5 overflow-hidden rounded-[14px] z-0"></div>
        </article>

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

            <a href="{{ route('user.tindakan-preventif.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">
                <i class="fa-solid fa-clipboard-list"></i>
                Daftar Tindakan Preventif
            </a>
        </aside>
    </section>

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

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span id="bmkg-tag" class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info BMKG</span>
                <h4 id="bmkg-judul" class="m-0 mb-1.25 text-[#172033] text-xs font-black">Memuat Data...</h4>
                <p id="bmkg-deskripsi" class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold line-clamp-2">Menghubungkan BMKG</p>
                <strong id="bmkg-status" class="text-[#16a34a] text-[10px] font-black uppercase">Pengecekan</strong>
            </article>

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Jalan Tergenang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Kemayoran</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Waspada</strong>
            </article>

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
                                <tr id="bmkg-loading-row">
                                    <td colspan="5" class="p-4 text-center text-[#94a3b8] font-bold">Mengunduh riwayat bencana dari server BMKG...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Controls -->
                    <div id="pagination-controls" class="flex items-center justify-between border-t border-[#e8edf5] bg-white px-4 py-3 sm:px-6">
                        <!-- Akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // State Pagination
    let bmkgDataList = [];
    let currentPage = 1;
    const itemsPerPage = 5;

    function renderTable() {
        const listContainer = document.getElementById('bmkg-list-container');
        if (!listContainer) return;
        
        listContainer.innerHTML = '';
        
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedData = bmkgDataList.slice(start, end);

        paginatedData.forEach(item => {
            const isDanger = item.Potensi.toLowerCase().includes('waspada') || (item.Potensi.toLowerCase().includes('potensi tsunami') && !item.Potensi.toLowerCase().includes('tidak'));
            const badgeColor = isDanger ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50';

            const row = `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-3 pl-4 font-bold text-[#64748b]">${item.Jam.split(' ')[0]} WIB<br><span class="text-[9px]">${item.Tanggal}</span></td>
                    <td class="p-3 font-black text-[#172033]">SR ${item.Magnitude}</td>
                    <td class="p-3 text-[#64748b]">${item.Kedalaman}</td>
                    <td class="p-3 text-[#172033] max-w-[320px] truncate" title="${item.Wilayah}">${item.Wilayah}</td>
                    <td class="p-3 pr-4 text-right">
                        <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase ${badgeColor}">
                            ${item.Potensi}
                        </span>
                    </td>
                </tr>
            `;
            listContainer.innerHTML += row;
        });

        renderPaginationControls();
    }

    function renderPaginationControls() {
        const controlsContainer = document.getElementById('pagination-controls');
        if (!controlsContainer) return;

        const totalPages = Math.ceil(bmkgDataList.length / itemsPerPage);
        
        if (totalPages <= 1) {
            controlsContainer.innerHTML = '';
            return;
        }

        const startCount = ((currentPage - 1) * itemsPerPage) + 1;
        const endCount = Math.min(currentPage * itemsPerPage, bmkgDataList.length);

        let html = `
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-slate-500 m-0">
                        Menampilkan <span class="font-black text-slate-800">${startCount}</span> sampai <span class="font-black text-slate-800">${endCount}</span> dari <span class="font-black text-slate-800">${bmkgDataList.length}</span> kejadian
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}">
                            <span class="sr-only">Previous</span>
                            <i class="fa-solid fa-chevron-left w-3 h-3"></i>
                        </button>
        `;

        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i === currentPage 
                ? 'z-10 bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-500 focus-visible:outline-orange-600' 
                : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50';
            
            html += `
                <button onclick="changePage(${i})" class="relative inline-flex items-center px-3 py-1.5 text-xs font-black ${activeClass} focus:z-20 focus:outline-offset-0">${i}</button>
            `;
        }

        html += `
                        <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}">
                            <span class="sr-only">Next</span>
                            <i class="fa-solid fa-chevron-right w-3 h-3"></i>
                        </button>
                    </nav>
                </div>
            </div>
            
            <div class="flex flex-1 justify-between sm:hidden text-xs">
                <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-black text-gray-700 hover:bg-gray-50 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}">Sebelumnya</button>
                <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-black text-gray-700 hover:bg-gray-50 ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}">Selanjutnya</button>
            </div>
        `;
        
        controlsContainer.innerHTML = html;
    }

    window.changePage = function(page) {
        const totalPages = Math.ceil(bmkgDataList.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderTable();
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
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

        fetch("/bmkg-terbaru", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(res => {
            const data = res.data; 
            if (data && data.judul) {
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
        })
        .catch(error => {
            if(document.getElementById('bmkg-judul')) document.getElementById('bmkg-judul').innerText = 'Gagal Memuat';
            if(document.getElementById('bmkg-deskripsi')) document.getElementById('bmkg-deskripsi').innerText = 'Tidak dapat terhubung ke server internal.';
        });

        // Pengambilan list riwayat BMKG
        fetch("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json")
        .then(response => response.json())
        .then(data => {
            if (data.Infogempa && data.Infogempa.gempa) {
                bmkgDataList = data.Infogempa.gempa;
                currentPage = 1;
                renderTable(); // Merender tabel beserta pagination-nya
            }
        })
        .catch(error => {
            const listContainer = document.getElementById('bmkg-list-container');
            if (listContainer) {
                listContainer.innerHTML = `
                    <tr class="hover:bg-slate-50">
                        <td colspan="5" class="p-4 text-center text-red-500 font-bold">Gagal terhubung ke server BMKG. Coba muat ulang halaman.</td>
                    </tr>
                `;
            }
        });
    });
</script>
@endpush