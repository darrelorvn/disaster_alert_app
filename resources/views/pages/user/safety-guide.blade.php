@extends('layouts.app')

@section('content')
<div class="p-8 bg-[#F8FAFC] min-h-screen">
    
    @if(isset($recommendation) && $recommendation)
    <div class="bg-orange-500 border border-slate-200 rounded-xl shadow-sm p-6 mb-8 relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-white font-bold text-xl mb-3 flex items-center gap-2">
                <i class="fa-solid fa-robot"></i> Rekomendasi AI
            </h2>
            <p class="text-white/90 leading-relaxed mb-5">{{ $recommendation->recommendation_text }}</p>
            <form method="POST" action="{{ route('user.ai-recommendation.refresh') }}" class="flex items-center gap-4">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-white text-orange-600 font-semibold text-sm rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                    Perbarui Rekomendasi
                </button>
                <span class="text-sm text-white/80 font-medium">
                    Diperbarui {{ $recommendation->generated_at->diffForHumans() }}
                </span>
            </form>
        </div>
        <i class="fa-solid fa-shield-heart absolute -right-4 -bottom-4 text-9xl text-white opacity-10"></i>
    </div>
    @endif

    <div class="w-full space-y-6">
        <div class="flex items-center space-x-3 mb-6">
            <i class="fa-solid fa-newspaper text-orange-600 text-2xl"></i>
            <h3 class="text-2xl font-black text-slate-800 uppercase">Berita Kebencanaan BNPB</h3>
        </div>

        @if(isset($news) && $news->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($news as $item)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-2.5 py-1 bg-[#FF6B00] text-[10px] font-black text-white rounded uppercase shadow-sm tracking-wider">
                                BNPB
                            </span>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <i class="fa-regular fa-clock mr-1"></i> 
                                {{ $item->created_at ? $item->created_at->diffForHumans() : 'Baru saja' }}
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 line-clamp-2 leading-tight group-hover:text-orange-600 transition-colors">
                            {{ $item->title }}
                        </h4>
                        <p class="text-sm text-slate-500 line-clamp-3 mt-3 leading-relaxed">
                            {{ $item->summary }}
                        </p>
                    </div>
                    <div class="mt-5 pt-4 border-t border-slate-50 text-right">
                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="text-[12px] font-black !text-orange-600 uppercase hover:!text-orange-700 transition-colors inline-flex items-center gap-1">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center flex flex-col items-center justify-center w-full">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-regular fa-newspaper text-2xl text-slate-400"></i>
                </div>
                <h4 class="text-slate-800 font-bold mb-1">Belum ada berita</h4>
                <p class="text-sm text-slate-500">Data berita dari BNPB belum tersedia. Pastikan proses crawling telah berjalan.</p>
            </div>
        @endif
    </div>

</div>
@endsection