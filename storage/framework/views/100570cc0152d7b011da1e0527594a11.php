<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Personal Stock']); ?>

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">My Personal Stock</h1>
            <p class="text-sm font-medium text-gray-500 mt-1">Manage local inventory acquired from HQ</p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="<?php echo e(route('reseller.orders.create')); ?>"
               class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-black hover:bg-gray-900
                      text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Restock Inventory</span>
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
        <?php $__empty_1 = true; $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex items-center gap-5 transition-all duration-300 hover:shadow-md relative overflow-hidden group">
                <div class="w-14 h-14 rounded-2xl <?php echo e($stock->quantity <= 5 ? 'bg-amber-500 shadow-amber-500/20' : 'bg-violet-500 shadow-violet-500/20'); ?> flex items-center justify-center text-white shrink-0 shadow-lg transition-colors">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest truncate"><?php echo e($stock->product->sku); ?> &middot; <?php echo e($stock->product->volume_ml); ?>ml</p>
                        <?php if($stock->quantity <= 5): ?>
                             <span class="px-1.5 py-0.5 bg-amber-50 text-amber-600 text-[8px] font-black uppercase tracking-widest rounded border border-amber-100">Low</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-[15px] font-bold text-gray-900 truncate mb-2"><?php echo e($stock->product->name); ?></p>
                    
                    <div class="flex items-baseline gap-2">
                        <p class="text-2xl font-bold <?php echo e($stock->quantity <= 5 ? 'text-amber-600' : 'text-gray-900'); ?> tracking-tight leading-none"><?php echo e($stock->quantity); ?></p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Available</p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-16 text-center">
                <div class="mx-auto w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-5 border border-gray-100 shadow-sm">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
                <p class="text-lg font-bold text-gray-900 mb-1 tracking-tight">Your warehouse is empty</p>
                <p class="text-[13px] font-medium text-gray-500 mt-1">Order stock from HQ to start generating sales.</p>
                <div class="mt-8">
                     <a href="<?php echo e(route('reseller.orders.create')); ?>" class="px-8 py-3 bg-black text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-gray-900 transition-all duration-300 shadow-xl shadow-black/10">Restock Now &rarr;</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if($stocks->hasPages()): ?>
        <div class="mb-6">
            <?php echo e($stocks->links()); ?>

        </div>
    <?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/reseller/stock/index.blade.php ENDPATH**/ ?>