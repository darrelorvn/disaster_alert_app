@props(['activeTab'])

<div class="flex items-center gap-0 border-b border-slate-200 px-6 overflow-x-auto" role="tablist" aria-label="Kategori kelola data">
    <a href="{{ route('officer.kelola-data.laporan.index') }}" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $activeTab === 'laporan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800' }}">
        Laporan Bencana
    </a>

    <a href="{{ route('officer.kelola-data.evakuasi.index') }}" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $activeTab === 'evakuasi' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800' }}">
        Jalur Evakuasi
    </a>

    <a href="{{ route('officer.kelola-data.shelter.index') }}" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $activeTab === 'shelter' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800' }}">
        Shelter dan Posko
    </a>

    <a href="{{ route('officer.kelola-data.faskes.index') }}" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $activeTab === 'kesehatan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800' }}">
        Fasilitas Kesehatan
    </a>

    <a href="{{ route('officer.kelola-data.penanggulangan.index') }}" 
       class="relative min-h-[62px] flex items-center bg-transparent px-7 text-[13px] font-bold whitespace-nowrap transition-colors {{ $activeTab === 'penanggulangan' ? 'text-orange-500 after:content-[\'\'] after:absolute after:left-0 after:right-7 after:-bottom-[1px] after:h-[2px] after:bg-orange-500 after:rounded-full' : 'text-slate-500 hover:text-slate-800' }}">
        Catatan Penanggulangan
    </a>
</div>