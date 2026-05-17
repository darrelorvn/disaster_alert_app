@extends('layouts.app')

@section('content')
<div class="p-8 bg-[#F8FAFC] min-h-screen">
    
    <div class="mb-10 bg-white rounded-2xl p-6 flex items-start border-l-[6px] border-orange-500 shadow-sm">
        <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center mr-5 text-white flex-shrink-0 shadow-lg shadow-orange-100">
            <i class="fa-solid fa-robot text-2xl"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-800">Rekomendasi Aman (AI)</h2>
            <p class="text-[15px] text-slate-500 mt-1">
                Status wilayah Anda saat ini <span class="font-bold text-orange-600 uppercase">WASPADA BANJIR</span>. Siapkan tas siaga bencana dan amankan dokumen penting ke tempat yang lebih tinngi
            </p>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fa-solid fa-newspaper text-orange-600 text-xl"></i>
                <h3 class="text-2xl font-black text-slate-800 uppercase">Berita Terkini</h3>
            </div>

          @foreach(range(1, 4) as $index)
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden flex h-44 shadow-sm hover:shadow-md transition-all">
    <div class="w-60 h-full flex-shrink-0 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600" class="w-full h-full object-cover">
        
        @if($index == 2 || $index == 4)
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-[#00A9B5] text-[9px] font-black text-white rounded uppercase shadow-md">
                INFO
            </span>
        @else
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-[#FF6B00] text-[9px] font-black text-white rounded uppercase shadow-md">
                WASPADA
            </span>
        @endif
    </div>

    <div class="p-6 flex flex-col justify-between flex-1">
        <div>
            <h4 class="text-lg font-bold text-slate-800 line-clamp-1">Peningkatan Debit Air Sungai Ciliwung Malam Ini</h4>
            <p class="text-sm text-slate-500 line-clamp-2 mt-1">Laporan terbaru menunjukkan debit air sungai meningkat signifikan akibat curah hujan tinggi...</p>
        </div>
        <div class="flex items-center justify-between mt-4">
            <span class="text-[10px] font-bold text-slate-400">2 JAM YANG LALU</span>
            <a href="#" class="text-[11px] font-black !text-orange-600 uppercase hover:!text-orange-700 transition-colors">
                Baca Selengkapnya →
            </a>
        </div>
    </div>
</div>
@endforeach
        </div>

        <div class="w-full lg:w-1/3 space-y-6">
    <div class="flex items-center space-x-3 mb-6"> 
    
    <i class="fa-solid fa-video text-orange-800 text-xl flex-shrink-0"></i>
    
    <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Tutorial</h3>
</div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm group cursor-pointer">
        <div class="relative aspect-video">
            <img src="https://images.unsplash.com/photo-1516738901171-8eb4fc13bd20?q=80&w=600" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-orange-600 shadow-xl">
                    <i class="fa-solid fa-play ml-1"></i>
                </div>
            </div>
            <span class="absolute bottom-3 right-3 bg-black/80 text-white text-[10px] px-2 py-1 font-bold rounded">04:20</span>
        </div>
        <div class="p-4 border-t border-slate-50">
            <h4 class="font-bold text-slate-800 text-sm group-hover:text-orange-600 transition-colors">Cara Menggunakan Pelampung Darurat</h4>
            <p class="text-[11px] text-slate-500 mt-1">Panduan praktis evakuasi air</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm group cursor-pointer">
        <div class="relative aspect-video">
            <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?q=80&w=600" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-orange-600 shadow-xl">
                    <i class="fa-solid fa-play ml-1"></i>
                </div>
            </div>
            <span class="absolute bottom-3 right-3 bg-black/80 text-white text-[10px] px-2 py-1 font-bold rounded">08:15</span>
        </div>
        <div class="p-4 border-t border-slate-50">
            <h4 class="font-bold text-slate-800 text-sm group-hover:text-orange-600 transition-colors">P3K Dasar Saat Gempa Bumi</h4>
            <p class="text-[11px] text-slate-500 mt-1">Langkah pertama penanganan cidera</p>
        </div>
    </div>
</div>

    </div>
</div>
@endsection