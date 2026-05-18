@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #reportMap { height: 280px; width: 100%; border-radius: 12px; background: #f8fafc; }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-50 p-6 md:p-8 font-sans text-slate-800">

    {{-- Header --}}
    <div class="mb-6">
        <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">
            <a href="{{ route('user.home') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-orange-500">Laporkan Bencana</span>
        </p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-800">Laporkan Bencana</h1>
        <p class="text-sm text-slate-500 mt-1">Laporkan kejadian bencana di sekitar Anda secara akurat dan lengkap.</p>
    </div>

    {{-- Pesan Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 flex items-start gap-3">
            <i class="fa-solid fa-circle-check text-green-600 mt-0.5"></i>
            <div>
                <h3 class="text-sm font-bold text-green-800">Berhasil!</h3>
                <p class="text-xs font-semibold text-green-700 mt-1">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Pesan Error Validasi Laravel --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 flex items-start gap-3">
            <i class="fa-solid fa-triangle-exclamation text-red-600 mt-0.5"></i>
            <div>
                <h3 class="text-sm font-bold text-red-800">Gagal Mengirim Laporan</h3>
                <ul class="text-xs font-semibold text-red-700 mt-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_300px]">

        {{-- Kolom Kiri: Form --}}
        <div class="flex flex-col gap-6">

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                {{-- FORM STANDARD PHP --}}
                <form id="reportForm" action="{{ route('user.laporan-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Input Hidden untuk menyatukan tanggal dan waktu sebelum submit --}}
                    <input type="hidden" name="occurred_at" id="occurred_at_hidden">

                    <div class="flex flex-col gap-8">
                        {{-- ===== SEKSI 1: INFORMASI DASAR ===== --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">1</div>
                                <h2 class="text-sm font-bold text-slate-700">Informasi Dasar</h2>
                            </div>

                            <div class="flex flex-col gap-5">
                                <div>
                                    <label for="type" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Jenis Bencana <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select id="type" name="type" required class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10">
                                            <option value="" disabled selected>Pilih jenis bencana</option>
                                            <option value="flood">Banjir & Arus Tinggi</option>
                                            <option value="landslide">Tanah Longsor</option>
                                            <option value="fire">Kebakaran</option>
                                            <option value="earthquake">Gempa Bumi</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="date" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                            Tanggal Kejadian <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" id="date" required max="{{ now()->format('Y-m-d') }}" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10">
                                    </div>
                                    <div>
                                        <label for="time" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                            Waktu Kejadian <span class="text-red-500">*</span>
                                        </label>
                                        <input type="time" id="time" required class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10">
                                    </div>
                                </div>

                                <div>
                                    <div class="mb-1.5 flex items-center justify-between">
                                        <label for="description" class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                            Deskripsi Kejadian <span class="text-red-500">*</span>
                                        </label>
                                        <span id="charCount" class="text-[10px] font-bold text-slate-400">0/500</span>
                                    </div>
                                    <textarea id="description" name="description" required rows="5" maxlength="500" placeholder="Ceritakan detail kejadian secara singkat..." class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 placeholder:font-normal outline-none transition focus:border-orange-400 focus:bg-white focus:ring-2 focus:ring-orange-500/10">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100"></div>

                        {{-- ===== SEKSI 2: LOKASI KEJADIAN ===== --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">2</div>
                                <h2 class="text-sm font-bold text-slate-700">Lokasi Kejadian</h2>
                            </div>

                            <div class="flex flex-col gap-4">
                                <button type="button" id="btn-deteksi-lokasi" class="inline-flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-orange-200 bg-orange-50 px-4 py-3 text-sm font-bold text-orange-600 transition hover:border-orange-400 hover:bg-orange-100">
                                    <i class="fa-solid fa-location-crosshairs"></i> Gunakan Lokasi Saya Sekarang
                                </button>

                                <div id="lokasi-status" class="hidden items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm shrink-0"></i>
                                    <p id="lokasi-status-text" class="text-xs font-bold text-emerald-700"></p>
                                </div>

                                <div id="reportMap" class="z-0"></div>
                                <p class="text-[11px] font-semibold text-slate-400 text-center -mt-1">
                                    <i class="fa-solid fa-hand-pointer mr-1"></i> Klik di peta untuk menyesuaikan titik lokasi manual
                                </p>

                                <div>
                                    <label for="location_name" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Alamat / Keterangan Lokasi <span class="text-slate-400 text-[10px] normal-case font-semibold">(terisi otomatis)</span>
                                    </label>
                                    <div class="relative">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                            <i class="fa-solid fa-location-dot text-xs"></i>
                                        </span>
                                        <input type="text" id="alamat" name="location_name" readonly placeholder="Alamat akan terisi otomatis setelah titik dipilih..." class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 outline-none">
                                    </div>
                                </div>

                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                            </div>
                        </div>

                        <div class="border-t border-slate-100"></div>

                        {{-- ===== SEKSI 3: BUKTI VISUAL ===== --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white text-xs font-black">3</div>
                                <h2 class="text-sm font-bold text-slate-700">Bukti Visual</h2>
                            </div>

                            <div class="flex flex-col gap-4">
                                <label for="foto" class="group flex cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center transition hover:border-orange-400 hover:bg-orange-50/40" id="foto-dropzone">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 transition group-hover:bg-orange-100 group-hover:text-orange-500">
                                        <i class="fa-solid fa-camera text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-600 group-hover:text-orange-600 transition">Unggah foto bukti kejadian</p>
                                        <p class="mt-0.5 text-xs text-slate-400">PNG, JPG, atau JPEG — Maks. 5 MB</p>
                                    </div>
                                    {{-- Mengubah nama field agar mendukung request array --}}
                                    <input type="file" id="foto" name="photos[]" accept="image/png,image/jpg,image/jpeg" class="sr-only" onchange="previewFoto(this)">
                                </label>

                                <div id="foto-preview-wrapper" class="hidden">
                                    <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white p-3">
                                        <img id="foto-preview-img" src="" alt="Preview foto" class="h-16 w-16 rounded-lg object-cover border border-slate-100 shrink-0">
                                        <div class="min-w-0 flex-1">
                                            <p id="foto-preview-name" class="truncate text-xs font-bold text-slate-700"></p>
                                            <p id="foto-preview-size" class="text-[10px] text-slate-400 font-semibold mt-0.5"></p>
                                        </div>
                                        <button type="button" onclick="hapusFoto()" class="shrink-0 flex h-7 w-7 items-center justify-center rounded-full bg-red-50 text-red-500 transition hover:bg-red-100">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100"></div>

                        {{-- Tombol Submit --}}
                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('user.home') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                                Batal
                            </a>
                            <button type="submit" id="submitBtn" class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm shadow-orange-500/20 transition hover:bg-orange-600">
                                <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Panduan --}}
        <div class="flex flex-col gap-4">
            <div class="rounded-xl bg-orange-500 p-6 text-white shadow-sm shadow-orange-500/20">
                <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-white/20">
                    <i class="fa-solid fa-triangle-exclamation text-white"></i>
                </div>
                <h3 class="mb-2 text-sm font-bold">Penting!</h3>
                <p class="text-xs font-semibold leading-relaxed text-orange-100">
                    Pastikan informasi yang Anda berikan benar dan akurat untuk mempercepat penanganan oleh tim Sentinel.
                </p>
            </div>
            
            <div class="rounded-xl border border-red-100 bg-red-50/50 p-6 shadow-sm">
                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-red-400">Darurat Medis?</h3>
                <a href="tel:119" class="flex items-center justify-between rounded-lg bg-white border border-red-100 px-4 py-2.5 transition hover:border-red-300">
                    <span class="text-xs font-bold text-slate-700">Ambulans / BPBD</span>
                    <span class="text-sm font-black text-red-500">119</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // ===== PETA & DETEKSI LOKASI =====
    const defaultLat = -6.2088;
    const defaultLng = 106.8456;
    const map = L.map('reportMap').setView([defaultLat, defaultLng], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);
    const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    marker.on('dragend', function () {
        const pos = marker.getLatLng();
        updateKoordinat(pos.lat, pos.lng);
        reverseGeocode(pos.lat, pos.lng);
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        updateKoordinat(e.latlng.lat, e.latlng.lng);
        reverseGeocode(e.latlng.lat, e.latlng.lng);
    });

    function updateKoordinat(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    function reverseGeocode(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
            .then(res => res.json())
            .then(data => { if (data && data.display_name) document.getElementById('alamat').value = data.display_name; })
            .catch(() => {});
    }

    document.getElementById('btn-deteksi-lokasi').addEventListener('click', function () {
        const btn = this;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi lokasi...';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const lat = position.coords.latitude, lng = position.coords.longitude;
                map.setView([lat, lng], 16);
                marker.setLatLng([lat, lng]);
                updateKoordinat(lat, lng);
                reverseGeocode(lat, lng);

                btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Lokasi Terdeteksi';
                btn.classList.replace('text-orange-600', 'text-emerald-600');
            },
            function () {
                alert('Gagal mendeteksi lokasi. Pastikan izin lokasi aktif.');
                btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> Gunakan Lokasi Saya';
                btn.disabled = false;
            },
            { enableHighAccuracy: true }
        );
    });

    // ===== CHAR COUNT =====
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    textarea.addEventListener('input', function () { charCount.textContent = `${this.value.length}/500`; });

    // ===== PREVIEW FOTO =====
    function previewFoto(input) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => { document.getElementById('foto-preview-img').src = e.target.result; };
        reader.readAsDataURL(file);

        document.getElementById('foto-preview-name').textContent = file.name;
        document.getElementById('foto-preview-size').textContent = (file.size / 1024).toFixed(1) + ' KB';
        document.getElementById('foto-preview-wrapper').classList.remove('hidden');
        document.getElementById('foto-dropzone').classList.add('hidden');
    }

    function hapusFoto() {
        document.getElementById('foto').value = '';
        document.getElementById('foto-preview-wrapper').classList.add('hidden');
        document.getElementById('foto-dropzone').classList.remove('hidden');
    }

    // ===== NATIVE FORM SUBMIT INTERCEPT =====
    const form = document.getElementById('reportForm');
    form.addEventListener('submit', function (e) {
        // Gabungkan tanggal dan waktu ke dalam hidden input 'occurred_at' sebelum form terkirim
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        document.getElementById('occurred_at_hidden').value = `${date} ${time}:00`;
    });

    setTimeout(() => map.invalidateSize(), 300);
</script>
@endpush