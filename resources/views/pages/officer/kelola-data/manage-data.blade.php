@extends('layouts.app')

@section('content')
<section class="w-full min-h-screen bg-slate-50 text-slate-900 p-4 md:p-8">
    <div class="max-w-[1200px] mx-auto flex flex-col gap-6">

        {{-- ===== 1. HEADER TITLE ===== --}}
        <div>
            <p class="m-0 mb-1.5 text-slate-400 text-[11px] font-black tracking-[0.08em] uppercase">
                Management / <span class="text-orange-500">Kelola Data Informasi</span>
            </p>
            <h1 class="m-0 mb-1.5 text-slate-900 text-2xl md:text-3xl font-black tracking-tight">
                Kelola Data Informasi
            </h1>
            <p class="m-0 text-slate-500 text-xs md:text-sm font-medium">
                Overview of active disasters and critical infrastructure deployment.
            </p>
        </div>

        {{-- ===== 2. STATS CARDS (4 KOTAK ANALYTICS ATAS) ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="border border-slate-100 rounded-xl bg-white p-5 shadow-sm flex flex-col gap-2">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-black uppercase tracking-wider">Active Incidents</span>
                    <span class="text-emerald-500 text-[10px] font-bold bg-emerald-50 px-2 py-0.5 rounded-full">+12%</span>
                </div>
                <div class="text-2xl font-black text-slate-900">24</div>
            </div>

            <div class="border border-slate-100 rounded-xl bg-white p-5 shadow-sm flex flex-col gap-2">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-black uppercase tracking-wider">Active Shelters</span>
                    <span class="text-emerald-500 text-[10px] font-bold bg-emerald-50 px-2 py-0.5 rounded-full">+8%</span>
                </div>
                <div class="text-2xl font-black text-slate-900">118</div>
            </div>

            <div class="border border-slate-100 rounded-xl bg-white p-5 shadow-sm flex flex-col gap-2">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-black uppercase tracking-wider">Medical Units</span>
                    <span class="text-slate-500 text-[10px] font-bold bg-slate-100 px-2 py-0.5 rounded-full">Operational</span>
                </div>
                <div class="text-2xl font-black text-slate-900">42</div>
            </div>

            <div class="border border-slate-100 rounded-xl bg-white p-5 shadow-sm flex flex-col gap-2">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-black uppercase tracking-wider">Action Items</span>
                    <span class="text-rose-500 text-[10px] font-bold bg-rose-50 px-2 py-0.5 rounded-full">URGENT</span>
                </div>
                <div class="text-2xl font-black text-slate-900">07</div>
            </div>
        </div>

        {{-- ===== 3. CONTAINER UTAMA UNTUK DATA & TAB NATIVE ===== --}}
        <div class="border border-slate-200/80 rounded-2xl bg-white shadow-sm overflow-hidden">
            
            {{-- HEADER NAVIGASI TAB --}}
            <div class="flex items-center border-b border-slate-100 px-6 overflow-x-auto gap-1">
                <a href="{{ route('officer.kelola-data.laporan') }}" class="py-4 px-4 text-xs font-bold border-b-2 whitespace-nowrap transition-all {{ Request::is('petugas/kelola-data/laporan') ? 'border-orange-500 text-orange-500' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
                    Laporan Bencana
                </a>
                <a href="{{ route('officer.kelola-data.evakuasi') }}" class="py-4 px-4 text-xs font-bold border-b-2 whitespace-nowrap transition-all {{ Request::is('petugas/kelola-data/evakuasi') ? 'border-orange-500 text-orange-500' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
                    Jalur Evakuasi
                </a>
                <a href="{{ route('officer.kelola-data.shelter') }}" class="py-4 px-4 text-xs font-bold border-b-2 whitespace-nowrap transition-all {{ Request::is('petugas/kelola-data/shelter') ? 'border-orange-500 text-orange-500' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
                    Shelter & Posko
                </a>
                <a href="{{ route('officer.kelola-data.faskes') }}" class="py-4 px-4 text-xs font-bold border-b-2 whitespace-nowrap transition-all {{ Request::is('petugas/kelola-data/faskes') ? 'border-orange-500 text-orange-500' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
                    Fasilitas Kesehatan
                </a>
                <a href="{{ route('officer.kelola-data.penanggulangan') }}" class="py-4 px-4 text-xs font-bold border-b-2 whitespace-nowrap transition-all {{ Request::is('petugas/kelola-data/penanggulangan') ? 'border-orange-500 text-orange-500' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
                    Catatan Penanggulangan
                </a>
            </div>

            {{-- LUBANG TEMPAT SUB-HALAMAN MASUK --}}
            <div class="w-full">
                @yield('tab_content')
            </div>

        </div>

        {{-- ===== 4. DATA ANALYTICS SIDEBAR CARD (DI BAWAH) ===== --}}
        <div class="flex justify-end mt-2">
            <div class="w-full sm:w-[320px] border border-slate-200/60 rounded-xl bg-white p-5 shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="m-0 text-orange-500 text-xs font-black uppercase tracking-wider">Data Analytics</h3>
                    <span class="text-orange-500 text-xs"><i class="fa-solid fa-arrow-trend-up"></i></span>
                </div>
                <p class="m-0 mb-4 text-slate-500 text-xs leading-relaxed font-medium">
                    Frekuensi laporan meningkat 14% dalam 24 jam terakhir. Disarankan penambahan personel di Cluster C.
                </p>
                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden mb-2.5">
                    <div class="w-3/4 h-full bg-orange-500 rounded-full"></div>
                </div>
                <div class="flex justify-between text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                    <span>Response Capacity</span>
                    <span class="text-slate-800 font-black">75%</span>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection