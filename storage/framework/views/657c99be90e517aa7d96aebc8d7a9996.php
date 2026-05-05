<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Wholesale Orders']); ?>

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-black text-gray-900 tracking-tight uppercase">Wholesale Orders</h1>
            <p class="text-[12px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Past stock purchases from HQ</p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="<?php echo e(route('reseller.orders.create')); ?>"
               class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-black hover:bg-gray-900
                      text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Restock Inventory</span>
            </a>
        </div>
    </div>

    
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden mb-12">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100/80">
                        <th class="text-left px-7 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Order Ref</th>
                        <th class="text-left px-7 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Date & Time</th>
                        <th class="text-center px-7 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Items</th>
                        <th class="text-right px-7 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Value</th>
                        <th class="text-center px-7 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-7 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50/80">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50/60 transition-colors duration-100">
                            <td class="px-7 py-4.5">
                                <span class="font-mono text-[13px] bg-gray-100/80 px-2 py-0.5 rounded border border-gray-200/50 text-gray-500 font-medium tracking-wider">#<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></span>
                            </td>
                            <td class="px-7 py-4.5 whitespace-nowrap">
                                <p class="text-[13px] font-medium text-gray-900"><?php echo e($order->created_at->format('d M Y')); ?></p>
                                <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mt-0.5"><?php echo e($order->created_at->format('h:i A')); ?></p>
                            </td>
                            <td class="px-7 py-4.5 text-center">
                                <span class="inline-flex items-center justify-center min-w-[2.5rem] px-1.5 h-7 rounded-lg bg-white border border-gray-200 text-gray-600 shadow-sm text-[12px] font-medium">
                                    <?php echo e($order->items->sum('quantity')); ?>

                                </span>
                            </td>
                            <td class="px-7 py-4.5 text-right">
                                <span class="text-[15px] font-black text-gray-900">RM<?php echo e(number_format($order->total_price, 2)); ?></span>
                            </td>
                            <td class="px-7 py-4.5 text-center">
                                <?php if($order->status === 'paid'): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black bg-emerald-50 text-emerald-600 border border-emerald-200/50 px-2.5 py-1 rounded-full uppercase tracking-widest shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_6px_rgba(16,185,129,0.5)]"></span>
                                        Paid
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black bg-amber-50 text-amber-600 border border-amber-200/50 px-2.5 py-1 rounded-full uppercase tracking-widest shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shadow-[0_0_6px_rgba(245,158,11,0.5)] animate-pulse"></span>
                                        Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                             <td class="px-7 py-4.5 text-right">
                                 <a href="<?php echo e(route('reseller.orders.show', $order)); ?>"
                                    class="inline-flex items-center gap-1.5 px-6 py-2 text-[11px] font-black uppercase tracking-widest text-gray-400
                                           hover:text-black bg-white border border-gray-100 hover:bg-gray-50 rounded-xl transition-all duration-200 shadow-sm">
                                     Details
                                 </a>
                             </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-7 py-16 text-center">
                                <div class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100 shadow-sm">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <p class="text-[15px] font-bold text-gray-900 mb-1">You haven't placed any wholesale orders yet.</p>
                                <p class="text-[12px] text-gray-500 mb-5">Start by restocking your inventory from HQ.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($orders->hasPages()): ?>
            <div class="px-7 py-5 border-t border-gray-50/80">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </div>

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
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/reseller/orders/index.blade.php ENDPATH**/ ?>