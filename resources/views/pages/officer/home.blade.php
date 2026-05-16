@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div class="flex items-center gap-2">
            <span class="relative flex h-3 w-3">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
            </span>
            <span class="text-sm font-bold text-green-600">BMKG Status: Connected</span>
        </div>

        <div class="flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-2 text-sm font-medium text-blue-800 border border-blue-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Rekomendasi AI: Peningkatan debit air di Jaktim memerlukan aktivasi Posko Siaga 1 segera.
        </div>
    </div>

    <div class="mb-6 relative overflow-hidden rounded-2xl bg-gradient-to-r from-orange-400 to-orange-500 p-6 text-white shadow-lg shadow-orange-500/20">
        <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white opacity-10 blur-2xl"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div class="flex items-start gap-4">
                <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <div>
                    <span class="mb-1 inline-block rounded bg-white px-2 py-0.5 text-xs font-bold tracking-wide text-orange-600">WASPADA</span>
                    <h2 class="mb-1 text-2xl font-bold tracking-tight">Darurat Banjir Jakarta Timur</h2>
                    <p class="text-sm text-orange-50">Level Siaga 1: Kenaikan muka air melampaui batas aman di 5 titik pantau.</p>
                </div>
            </div>
            <button class="flex items-center gap-2 whitespace-nowrap rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-orange-500 transition hover:bg-orange-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Lihat Laporan
            </button>
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-green-600 border-l-4">
            <div>
                <p class="text-sm font-bold text-green-600">Total Laporan Masuk</p>
                <p class="text-4xl font-bold text-green-600 mt-1">42</p>
            </div>
            <div class="rounded-full bg-green-50 p-3 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-4 border-l-red-500">
            <div>
                <p class="text-sm font-bold text-red-500">Belum Ditangani</p>
                <p class="text-4xl font-bold text-red-500 mt-1">42</p>
            </div>
            <div class="rounded-full bg-red-50 p-3 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm border-l-4 border-l-orange-500">
            <div>
                <p class="text-sm font-bold text-orange-500">Total Wilayah Siaga</p>
                <p class="text-4xl font-bold text-orange-500 mt-1">12</p>
            </div>
            <div class="rounded-full bg-orange-50 p-3 text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex gap-3">
            <button class="flex items-center justify-between w-40 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Jenis Bencana
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <button class="flex items-center justify-between w-40 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Status Laporan
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        
        {{-- Kontainer Peta --}}
        <div class="relative h-96 w-full rounded-xl border border-slate-200 bg-slate-100 overflow-hidden">
            
            <div id="distributionMap" class="absolute inset-0 z-0"></div>
            
            {{-- Custom Zoom Control diposisikan di atas Leaflet --}}
            <div class="absolute bottom-4 right-4 flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm z-[500]">
                <button id="zoomInBtn" class="p-2 text-slate-600 hover:bg-slate-100 border-b border-slate-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <button id="zoomOutBtn" class="p-2 text-slate-600 hover:bg-slate-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Laporan Terbaru</h3>
            <div class="flex gap-3">
                <button class="flex items-center justify-between w-36 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Jenis Bencana
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <button class="flex items-center justify-between w-40 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Sumber Informasi
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="border-b border-slate-200 bg-slate-50/50 text-xs uppercase text-slate-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-semibold">Status</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Waktu</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Kejadian</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Lokasi</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Sumber</th>
                        <th scope="col" class="px-4 py-3 font-semibold">Detail Laporan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-4">
                            <span class="rounded bg-red-100 px-2.5 py-1 text-xs font-bold text-red-600">DARURAT</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">2 Menit Lalu</td>
                        <td class="px-4 py-4 font-bold text-slate-800">Tanggul Jebol - RT 04/05</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                                Jatiwarna, Jakarta Timur
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 tracking-wide uppercase">
                                <i class="fa-solid fa-share-nodes shrink-0"></i>
                                MEDIA SOSIAL
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <button class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-600 transition-colors hover:bg-orange-100 hover:text-orange-700">
                                Detail
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-4">
                            <span class="rounded bg-orange-100 px-2.5 py-1 text-xs font-bold text-orange-600">WASPADA</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">15 Menit Lalu</td>
                        <td class="px-4 py-4 font-bold text-slate-800">Pohon Tumbang Menutup Jalan</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                                Jl. Raya Bogor KM 22
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 tracking-wide uppercase">
                                <i class="fa-solid fa-users shrink-0"></i>
                                WARGA
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <button class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-600 transition-colors hover:bg-orange-100 hover:text-orange-700">
                                Detail
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-4">
                            <span class="rounded bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-600">INFO</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">42 Menit Lalu</td>
                        <td class="px-4 py-4 font-bold text-slate-800">Distribusi Logistik Selesai</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                                GOR Ciracas
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 tracking-wide uppercase">
                                <i class="fa-solid fa-user-shield shrink-0"></i>
                                PETUGAS LAPANGAN
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <button class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-600 transition-colors hover:bg-orange-100 hover:text-orange-700">
                                Detail
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('distributionMap', {
        zoomControl: false 
    }).setView([-6.2250, 106.9004], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    document.getElementById('zoomInBtn').addEventListener('click', function() {
        map.zoomIn();
    });
    
    document.getElementById('zoomOutBtn').addEventListener('click', function() {
        map.zoomOut();
    });

    var incidentData = [
        { lat: -6.2425, lng: 106.8642, title: 'Darurat: Tanggul Jebol', desc: 'Jatiwarna, Jakarta Timur', status: 'red' },
        { lat: -6.3000, lng: 106.8800, title: 'Waspada: Pohon Tumbang', desc: 'Jl. Raya Bogor KM 22', status: 'orange' },
        { lat: -6.3200, lng: 106.8700, title: 'Info: Distribusi Logistik', desc: 'GOR Ciracas', status: 'blue' }
    ];

    incidentData.forEach(function(incident) {
        L.marker([incident.lat, incident.lng]).addTo(map)
            .bindPopup('<strong style="color:' + incident.status + '">' + incident.title + '</strong><br>' + incident.desc);
    });
});
</script>
@endpush