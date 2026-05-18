@extends('pages.officer.kelola-data.manage-data')

@section('tab_content')
<div class="p-6 flex flex-col gap-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 text-[10px] font-black tracking-wider uppercase">Filter By:</span>
            <select class="border border-slate-200 rounded-lg bg-white text-slate-700 text-xs p-2 focus:outline-none focus:border-orange-500">
                <option>Tipe (Semua)</option>
                <option>RS Umum</option>
                <option>Puskesmas</option>
            </select>
        </div>

        <button type="button" onclick="document.getElementById('modal-tambah-faskes').classList.replace('hidden', 'flex')" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-lg flex items-center gap-2 transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="text-sm">TAMBAH</span>
        </button>
    </div>

    <div class="w-full overflow-x-auto border border-slate-100 rounded-xl bg-white shadow-sm">
        <table class="w-full text-left border-collapse text-xs whitespace-nowrap">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase text-[11px] font-black tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4">Nama Pusat Kesehatan</th>
                    <th class="px-6 py-4">Wilayah / Lokasi</th>
                    <th class="px-6 py-4">Tipe Bencana</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700">
                @forelse($healthCenters as $item)
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-bold">{{ $item->nama_faskes }}</td>
                    <td class="px-6 py-4 text-[13px]">{{ $item->wilayah }}</td>
                    <td class="px-6 py-4 text-[13px] text-orange-600 font-medium">{{ $item->jenis_bencana ?? 'Semua Bencana' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                            {{ $item->status == 'AKTIF' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <button class="text-blue-500 hover:underline font-bold text-[12px]">EDIT</button>
                        <button class="text-slate-400 hover:underline font-bold text-[12px]">DETAIL</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">
                        Belum ada data fasilitas kesehatan di database lokal.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modal-tambah-faskes" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 px-4">
    <div class="bg-white rounded-2xl w-full max-w-2xl shadow-2xl overflow-hidden">
        
        <div class="bg-slate-900 px-8 py-4 flex justify-between items-center">
            <h3 class="text-white font-black uppercase tracking-widest text-sm">Tambah Pusat Kesehatan Baru</h3>
            <button type="button" onclick="document.getElementById('modal-tambah-faskes').classList.replace('flex', 'hidden')" class="text-slate-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('officer.health-centers.store') }}" method="POST" class="p-8 flex flex-col gap-5">
            @csrf
            
            <div class="flex flex-col gap-2">
                <label class="text-[11px] font-black uppercase text-slate-400">Nama Fasilitas</label>
                <input type="text" name="nama_faskes" placeholder="Contoh: RSUD Budhi Asih" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-black uppercase text-slate-400">Wilayah / Lokasi</label>
                    <input type="text" name="wilayah" placeholder="Contoh: Jakarta Timur" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-black uppercase text-slate-400">Status Operasional</label>
                    <select name="status" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500">
                        <option value="AKTIF">AKTIF</option>
                        <option value="SIAGA">SIAGA</option>
                        <option value="KRITIS">KRITIS</option>
                        <option value="NON-AKTIF">NON-AKTIF</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-[11px] font-black uppercase text-slate-400">Jenis Bencana Terkait</label>
                <input type="text" name="jenis_bencana" placeholder="Contoh: Banjir, Gempa (Opsional)"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-[11px] font-black uppercase text-slate-400">Keterangan Tambahan</label>
                <textarea name="deskripsi_bencana" rows="3" placeholder="Masukkan detail tambahan..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="document.getElementById('modal-tambah-faskes').classList.replace('flex', 'hidden')" 
                    class="px-6 py-2 text-sm font-bold text-slate-400 hover:text-slate-600">Batal</button>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-black py-2 px-8 rounded-xl shadow-lg transition-all">
                    SIMPAN DATA
                </button>
            </div>
        </form>
    </div>
</div>
@endsection