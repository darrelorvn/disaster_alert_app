@extends('pages.officer.kelola-data.manage-data', ['activeTab' => 'penanggulangan'])

@section('tab_content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    <form method="GET" action="{{ route('officer.kelola-data.penanggulangan.index') }}" class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        <select name="disaster_type" onchange="this.form.submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
            <option value="Semua">Tipe Bencana (Semua)</option>
            <option value="banjir" {{ request('disaster_type') == 'banjir' ? 'selected' : '' }}>Banjir</option>
            <option value="tanah_longsor" {{ request('disaster_type') == 'tanah_longsor' ? 'selected' : '' }}>Tanah Longsor</option>
            <option value="kebakaran" {{ request('disaster_type') == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
        </select>
    </form>

    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <a href="{{ route('officer.kelola-data.penanggulangan.create') }}" class="bg-[#FF7F3E] hover:bg-[#e66a2e] text-white py-2 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[960px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tindakan Penanggulangan</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe Bencana</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Kejadian Terkait</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-900 text-[13px] font-black align-middle max-w-[260px]">
                    {{ $note->title }}<br>
                    <span class="text-[10px] text-slate-400 font-medium">Area: {{ $note->affected_area }}</span>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                    {{ strtoupper(str_replace('_', ' ', $note->disaster_type)) }}
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                    @if($note->disasterEvent)
                        <div class="flex flex-col">
                            <span class="text-orange-600 font-black text-[11px] uppercase tracking-tighter flex items-center gap-1">
                                <i class="fas fa-link"></i>
                                {{ $note->disasterEvent->title }}
                            </span>
                            <span class="text-[10px] text-slate-400">{{ $note->disasterEvent->occurred_at->format('d/m/Y') }}</span>
                        </div>
                    @else
                        <span class="text-[10px] text-slate-400 font-bold uppercase italic">Umum</span>
                    @endif
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase bg-emerald-100 text-emerald-600">
                        Terverifikasi
                    </span>
                </td>
                <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('officer.kelola-data.penanggulangan.edit', $note) }}" 
                           class="border border-slate-200 rounded bg-white text-slate-700 py-2 px-3 text-[10px] font-black cursor-pointer hover:border-orange-400 transition-colors">
                            EDIT
                        </a>
                        
                        <a href="{{ route('officer.kelola-data.penanggulangan.show', $note) }}" 
                           class="border-0 rounded bg-slate-900 text-white py-2 px-3 text-[10px] font-black cursor-pointer hover:bg-slate-700 transition-colors">
                            DETAIL
                        </a>
        
                        <form action="{{ route('officer.kelola-data.penanggulangan.destroy', $note) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-[10px] font-black uppercase ml-2">HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5">{{ $notes->links() }}</div>
</div>
@endsection