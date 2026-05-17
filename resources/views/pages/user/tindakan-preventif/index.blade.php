@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700 shadow-sm">
            <i class="fa-solid fa-circle-check"></i>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Tindakan Preventif</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola daftar tindakan pencegahan bencana yang Anda laporkan.</p>
        </div>
        <a href="{{ route('user.tindakan-preventif.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm shadow-orange-500/20">
            <i class="fa-solid fa-plus"></i>
            Tambah Catatan
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="px-4 py-4 font-bold">Waktu Tindakan</th>
                        <th scope="col" class="px-4 py-4 font-bold">Aktivitas</th>
                        <th scope="col" class="px-4 py-4 font-bold">Lokasi</th>
                        <th scope="col" class="px-4 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tindakans as $tindakan)
                        <tr class="transition-colors hover:bg-slate-50">
                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-slate-800">
                                {{ \Carbon\Carbon::parse($tindakan->waktu_tindakan)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-4 font-bold text-slate-800 max-w-xs truncate" title="{{ $tindakan->aktivitas }}">
                                {{ $tindakan->aktivitas }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                                    <span class="truncate max-w-[200px]" title="{{ $tindakan->lokasi }}">{{ $tindakan->lokasi }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('user.tindakan-preventif.show', $tindakan->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition hover:bg-blue-100" title="Detail">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('user.tindakan-preventif.edit', $tindakan->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-600 transition hover:bg-orange-100" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route('user.tindakan-preventif.destroy', $tindakan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <i class="fa-solid fa-folder-open text-xl"></i>
                                    </div>
                                    <p class="font-semibold text-slate-600">Belum ada data tindakan preventif.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 border-t border-slate-100 pt-4">
            {{ $tindakans->links() }}
        </div>
    </div>
</div>
@endsection