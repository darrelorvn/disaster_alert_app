@extends('pages.officer.kelola-data.manage-data', ['activeTab' => 'kesehatan'])

@section('tab_content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    <div class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        <select class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
            <option>Tipe (Semua)</option>
            <option>Rumah Sakit</option>
            <option>Puskesmas</option>
        </select>
    </div>
    <span class="text-slate-500 text-[11px] font-extrabold whitespace-nowrap">Showing 42 results</span>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[1000px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Nama Fasilitas</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Lokasi</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-900 text-[13px] font-black align-middle">RSUD Budhi Asih</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">Jl. Dewi Sartika, Jakarta Timur</td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-emerald-50 text-emerald-600">RS Umum</span>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-emerald-100 text-emerald-600">Operasional</span>
                </td>
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