@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('officer.kelola-data.penanggulangan.index') }}" class="hover:text-orange-500 transition-colors">Catatan Penanggulangan</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Buat Catatan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Tambah Catatan Baru</h2>
        </div>
        <a href="{{ route('officer.kelola-data.penanggulangan.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            Kembali
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('officer.kelola-data.penanggulangan.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                
                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Judul Catatan</label>
                    <input type="text" name="title" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('title') border-red-400 @enderror" value="{{ old('title') }}">
                    @error('title') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Hubungkan dengan Kejadian Bencana (Opsional)</label>
                    <select name="disaster_event_id" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white">
                        <option value="">-- Tidak Terhubung ke Kejadian Spesifik --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ strtoupper($event->type) }} - {{ $event->title }} ({{ $event->occurred_at->format('d M Y') }})</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-[10px] text-slate-400 font-medium">Memungkinkan Anda melacak tindakan ini di riwayat bencana tersebut.</p>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tipe Bencana</label>
                    <select name="disaster_type" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white">
                        <option value="banjir">Banjir</option>
                        <option value="tanah_longsor">Tanah Longsor</option>
                        <option value="kebakaran">Kebakaran</option>
                        <option value="gempa">Gempa</option>
                        <option value="angin_kencang">Angin Kencang</option>
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Area Terdampak</label>
                    <input type="text" name="affected_area" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white" value="{{ old('affected_area') }}">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal Tindakan</label>
                    <input type="date" name="action_date" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white" value="{{ old('action_date', date('Y-m-d')) }}">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Penanggulangan</label>
                    <textarea name="description" rows="5" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400 focus:bg-white">{{ old('description') }}</textarea>
                </div>

            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">Simpan Catatan</button>
            </div>
        </form>
    </div>
</div>
@endsection