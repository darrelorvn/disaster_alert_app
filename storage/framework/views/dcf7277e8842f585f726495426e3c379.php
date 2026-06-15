

<?php $__env->startSection('content'); ?>
<div class="p-8 bg-[#F8FAFC] min-h-screen">
    
    <?php if(isset($recommendation) && $recommendation): ?>
    <div class="bg-orange-500 border border-slate-200 rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-white font-bold mb-2">Rekomendasi AI</h2>
        <p><?php echo e($recommendation->recommendation_text); ?></p>
        <form method="POST" action="<?php echo e(route('user.ai-recommendation.refresh')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="mt-4 px-4 py-2 bg-white text-orange-500 rounded-lg transition">Perbarui Rekomendasi</button>
            <span class="text-sm text-white mt-4 inline-block ml-4"><?php echo e($recommendation->generated_at->diffForHumans()); ?></span>
        </form>
    </div>
    <?php endif; ?>

    <div class="flex flex-col lg:flex-row gap-10">
        
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fa-solid fa-newspaper text-orange-600 text-xl"></i>
                <h3 class="text-2xl font-black text-slate-800 uppercase">Berita Terkini</h3>
            </div>

          <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden flex h-44 shadow-sm hover:shadow-md transition-all">
    <div class="w-60 h-full flex-shrink-0 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600" class="w-full h-full object-cover">
        
        <?php if($index == 2 || $index == 4): ?>
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-[#00A9B5] text-[9px] font-black text-white rounded uppercase shadow-md">
                INFO
            </span>
        <?php else: ?>
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-[#FF6B00] text-[9px] font-black text-white rounded uppercase shadow-md">
                WASPADA
            </span>
        <?php endif; ?>
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH Z:\internet_download\Kuliah Alif\SEMESTER 4\MANPROSI\disaster_alert_app\resources\views/pages/user/safety-guide.blade.php ENDPATH**/ ?>