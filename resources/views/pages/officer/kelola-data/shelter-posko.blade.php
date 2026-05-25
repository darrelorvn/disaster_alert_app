@extends('pages.officer.kelola-data.manage-data', ['activeTab' => 'shelter'])

@section('tab_content')

{{-- Menampilkan Notifikasi Sukses --}}
@if(session('success'))
<div class="px-6 pt-5">
    <div class="flex items-center gap-3 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600">
        <i class="fa-solid fa-circle-check"></i>
        <p class="text-sm font-bold">{{ session('success') }}</p>
    </div>
</div>
@endif

<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 py-5 px-6">
    {{-- FORM FILTER --}}
    <form id="filterForm" method="GET" action="{{ route('officer.kelola-data.shelter.index') }}" class="flex flex-col md:flex-row md:items-center gap-3 w-full lg:w-auto">
        <span class="text-slate-400 text-[10px] font-black tracking-[0.08em] uppercase">Filter by:</span>
        
        {{-- Filter Tipe --}}
        <select name="type" onchange="document.getElementById('filterForm').submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all cursor-pointer">
            <option value="">Tipe (Semua)</option>
            @foreach($types as $type)
                <option value="{{ $type->value }}" {{ request('type') == $type->value ? 'selected' : '' }}>
                    {{ $type->label() }}
                </option>
            @endforeach
        </select>

        {{-- Filter Status --}}
        <select name="status" onchange="document.getElementById('filterForm').submit()" class="w-full md:w-auto min-w-[160px] border border-slate-200 rounded-lg bg-white text-slate-600 py-2.5 px-3 text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all cursor-pointer">
            <option value="">Status (Semua)</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Tersedia / Aktif</option>
            <option value="full" {{ request('status') == 'full' ? 'selected' : '' }}>Kapasitas Penuh</option>
            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Perbaikan</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>

        {{-- Tombol Reset Filter --}}
        @if(request()->filled('type') || request()->filled('status'))
            <a href="{{ route('officer.kelola-data.shelter.index') }}" class="text-[10px] font-black text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors">Reset</a>
        @endif
    </form>

    <div class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
        <span class="text-slate-500 text-[11px] font-extrabold whitespace-nowrap">Showing {{ $places->total() }} results</span>
        
        {{-- Tombol Tambah Data --}}
        <a href="{{ route('officer.kelola-data.shelter.create') }}" class="bg-[#FF7F3E] hover:bg-[#e66a2e] text-white py-2.5 px-4 rounded-lg text-[11px] font-black uppercase tracking-wide transition-all shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="overflow-x-auto w-full">
    <table class="w-full min-w-[980px] border-collapse">
        <thead class="bg-slate-100">
            <tr>
                <th class="py-[17px] px-6 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Nama Shelter / Posko</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Lokasi</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Tipe</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Status</th>
                <th class="py-[17px] px-5 text-slate-700 text-[11px] font-black tracking-[0.08em] text-left uppercase whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($places as $place)
                <tr class="hover:bg-slate-50 transition-colors">
                    {{-- Nama & Kapasitas --}}
                    <td class="py-[18px] px-6 border-t border-slate-100 text-slate-900 text-[13px] font-black align-middle">
                        {{ $place->name }}
                        @if($place->capacity)
                            <div class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-wider">
                                Kapasitas: {{ number_format($place->capacity) }} Orang
                            </div>
                        @endif
                    </td>

                    {{-- Alamat & Wilayah --}}
                    <td class="py-[18px] px-5 border-t border-slate-100 text-slate-600 text-[13px] align-middle">
                        <div class="font-bold text-slate-700 mb-0.5">{{ $place->area ?? '-' }}</div>
                        <div class="text-[11px] text-slate-400 leading-tight max-w-[250px] truncate" title="{{ $place->address }}">
                            {{ $place->address ?? 'Alamat belum diatur' }}
                        </div>
                    </td>

                    {{-- Tipe Fasilitas (Pakai metode color() & label() dari Enum) --}}
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase {{ $place->type->color() ?? 'bg-slate-100 text-slate-600' }}">
                            {{ $place->type->label() ?? $place->type }}
                        </span>
                    </td>

                    {{-- Status Kedaraan --}}
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        @php
                            $statusColor = match($place->status) {
                                'active' => 'bg-emerald-100 text-emerald-600',
                                'full' => 'bg-rose-100 text-rose-600',
                                'maintenance' => 'bg-orange-100 text-orange-600',
                                default => 'bg-slate-100 text-slate-500'
                            };
                            $statusLabel = match($place->status) {
                                'active' => 'Tersedia',
                                'full' => 'Penuh',
                                'maintenance' => 'Perbaikan',
                                default => 'Tidak Aktif'
                            };
                        @endphp
                        <span class="inline-flex items-center justify-center rounded-full py-1 px-2.5 text-[10px] font-black uppercase {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                    </td>

                    {{-- Aksi Edit & Hapus --}}
                    <td class="py-[18px] px-5 border-t border-slate-100 text-[13px] align-middle">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('officer.kelola-data.shelter.edit', $place->id) }}" class="border border-slate-200 rounded bg-white text-slate-700 py-1.5 px-3 text-[10px] font-black cursor-pointer hover:border-orange-400 transition-colors">
                                EDIT
                            </a>
                            
                            <form action="{{ route('officer.kelola-data.shelter.destroy', $place->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data fasilitas ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border border-rose-200 rounded bg-rose-50 text-rose-600 py-1.5 px-3 text-[10px] font-black cursor-pointer hover:bg-rose-600 hover:text-white transition-colors">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                            <p class="text-sm font-bold">Belum ada data fasilitas darurat.</p>
                            <p class="text-xs mt-1">Silakan klik "Tambah Data" untuk memulai.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination Links --}}
@if($places->hasPages())
<div class="px-6 py-4 border-t border-slate-100 bg-white">
    {{ $places->links() }}
</div>
@endif

@endsection