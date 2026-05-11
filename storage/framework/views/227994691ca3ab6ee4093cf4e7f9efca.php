

<?php $__env->startSection('content'); ?>
<div class="flex-1 bg-[#F8FAFC] overflow-y-auto font-sans antialiased">
    
    <div class="px-12 pt-10 pb-6">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Form Laporkan Bencana</p>
        <h1 class="text-[32px] font-black text-slate-800 tracking-tighter">Laporkan Bencana</h1>
        <p class="text-sm text-slate-500 mt-1 font-medium">Laporkan kejadian bencana di sekitar Anda secara akurat.</p>
    </div>

    <div class="px-12 mb-12">
        <div class="relative flex justify-between items-center max-w-4xl mx-auto">
            <div class="absolute top-5 left-0 w-full h-[3px] bg-slate-200 -translate-y-1/2 z-0 rounded-full">
                <div class="w-1/3 h-full bg-green-600 transition-all duration-700 shadow-[0_0_10px_rgba(22,163,74,0.3)]"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-green-600 text-white flex items-center justify-center font-black shadow-xl shadow-green-200 ring-4 ring-white transition-all scale-110">1</div>
                <span class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Informasi Dasar</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white border-2 border-slate-200 text-slate-300 flex items-center justify-center font-bold">2</div>
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Lokasi Kejadian</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white border-2 border-slate-200 text-slate-300 flex items-center justify-center font-bold">3</div>
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Bukti Visual</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white border-2 border-slate-200 text-slate-300 flex items-center justify-center font-bold">4</div>
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Selesai</span>
            </div>
        </div>
    </div>

    <div class="px-12 grid grid-cols-12 gap-10 max-w-7xl mx-auto pb-20">
        
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-[40px] shadow-[0_30px_80px_rgba(0,0,0,0.03)] border border-slate-50 overflow-hidden">
                
                <div class="p-6 bg-[#FFF8F5] border border-orange-100 flex items-start gap-5 mx-8 mt-8 rounded-[28px]">
                    <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-500 shadow-sm">
                        <i class="fas fa-bullhorn text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-[15px] font-black text-slate-800 tracking-tight">Informasi Laporan</h3>
                        <p class="text-[12px] text-slate-500 leading-relaxed mt-1 font-medium italic">Sertakan informasi bencana yang Anda temui secara detail agar mempercepat penanganan.</p>
                    </div>
                </div>

                <form action="#" class="p-10 space-y-10">
                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-[0.25em] mb-4">Jenis Bencana</label>
                        <div class="relative group">
                            <select class="w-full bg-slate-50 border-none rounded-[22px] px-8 py-5 text-[13px] font-black text-slate-700 appearance-none focus:ring-4 focus:ring-orange-500/10 transition-all cursor-pointer">
                                <option value="" disabled selected>Pilih jenis bencana</option>
                                <option value="banjir">Banjir & Arus Tinggi</option>
                                <option value="kebakaran">Zona Kebakaran</option>
                                <option value="gempa">Gempa Bumi</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-8 top-1/2 -translate-y-1/2 text-slate-300 text-xs pointer-events-none group-hover:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-[0.25em] mb-4">Tanggal Kejadian</label>
                            <input type="date" class="w-full bg-slate-50 border-none rounded-[22px] px-8 py-5 text-[13px] font-black text-slate-700 focus:ring-4 focus:ring-orange-500/10 transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-[0.25em] mb-4">Waktu (WIB)</label>
                            <input type="time" class="w-full bg-slate-50 border-none rounded-[22px] px-8 py-5 text-[13px] font-black text-slate-700 focus:ring-4 focus:ring-orange-500/10 transition-all">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-[10px] font-black text-slate-300 uppercase tracking-[0.25em]">Deskripsi Kejadian</label>
                            <span class="text-[10px] font-black text-slate-200">0/500</span>
                        </div>
                        <textarea rows="7" placeholder="Ceritakan detail kejadian secara singkat dan jelas..." 
                            class="w-full bg-slate-50 border-none rounded-[32px] px-8 py-6 text-[13px] font-bold text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-orange-500/10 transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="bg-[#FF7F3E] text-white px-12 py-5 rounded-[22px] font-black text-[11px] uppercase tracking-[0.2em] shadow-2xl shadow-orange-200 hover:bg-[#e66a2e] hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-4">
                            Lanjut Ke Lokasi <i class="fas fa-arrow-right text-[9px]"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="bg-[#FF7F3E] rounded-[40px] p-10 text-white shadow-[0_25px_60px_rgba(255,127,62,0.25)] relative overflow-hidden group">
                <div class="absolute -right-16 -top-16 w-56 h-56 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
                
                <h2 class="text-2xl font-black tracking-tight mb-5 relative z-10">Penting!</h2>
                <p class="text-[13px] font-bold leading-relaxed text-orange-50/80 relative z-10 mb-10">
                    Pastikan informasi yang Anda berikan benar dan akurat untuk mempermudah proses evakuasi dan penanganan oleh tim Sentinel.
                </p>

                <div class="absolute bottom-[-20px] right-[-10px] opacity-10 text-[140px] transform -rotate-12 transition-transform group-hover:rotate-0 duration-700">
                    <i class="fas fa-shield-alt text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\disaster_alert_app\disaster_alert_app\resources\views/pages/user/report-disaster.blade.php ENDPATH**/ ?>