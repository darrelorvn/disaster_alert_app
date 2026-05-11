@extends('layouts.app')

@section('content')
<div class=" p-8 font-sans text-slate-600">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900">Profil Petugas</h1>
        <p class="mt-2 text-slate-500">Kelola informasi pribadi, identitas kedinasan, dan preferensi operasional sistem keamanan Sentinel Anda secara terpadu.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
        
        <div class="lg:col-span-8 space-y-8">
            <div class="relative overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-sm">
                <div class="h-32 bg-gradient-to-r from-orange-400 to-orange-500"></div>
                
                <div class="relative px-8 pb-10">
                    <div class="flex flex-col items-center gap-6 -mt-16 md:flex-row md:items-end">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Subarjo&background=f97316&color=fff&size=128" 
                                alt="Foto Profil" 
                                class="h-32 w-32 rounded-2xl border-4 border-white object-cover shadow-md">
                            <button class="absolute -bottom-2 -right-2 flex h-10 w-10 items-center justify-center rounded-full bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 shadow-sm transition-colors">
                                <i class="fa-solid fa-camera text-sm"></i>
                            </button>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h2 class="text-3xl font-bold text-slate-900 flex items-center justify-center md:justify-start gap-3">
                                Bripka Ahmad Subarjo 
                            </h2>
                            <p class="text-slate-500 font-medium uppercase tracking-wider text-sm mt-1">Senior Field Officer • Public Safety Command Center</p>
                        </div>
                    </div>

                    <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Nama Lengkap</label>
                            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <i class="fa-solid fa-user text-slate-400"></i>
                                <span class="font-semibold text-slate-800">Bripka Ahmad Subarjo</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">NIP / ID Staff</label>
                            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <i class="fa-solid fa-id-card text-slate-400"></i>
                                <span class="font-semibold text-slate-800">19840512 201012 1 004</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Instansi Terkait</label>
                            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <i class="fa-solid fa-building-shield text-slate-400"></i>
                                <span class="font-semibold text-slate-800">POLRI (Kepolisian Negara Republik Indonesia)</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Jabatan / Role</label>
                            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <i class="fa-solid fa-user-gear text-slate-400"></i>
                                <span class="font-semibold text-slate-800">Field Supervisor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-sm">
                    <div class="mb-6 flex items-center gap-3 text-slate-900">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <h3 class="text-xl font-bold">Pengaturan Keamanan</h3>
                    </div>
                    <div class="space-y-4">
                        <button class="group flex w-full items-center justify-between rounded-2xl bg-slate-50 p-4 transition hover:bg-slate-100 border border-transparent hover:border-slate-200">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-envelope text-slate-400 group-hover:text-orange-500 transition-colors"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Ubah Email / No Telpon</p>
                                    <p class="text-xs text-slate-500">Kelola identitas kontak akun Anda</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-xs text-slate-400 group-hover:text-slate-600 transition-all"></i>
                        </button>
                        <button class="group flex w-full items-center justify-between rounded-2xl bg-slate-50 p-4 transition hover:bg-slate-100 border border-transparent hover:border-slate-200">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-key text-slate-400 group-hover:text-orange-500 transition-colors"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Ganti Password Akun</p>
                                    <p class="text-xs text-slate-500">Perbarui kata sandi secara berkala</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-xs text-slate-400 group-hover:text-slate-600 transition-all"></i>
                        </button>
                        <div class="flex w-full items-center justify-between rounded-2xl bg-slate-50 p-4 border border-slate-100">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-shield-halved text-green-500"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Autentikasi 2FA</p>
                                    <p class="text-xs text-green-600 font-medium">Direkomendasikan & Aktif</p>
                                </div>
                            </div>
                            <label class="relative inline-flex cursor-pointer items-center">
                                <input type="checkbox" checked class="peer sr-only">
                                <div class="h-6 w-11 rounded-full bg-slate-300 after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow-sm after:transition-all after:content-[''] peer-checked:bg-green-500 peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-sm">
                    <div class="mb-6 flex items-center gap-3 text-slate-900">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <h3 class="text-xl font-bold">Notifikasi Internal</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex w-full items-center justify-between rounded-2xl bg-slate-50 p-4 border border-slate-100">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-filter text-slate-400"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Filter Alert Priority</p>
                                    <p class="text-xs text-slate-500">Hanya alert level Siaga/Awas</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-orange-600 px-2 py-1 rounded bg-orange-100">All System Alerts</span>
                        </div>
                        <div class="flex w-full items-center justify-between rounded-2xl bg-slate-50 p-4 border border-slate-100">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-volume-high text-slate-400"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Sound Settings</p>
                                    <p class="text-xs text-slate-500">Bunyi alarm untuk laporan baru</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-volume-low text-slate-400"></i>
                        </div>
                        <div class="flex w-full items-center justify-between rounded-2xl bg-orange-50 p-4 border border-orange-200">
                            <div class="flex items-center gap-4 text-left">
                                <i class="fa-solid fa-rotate text-orange-500 animate-spin-slow"></i>
                                <div>
                                    <p class="text-sm font-bold text-orange-600">Konfigurasi Sinkronisasi</p>
                                    <p class="text-xs text-orange-600/80">Terhubung ke Server Command Center</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-dot text-orange-500 text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">
            <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-sm">
                <div class="mb-6 flex items-center gap-4">
                    <div class="h-16 w-16 flex items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-headset text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Bantuan & Dukungan</h3>
                        <p class="text-sm text-slate-500">Layanan support petugas 24/7</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <button class="group flex w-full items-center gap-4 rounded-2xl bg-slate-50 p-5 transition hover:bg-slate-100 border border-transparent hover:border-slate-200">
                        <i class="fa-solid fa-book-open text-slate-400 group-hover:text-orange-500"></i>
                        <div class="text-left">
                            <p class="text-sm font-bold text-slate-800">Panduan SOP</p>
                            <p class="text-xs text-slate-500">Standard Operating Procedure</p>
                        </div>
                    </button>
                    <button class="group flex w-full items-center gap-4 rounded-2xl bg-slate-50 p-5 transition hover:bg-slate-100 border border-transparent hover:border-slate-200">
                        <i class="fa-solid fa-user-shield text-slate-400 group-hover:text-orange-500"></i>
                        <div class="text-left">
                            <p class="text-sm font-bold text-slate-800">Hubungi Admin</p>
                            <p class="text-xs text-slate-500">Technical Helpdesk Center</p>
                        </div>
                    </button>
                </div>
            </div>

            <div class="rounded-3xl bg-red-50 p-8 border border-red-100 shadow-sm">
                <h4 class="text-lg font-bold text-red-600 mb-2">Akhiri Sesi Operasional</h4>
                <p class="text-sm text-red-500/80 mb-6">Pastikan seluruh laporan saat ini telah tersimpan sebelum keluar dari sistem.</p>
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-2xl bg-red-600 px-6 py-4 font-bold text-white transition hover:bg-red-700 shadow-md shadow-red-600/20">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout dari Sistem
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }
</style>
@endsection