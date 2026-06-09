@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
                <a href="{{ route('officer.kelola-data.laporan') }}" class="hover:text-orange-500 transition-colors">Laporan Bencana</a>
                <span class="mx-1">/</span>
                <span class="text-orange-500">Edit Laporan</span>
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Edit Laporan Bencana</h2>
        </div>
        <a href="{{ route('officer.kelola-data.laporan') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 shadow-sm">
            Kembali
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('officer.kelola-data.laporan.update', $report) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Tipe Bencana</label>
                    <select name="type" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('type') border-red-400 @enderror">
                        <option value="banjir" {{ old('type', $report->type) == 'banjir' ? 'selected' : '' }}>Banjir</option>
                        <option value="tanah_longsor" {{ old('type', $report->type) == 'tanah_longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                        <option value="kebakaran" {{ old('type', $report->type) == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                        <option value="gempa" {{ old('type', $report->type) == 'gempa' ? 'selected' : '' }}>Gempa</option>
                        <option value="angin_kencang" {{ old('type', $report->type) == 'angin_kencang' ? 'selected' : '' }}>Angin Kencang</option>
                    </select>
                    @error('type') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Status</label>
                    <select name="status" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('status') border-red-400 @enderror">
                        <option value="submitted" {{ old('status', $report->status) == 'submitted' ? 'selected' : '' }}>Darurat (Baru)</option>
                        <option value="verified" {{ old('status', $report->status) == 'verified' ? 'selected' : '' }}>Divalidasi</option>
                        <option value="in_progress" {{ old('status', $report->status) == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                        <option value="handled" {{ old('status', $report->status) == 'handled' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Nama Pelapor (Opsional)</label>
                    <input type="text" name="reporter_name" value="{{ old('reporter_name', $report->reporter_name) }}" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('reporter_name') border-red-400 @enderror">
                    @error('reporter_name') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Waktu Kejadian</label>
                    <input type="datetime-local" name="occurred_at" value="{{ old('occurred_at', \Carbon\Carbon::parse($report->occurred_at)->format('Y-m-d\TH:i')) }}" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('occurred_at') border-red-400 @enderror">
                    @error('occurred_at') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Kejadian</label>
                    <textarea name="description" rows="4" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400 focus:bg-white @error('description') border-red-400 @enderror">{{ old('description', $report->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Lokasi Teks</label>
                    <input type="text" name="location_name" id="location_name" value="{{ old('location_name', $report->location_name) }}" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400 focus:bg-white @error('location_name') border-red-400 @enderror">
                    @error('location_name') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Pilih Lokasi Peta</label>
                    <div id="mapPicker" class="w-full h-[300px] rounded-lg border border-slate-200 z-0 mb-3"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $report->latitude) }}" readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                            @error('latitude') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $report->longitude) }}" readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 outline-none">
                            @error('longitude') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Section Catatan Penanggulangan (Wajib jika status diproses/selesai) --}}
                <div id="mitigation_note_section" class="md:col-span-2 mt-4 p-5 bg-orange-50 border border-orange-200 rounded-xl hidden">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-orange-500 rounded-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        <h3 class="text-sm font-bold text-orange-900 uppercase tracking-tight">Input Catatan Penanggulangan</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Judul Tindakan <span class="text-red-500">*</span></label>
                            <input type="text" name="mitigation_title" id="mitigation_title" placeholder="Contoh: Pengiriman Logistik, Evakuasi Warga..." class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold outline-none focus:border-orange-400">
                            @error('mitigation_title') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi Penanggulangan <span class="text-red-500">*</span></label>
                            <textarea name="mitigation_description" id="mitigation_description" rows="3" placeholder="Jelaskan tindakan yang telah atau sedang dilakukan secara detail..." class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold outline-none resize-none focus:border-orange-400"></textarea>
                            @error('mitigation_description') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600 shadow-sm">Perbarui Data Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let defaultLat = {{ old('latitude', $report->latitude ?? -6.2088) }};
    let defaultLng = {{ old('longitude', $report->longitude ?? 106.8456) }};
    
    const map = L.map('mapPicker').setView([defaultLat, defaultLng], 14);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    function updateInputs(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
        
        document.getElementById('location_name').value = 'Mencari lokasi...';

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    document.getElementById('location_name').value = data.display_name;
                } else {
                    document.getElementById('location_name').value = '';
                }
            })
            .catch(() => {
                document.getElementById('location_name').value = '';
            });
    }

    marker.on('dragend', () => updateInputs(marker.getLatLng().lat, marker.getLatLng().lng));
    
    map.on('click', e => {
        marker.setLatLng(e.latlng);
        updateInputs(e.latlng.lat, e.latlng.lng);
    });

    // Logic Tampilkan Catatan Penanggulangan
    const statusSelect = document.querySelector('select[name="status"]');
    const mitigationSection = document.getElementById('mitigation_note_section');
    const mitigationTitle = document.getElementById('mitigation_title');
    const mitigationDesc = document.getElementById('mitigation_description');

    function toggleMitigationSection() {
        if (statusSelect.value === 'in_progress' || statusSelect.value === 'handled') {
            mitigationSection.classList.remove('hidden');
            mitigationTitle.setAttribute('required', 'required');
            mitigationDesc.setAttribute('required', 'required');
        } else {
            mitigationSection.classList.add('hidden');
            mitigationTitle.removeAttribute('required');
            mitigationDesc.removeAttribute('required');
        }
    }

    statusSelect.addEventListener('change', toggleMitigationSection);
    toggleMitigationSection(); // Run on load
    
    setTimeout(() => map.invalidateSize(), 300);
});
</script>
@endpush