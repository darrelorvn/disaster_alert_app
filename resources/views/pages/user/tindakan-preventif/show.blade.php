@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    {{-- Header --}}
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('user.tindakan-preventif.index') }}" class="hover:text-orange-500 transition-colors">Tindakan Preventif</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Detail Catatan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Detail Tindakan Preventif</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap tindakan pencegahan bencana yang telah dicatat.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('user.tindakan-preventif.edit', $tindakanPreventif->id) }}"
                class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm shadow-orange-500/20">
                <i class="fa-solid fa-pen"></i>
                Edit
            </a>
            <a href="{{ route('user.tindakan-preventif.index') }}"
                class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_320px]">

        {{-- Kolom Kiri: Info Utama --}}
        <div class="flex flex-col gap-6">

            {{-- Card Informasi --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Tindakan</h3>

                <div class="flex flex-col gap-5">

                    {{-- Aktivitas --}}
                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Aktivitas</p>
                        <p class="text-base font-bold text-slate-800">{{ $tindakanPreventif->aktivitas }}</p>
                    </div>

                    <div class="border-t border-slate-100"></div>

                    {{-- Deskripsi --}}
                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Deskripsi</p>
                        <p class="text-sm font-semibold text-slate-600 leading-relaxed whitespace-pre-line">{{ $tindakanPreventif->deskripsi }}</p>
                    </div>

                    <div class="border-t border-slate-100"></div>

                    {{-- Waktu & Lokasi --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Waktu Tindakan</p>
                            <div class="flex items-center gap-2 text-sm font-bold text-slate-700">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-calendar text-xs"></i>
                                </span>
                                {{ \Carbon\Carbon::parse($tindakanPreventif->waktu_tindakan)->format('d M Y, H:i') }} WIB
                            </div>
                        </div>
                        <div>
                            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Lokasi</p>
                            @if($tindakanPreventif->lokasi)
                                <div class="flex items-center gap-2 text-sm font-bold text-slate-700">
                                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-500">
                                        <i class="fa-solid fa-location-dot text-xs"></i>
                                    </span>
                                    {{ $tindakanPreventif->lokasi }}
                                </div>
                            @else
                                <p class="text-sm font-semibold text-slate-400 italic">Lokasi tidak dicantumkan</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card Foto Bukti --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-xs font-bold uppercase tracking-wider text-slate-400">Foto Bukti</h3>

                @if($tindakanPreventif->foto)
                    <div class="overflow-hidden rounded-xl border border-slate-100">
                        <img
                            src="{{ Storage::url($tindakanPreventif->foto) }}"
                            alt="Foto bukti tindakan preventif"
                            class="w-full max-h-[420px] object-cover cursor-pointer transition hover:opacity-95"
                            onclick="bukaFotoModal(this.src)">
                    </div>
                    <p class="mt-2.5 text-[11px] font-semibold text-slate-400 text-center">
                        <i class="fa-solid fa-magnifying-glass mr-1"></i>
                        Klik gambar untuk memperbesar
                    </p>
                @else
                    <div class="flex flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 py-12">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <i class="fa-solid fa-image text-xl"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-400">Tidak ada foto bukti yang dilampirkan.</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- Kolom Kanan: Metadata & Aksi --}}
        <div class="flex flex-col gap-6">

            {{-- Card Metadata --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-xs font-bold uppercase tracking-wider text-slate-400">Metadata</h3>

                <div class="flex flex-col gap-4">
                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Dicatat Oleh</p>
                        <div class="flex items-center gap-2.5">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-orange-600 text-xs font-black">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-700">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] font-semibold text-slate-400">Masyarakat</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100"></div>

                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Tanggal Dibuat</p>
                        <p class="text-sm font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($tindakanPreventif->created_at)->format('d M Y, H:i') }} WIB
                        </p>
                    </div>

                    <div class="border-t border-slate-100"></div>

                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Terakhir Diperbarui</p>
                        <p class="text-sm font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($tindakanPreventif->updated_at)->format('d M Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>

            {{-- Card Aksi Berbahaya --}}
            <div class="rounded-xl border border-red-100 bg-red-50/50 p-6 shadow-sm">
                <h3 class="mb-1 text-xs font-bold uppercase tracking-wider text-red-400">Zona Berbahaya</h3>
                <p class="mb-4 text-xs font-semibold text-red-400/80">Tindakan berikut tidak dapat dibatalkan.</p>

                <form action="{{ route('user.tindakan-preventif.destroy', $tindakanPreventif->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini? Tindakan ini tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white hover:border-red-600">
                        <i class="fa-solid fa-trash"></i>
                        Hapus Catatan Ini
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Modal Foto --}}
<div id="foto-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4 backdrop-blur-sm" onclick="tutupFotoModal()">
    <div class="relative max-h-[90vh] max-w-4xl w-full" onclick="event.stopPropagation()">
        <button onclick="tutupFotoModal()"
            class="absolute -top-3 -right-3 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg transition hover:bg-slate-100">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
        <img id="foto-modal-img" src="" alt="Foto bukti diperbesar"
            class="w-full max-h-[90vh] rounded-xl object-contain shadow-2xl">
    </div>
</div>
@endsection

@push('scripts')
<script>
    function bukaFotoModal(src) {
        const modal = document.getElementById('foto-modal');
        const img   = document.getElementById('foto-modal-img');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function tutupFotoModal() {
        const modal = document.getElementById('foto-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') tutupFotoModal();
    });
</script>
@endpush