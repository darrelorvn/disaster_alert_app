@extends('pages.officer.kelola-data.manage-data')

@section('tab_content')
<div class="p-6 flex flex-col gap-6">
    
    {{-- FILTER & TOMBOL TAMBAH --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 text-[10px] font-black tracking-wider uppercase">Filter By:</span>
            <select class="border border-slate-200 rounded-lg bg-white text-slate-700 text-xs font-bold py-1.5 px-3 focus:outline-none focus:border-orange-500 cursor-pointer">
                <option>Tipe (Semua)</option>
                <option>RS Umum</option>
                <option>Puskesmas</option>
            </select>
        </div>
        
        <button type="button" id="openModalBtn" class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-black px-4 py-2.5 rounded-xl transition-all uppercase tracking-wider flex items-center gap-1.5 self-end sm:self-auto shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Tambah Data
        </button>
    </div>

    {{-- TABEL DATA FASKES DINAMIS --}}
    <div class="w-full overflow-x-auto border border-slate-100 rounded-xl bg-white">
        <table class="w-full text-left border-collapse text-xs whitespace-nowrap">
            <thead>
                <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 font-black uppercase text-[10px] tracking-wider">
                    <th class="py-3 px-5">Nama Fasilitas</th>
                    <th class="py-3 px-5">Lokasi</th>
                    <th class="py-3 px-5 text-center">Tipe</th>
                    <th class="py-3 px-5 text-center">Status</th>
                    <th class="py-3 px-5 text-center w-[120px]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-semibold text-slate-700">
                {{-- PROSES REDUCE DATA DARI DATABASE --}}
                @forelse($healthCenters as $faskes)
                    <tr class="hover:bg-slate-50/40 transition-colors">
                        <td class="py-3.5 px-5 font-bold text-slate-900">{{ $faskes->nama_faskes }}</td>
                        <td class="py-3.5 px-5 text-slate-500">{{ $faskes->wilayah }}</td>
                        <td class="py-3.5 px-5 text-center">
                            <span class="inline-block bg-orange-50 text-orange-600 text-[10px] font-black px-2 py-0.5 rounded uppercase">
                                {{ $faskes->jenis_bencana ?? 'UMUM' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-5 text-center">
                            <span class="inline-block text-[10px] font-black px-2 py-0.5 rounded uppercase
                                {{ $faskes->status == 'AKTIF' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                {{ $faskes->status == 'SIAGA' ? 'bg-amber-50 text-amber-600' : '' }}
                                {{ $faskes->status == 'KRITIS' ? 'bg-rose-50 text-rose-600' : '' }}
                                {{ $faskes->status == 'NON-AKTIF' ? 'bg-slate-100 text-slate-600' : '' }}
                            ">
                                {{ $faskes->status }}
                            </span>
                        </td>
                        <td class="py-3.5 px-5 text-center">
                            <div class="flex justify-center gap-1.5">
                                <button type="button" class="border border-slate-200 text-slate-600 px-2.5 py-1 rounded bg-white hover:bg-slate-50 text-[10px] font-bold uppercase">Edit</button>
                                <button type="button" class="bg-slate-900 text-white px-2.5 py-1 rounded hover:bg-slate-800 text-[10px] font-bold uppercase">Detail</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{-- Tampilan kalau database lu masih bener-bener kosong --}}
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400 font-medium">
                            Belum ada data fasilitas kesehatan. Klik Tambah Data untuk mengisi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL INPUT DATA FASKES --}}
<div id="faskesInputModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-[450px] overflow-hidden">
        <div class="bg-slate-900 text-white px-6 py-4 flex justify-between items-center">
            <h5 class="text-xs font-black tracking-wider uppercase m-0">Tambah Pusat Kesehatan</h5>
            <button type="button" id="closeModalBtn" class="text-white/60 hover:text-white text-xl bg-transparent border-0 cursor-pointer focus:outline-none">&times;</button>
        </div>
        
        {{-- ROUTE ACTION MENUJU HEALTHCENTERCONTROLLER STORE --}}
        <form action="{{ route('officer.health-centers.store') }}" method="POST">
            @csrf
            <div class="p-6 flex flex-col gap-4 text-left">
                <div class="flex flex-col gap-1.5">
                    <label class="text-slate-500 font-black text-[10px] tracking-wider uppercase">Nama Fasilitas</label>
                    <input type="text" name="nama_faskes" required placeholder="Masukkan nama faskes (ex: RSUD)" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold focus:outline-none focus:border-orange-500 bg-slate-50/50">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-slate-500 font-black text-[10px] tracking-wider uppercase">Jenis Bencana Terkait</label>
                    <input type="text" name="jenis_bencana" placeholder="Contoh: Banjir, Gempa (Opsional)" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold focus:outline-none focus:border-orange-500 bg-slate-50/50">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-slate-500 font-black text-[10px] tracking-wider uppercase">Wilayah / Lokasi</label>
                    <input type="text" name="wilayah" required placeholder="Masukkan wilayah (ex: Bojongsoang)" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold focus:outline-none focus:border-orange-500 bg-slate-50/50">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-slate-500 font-black text-[10px] tracking-wider uppercase">Status Operasional</label>
                    <select name="status" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800 bg-white focus:outline-none focus:border-orange-500">
                        <option value="AKTIF">AKTIF</option>
                        <option value="SIAGA">SIAGA</option>
                        <option value="KRITIS">KRITIS</option>
                        <option value="NON-AKTIF">NON-AKTIF</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-slate-500 font-black text-[10px] tracking-wider uppercase">Deskripsi / Catatan Tambahan</label>
                    <textarea name="deskripsi_bencana" rows="3" placeholder="Keterangan faskes..." class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold resize-none focus:outline-none focus:border-orange-500 bg-slate-50/50"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2.5">
                <button type="button" id="cancelModalBtn" class="border border-slate-200 text-slate-700 font-bold text-xs px-4 py-2 rounded-lg bg-white hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="bg-orange-500 text-white font-black text-xs px-5 py-2 rounded-lg hover:bg-orange-600 transition-colors shadow-sm">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL TOGGLE SYSTEM --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('faskesInputModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelModalBtn');

        if(openBtn) {
            openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
        }
        [closeBtn, cancelBtn].forEach(btn => {
            if(btn) btn.addEventListener('click', () => modal.classList.add('hidden'));
        });
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });
    });
</script>
@endsection