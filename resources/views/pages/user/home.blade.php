@extends('layouts.app')

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
            <div id="evacuationMap" class="relative mt-3.5 h-[292px] overflow-hidden rounded-[14px] z-0"></div>
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

    {{-- Recent Section --}}
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
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#0369a1] bg-[#eff6ff]">Info</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Gempa M 4.2</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Barat Daya Jakarta</p>
                <strong class="text-[#16a34a] text-[10px] font-black uppercase">Status Aman</strong>
            </article>

            <article class="min-h-[120px] border border-[#e8edf5] rounded-[14px] p-[13px] bg-white">
                <span class="inline-flex mb-[9px] py-1 px-[7px] rounded-full text-[8px] font-black uppercase tracking-[0.05em] text-[#c2410c] bg-[#fff7ed]">Peringatan</span>
                <h4 class="m-0 mb-1.25 text-[#172033] text-xs font-black">Jalan Tergenang</h4>
                <p class="m-0 mb-3.5 text-[#94a3b8] text-[10px] font-bold">Kemayoran</p>
                <strong class="text-[#f97316] text-[10px] font-black uppercase">Waspada</strong>
            </article>

        </div>
    </section>
    </div>
@endsection

@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('evacuationMap').setView([-6.2250, 106.9004], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([-6.2250, 106.9004]).addTo(map)
        .bindPopup('<b>Titik Evakuasi</b><br>Posko Cawang')
        .openPopup();
        
    L.marker([-6.2400, 106.8800]).addTo(map)
        .bindPopup('<b>Fasilitas Kesehatan</b><br>RSUD Budhi Asih');
});
</script>
@endpush