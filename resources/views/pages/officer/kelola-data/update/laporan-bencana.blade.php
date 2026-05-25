@extends('pages.officer.kelola-data.manage-data', ['activeTab' => 'laporan'])

@section('tab_content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    <div class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        <select class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            <option>Status (Semua)</option>
            <option>Kritis</option>
            <option>Terkendali</option>
        </select>
        <select class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            <option>Tipe Bencana (Semua)</option>
            <option>Banjir</option>
            <option>Tanah Longsor</option>
        </select>
    </div>
    
    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <button class="bg-[#FF7F3E] hover:bg-[#e66a2e] text-white py-2 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </button>
        <span class="text-slate-500 text-[11px] font-extrabold whitespace-nowrap">Showing 24 results</span>
    </div>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[860px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe Bencana</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Lokasi</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Pelapor</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                    <div class="flex items-center gap-2.5 text-slate-900 font-black leading-[1.15]">
                        <span class="w-[7px] h-[7px] rounded-full inline-flex shrink-0 bg-rose-400"></span>
                        <span>Banjir Bandang</span>
                    </div>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">Jl. Melati No. 42,<br>Cawang</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-rose-50 text-rose-500">Kritis</span>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">Bpk. Supriyadi</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <div class="flex items-center gap-2">
                        <button class="border border-slate-200 rounded bg-white text-slate-700 py-2 px-3 text-[10px] font-black cursor-pointer hover:border-orange-400 transition-colors">EDIT</button>
                        <button class="border-0 rounded bg-slate-900 text-white py-2 px-3 text-[10px] font-black cursor-pointer hover:bg-slate-700 transition-colors">DETAIL</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection