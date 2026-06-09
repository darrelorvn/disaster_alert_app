@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('officer.kelola-data.laporan') }}" class="hover:text-orange-500 transition-colors">Laporan Bencana</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Detail Laporan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Detail Laporan Bencana</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('officer.kelola-data.laporan.edit', $report) }}" class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">
                Edit Laporan
            </a>
            <a href="{{ route('officer.kelola-data.laporan') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm h-fit">
            <h3 class="mb-4 text-sm font-black uppercase tracking-wider text-slate-800">Informasi Laporan</h3>
            
            <div class="space-y-4">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Tipe Bencana</p>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ str_replace('_', ' ', $report->type) }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status</p>
                    <p class="text-sm font-bold text-orange-500 uppercase">{{ $report->status }}</p>
                </div>

                @if($report->disasterEvent && $report->disasterEvent->expired_at)
                <div class="p-3 bg-red-50 border border-red-100 rounded-lg">
                    <p class="text-[10px] font-black uppercase tracking-widest text-red-400">Waktu Expired</p>
                    <p class="text-sm font-bold text-red-600">
                        {{ \Carbon\Carbon::parse($report->disasterEvent->expired_at)->format('d M Y, H:i') }}
                        @if(\Carbon\Carbon::parse($report->disasterEvent->expired_at)->isPast())
                            <span class="ml-2 px-1.5 py-0.5 bg-red-600 text-white text-[10px] rounded uppercase">Sudah Berakhir</span>
                        @endif
                    </p>
                </div>
                @endif

                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Waktu Kejadian</p>
                    <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($report->occurred_at)->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama Pelapor</p>
                    <p class="text-sm font-bold text-slate-800">{{ $report->reporter_name ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Deskripsi Kejadian</p>
                    <p class="text-sm font-medium text-slate-700 mt-1 bg-slate-50 p-4 rounded-lg border border-slate-100 italic">{{ $report->description }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Lokasi Teks</p>
                    <p class="text-sm font-bold text-slate-800">{{ $report->location_name ?? 'Tidak ada data lokasi' }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-sm font-black uppercase tracking-wider text-slate-800">Lokasi di Peta</h3>
                <div id="mapDetail" class="w-full h-[250px] rounded-lg border border-slate-200 z-0"></div>
            </div>

            @if($report->attachments && $report->attachments->count() > 0)
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-sm font-black uppercase tracking-wider text-slate-800">Foto Lampiran</h3>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($report->attachments as $photo)
                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Foto Bencana" class="w-full h-32 object-cover rounded-lg border border-slate-200 hover:opacity-90 transition-opacity">
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let lat = {{ $report->latitude ?? -6.2000 }};
    let lng = {{ $report->longitude ?? 106.8166 }};
    
    // Inisialisasi peta statis (drag dan zoom dimatikan)
    const map = L.map('mapDetail', {
        zoomControl: false, 
        dragging: false, 
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false
    }).setView([lat, lng], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Bencana");
});
</script>
@endpush