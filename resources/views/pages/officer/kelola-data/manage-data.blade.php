@extends('layouts.app') {{-- Sesuaikan jika menggunakan layouts.officer --}}

@section('content')
<section class="min-h-[calc(100vh-3.5rem)] -m-6 p-4 md:p-8 bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="max-w-[1160px] mx-auto">

        {{-- ===== HEADER ===== --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 mb-7">
            <div>
                <p class="m-0 mb-2 text-slate-500 text-[11px] font-extrabold tracking-[0.08em] uppercase">
                    Management / <span class="text-orange-500">Kelola Data Informasi</span>
                </p>
                <h1 class="m-0 mb-2 text-slate-900 text-[28px] leading-[1.1] font-black tracking-tight">
                    Kelola Data Informasi
                </h1>
                <p class="m-0 text-slate-500 text-sm font-medium">
                    Overview of active disasters and critical infrastructure deployment.
                </p>
            </div>
        </div>

        {{-- ===== STATS CARDS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-[18px] mb-[26px]" aria-label="Ringkasan data informasi">
            <article class="min-h-[126px] border border-slate-200 rounded-[13px] bg-white p-[22px] shadow-[0_8px_20px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-[18px]">
                    <span class="w-8 h-8 rounded-md inline-flex items-center justify-center text-base font-black bg-orange-50 text-orange-500"><i class="fa-solid fa-triangle-exclamation"></i></span>
                    <span class="text-emerald-600 text-[11px] font-black">+12%</span>
                </div>
                <p class="m-0 mb-2 text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Active Incidents</p>
                <p class="m-0 text-slate-900 text-[30px] font-black leading-none">24</p>
            </article>

            <article class="min-h-[126px] border border-slate-200 rounded-[13px] bg-white p-[22px] shadow-[0_8px_20px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-[18px]">
                    <span class="w-8 h-8 rounded-md inline-flex items-center justify-center text-base font-black bg-blue-50 text-blue-600"><i class="fa-solid fa-building-columns"></i></span>
                    <span class="text-emerald-600 text-[11px] font-black">+8%</span>
                </div>
                <p class="m-0 mb-2 text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Active Shelters</p>
                <p class="m-0 text-slate-900 text-[30px] font-black leading-none">118</p>
            </article>

            <article class="min-h-[126px] border border-slate-200 rounded-[13px] bg-white p-[22px] shadow-[0_8px_20px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-[18px]">
                    <span class="w-8 h-8 rounded-md inline-flex items-center justify-center text-base font-black bg-emerald-50 text-emerald-600"><i class="fa-solid fa-kit-medical"></i></span>
                    <span class="text-emerald-600 text-[11px] font-black">Operational</span>
                </div>
                <p class="m-0 mb-2 text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Medical Units</p>
                <p class="m-0 text-slate-900 text-[30px] font-black leading-none">42</p>
            </article>

            <article class="min-h-[126px] border border-slate-200 rounded-[13px] bg-white p-[22px] shadow-[0_8px_20px_rgba(15,23,42,0.04)]">
                <div class="flex items-center justify-between mb-[18px]">
                    <span class="w-8 h-8 rounded-md inline-flex items-center justify-center text-base font-black bg-rose-50 text-rose-500"><i class="fa-solid fa-exclamation"></i></span>
                    <span class="text-rose-500 text-[11px] font-black uppercase">Urgent</span>
                </div>
                <p class="m-0 mb-2 text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Action Items</p>
                <p class="m-0 text-slate-900 text-[30px] font-black leading-none">07</p>
            </article>
        </div>

        {{-- ===== MAIN CARD ===== --}}
        <section class="border border-slate-200 rounded-[14px] bg-white overflow-hidden shadow-[0_12px_30px_rgba(15,23,42,0.05)]">

            {{-- TAB NAVIGATION --}}
            @php
                // Berikan nilai default 'laporan' jika $activeTab tidak dikirim dari child view
                $currentTab = $activeTab ?? 'laporan';
                
                $activeClass = "text-orange-500 after:content-[''] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full";
                $inactiveClass = "text-slate-500 hover:text-slate-800";
            @endphp
            
            <div class="flex items-center gap-0 border-b border-slate-200 px-6 overflow-x-auto" role="tablist">
                <a href="{{ route('officer.kelola-data.laporan') }}" 
                   class="relative min-h-[62px] flex items-center pr-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $currentTab === 'laporan' ? $activeClass : $inactiveClass }}">
                    Laporan Bencana
                </a>
                <a href="{{ route('officer.kelola-data.evakuasi') }}" 
                   class="relative min-h-[62px] flex items-center px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $currentTab === 'evakuasi' ? $activeClass : $inactiveClass }}">
                    Jalur Evakuasi
                </a>
                
                {{-- Perubahan Rute Shelter Menjadi Route Resource (Ditambah .index) --}}
                <a href="{{ route('officer.kelola-data.shelter.index') }}" 
                   class="relative min-h-[62px] flex items-center px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $currentTab === 'shelter' ? $activeClass : $inactiveClass }}">
                    Shelter & Posko
                </a>
                
                <a href="{{ route('officer.kelola-data.faskes.index') }}" 
                   class="relative min-h-[62px] flex items-center px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $currentTab === 'faskes' ? $activeClass : $inactiveClass }}">
                    Fasilitas Kesehatan
                </a>
                <a href="{{ route('officer.kelola-data.penanggulangan') }}" 
                   class="relative min-h-[62px] flex items-center px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $currentTab === 'penanggulangan' ? $activeClass : $inactiveClass }}">
                    Catatan Penanggulangan
                </a>
            </div>

            {{-- ===== TAB CONTENT DYNAMIC INJECTION ===== --}}
            <div class="bg-white">
                @yield('tab_content')
            </div>

        </section>

        {{-- ===== ANALYTICS CARD ===== --}}
        <div class="flex justify-end pt-[26px]">
            <aside class="w-full md:w-[315px] border border-slate-200 rounded-[14px] bg-white p-6 shadow-[0_12px_30px_rgba(15,23,42,0.05)]">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="m-0 text-orange-500 text-sm font-black">Data Analytics</h3>
                    <span class="text-orange-500 font-black"><i class="fa-solid fa-arrow-trend-up"></i></span>
                </div>
                <p class="m-0 mb-[18px] text-slate-400 text-xs leading-[1.55] font-semibold">
                    Frekuensi laporan meningkat 14% dalam 24 jam terakhir. Disarankan penambahan personel di Cluster C.
                </p>
                <div class="h-1.5 rounded-full bg-slate-200 overflow-hidden mb-3">
                    <div class="w-3/4 h-full bg-orange-500 rounded-full"></div>
                </div>
                <div class="flex justify-between text-slate-500 text-[11px] font-bold">
                    <span>Response Capacity</span>
                    <strong>75%</strong>
                </div>
            </aside>
        </div>

    </div>
</section>
@endsection