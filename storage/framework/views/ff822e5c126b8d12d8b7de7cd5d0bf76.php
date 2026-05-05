<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Stock from Admin']); ?>

    <div class="max-w-full pb-32">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4 relative z-10">
            <div>
                <h1 class="text-xl font-bold text-gray-900 tracking-tight">Order Wholesale Stock</h1>
                <p class="text-sm font-medium text-gray-500 mt-1">Browse the global catalog and purchase raw stock from HQ immediately.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" @click="$dispatch('open-scanner')" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white hover:bg-blue-700 text-[13px] font-bold rounded-xl transition-all duration-300 shadow-sm hover:-translate-y-0.5 hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                    Scan to Add
                </button>
                <a href="<?php echo e(route('reseller.orders.index')); ?>" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 hover:text-blue-600 hover:bg-blue-50 text-[13px] font-bold rounded-xl transition-all duration-300 shadow-sm hover:-translate-y-0.5 hover:shadow-md group">
                    History
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <form id="order-form" action="<?php echo e(route('reseller.orders.store')); ?>" method="POST" class="needs-validation">
            <?php echo csrf_field(); ?>

            <?php if($errors->any()): ?>
                <div class="mb-8 p-5 rounded-xl bg-red-50 border border-red-200/50 shadow-sm flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0 border border-red-200/50">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-[14px] font-black text-red-800 tracking-tight">Whoops! Something went wrong.</h3>
                        <ul class="text-[12px] font-bold text-red-600 mt-1 list-disc pl-4 space-y-0.5">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($err); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $counter = 0; ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/50 overflow-hidden flex flex-col relative group transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
                        
                        
                        <div class="p-8 bg-gradient-to-br from-gray-50/80 to-white border-b border-gray-50 flex items-center justify-between">
                            <div>
                                <h3 class="text-[16px] font-black text-gray-900 tracking-tight"><?php echo e($product->name); ?></h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5"><?php echo e($product->sku); ?></p>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-white shadow-sm flex items-center justify-center text-blue-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                            </div>
                        </div>

                        
                        <div class="p-6 space-y-4">
                            <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-gray-50/50 rounded-2xl p-4 border border-gray-100/80 group/variant transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-[10px] font-black text-gray-500">
                                                <?php echo e($variant->name); ?>

                                            </div>
                                            <div>
                                                <p class="text-[12px] font-bold text-gray-800">RM<?php echo e(number_format($variant->wholesale_price, 2)); ?></p>
                                                <p class="text-[9px] font-bold <?php echo e($variant->stock > 0 ? 'text-emerald-500' : 'text-red-400'); ?> uppercase tracking-tighter">
                                                    <?php echo e($variant->stock > 0 ? $variant->stock . ' IN STOCK' : 'SOLD OUT'); ?>

                                                </p>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="flex items-center gap-1.5 bg-white p-1 rounded-xl border border-gray-100 shadow-inner">
                                            <input type="hidden" name="variant_id[<?php echo e($counter); ?>]" value="<?php echo e($variant->id); ?>">
                                            <input type="hidden" class="product-price" value="<?php echo e($variant->wholesale_price); ?>">
                                            
                                            <button type="button" 
                                                    class="qty-btn minus w-7 h-7 rounded-lg flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition-colors <?php echo e($variant->stock === 0 ? 'opacity-50 cursor-not-allowed' : ''); ?>" 
                                                    <?php echo e($variant->stock === 0 ? 'disabled' : ''); ?>>
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                                            </button>
                                            
                                            <input type="number" 
                                                   name="quantity[<?php echo e($counter); ?>]" 
                                                   class="qty-input w-10 text-center text-[13px] font-black border-transparent bg-transparent p-0 focus:ring-0 focus:border-transparent text-gray-900" 
                                                   data-sku="<?php echo e($variant->sku ?? $product->sku); ?>"
                                                   value="0" 
                                                   min="0" 
                                                   max="<?php echo e($variant->stock); ?>"
                                                   <?php echo e($variant->stock === 0 ? 'disabled' : ''); ?>>
                                                   
                                            <button type="button" 
                                                    class="qty-btn plus w-7 h-7 rounded-lg flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition-colors <?php echo e($variant->stock === 0 ? 'opacity-50 cursor-not-allowed' : ''); ?>" 
                                                    <?php echo e($variant->stock === 0 ? 'disabled' : ''); ?>>
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php $counter++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-gray-200/50 shadow-[0_-10px_40px_-5px_rgba(0,0,0,0.1)] px-8 py-5 transform translate-y-0 transition-transform duration-300 z-50">
                <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-8">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Cart Summary</p>
                            <p class="text-[14px] font-bold text-gray-900"><span id="total-items" class="font-black text-blue-600">0</span> units selected</p>
                        </div>
                        <div class="h-10 w-px bg-gray-200"></div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Total Payable</p>
                            <p id="total-price" class="text-2xl font-black text-gray-900 tracking-tight">RM0.00</p>
                        </div>
                    </div>
                    
                    <button type="submit" id="checkout-btn" disabled class="group relative px-10 py-4 bg-gray-200 text-gray-400 font-bold text-[14px] rounded-2xl transition-all duration-300 overflow-hidden shadow-sm">
                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-[.active]:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 w-full h-full opacity-0 group-[.active]:opacity-100 bg-white/10 group-[.active]:hover:bg-transparent transition-all"></div>
                        <span class="relative flex items-center gap-2 group-[.active]:text-white z-10 font-black">
                            Proceed to Checkout
                            <svg class="w-4 h-4 transform group-[.active]:group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </button>
                </div>
            </div>
            
        </form>
    </div>
    
    <?php if (isset($component)) { $__componentOriginal4a5b383c5f2fd77c53190169595b4c9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a5b383c5f2fd77c53190169595b4c9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.scanner-modal','data' => ['targetEvent' => 'order-barcode-scanned']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('scanner-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['target-event' => 'order-barcode-scanned']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4a5b383c5f2fd77c53190169595b4c9a)): ?>
<?php $attributes = $__attributesOriginal4a5b383c5f2fd77c53190169595b4c9a; ?>
<?php unset($__attributesOriginal4a5b383c5f2fd77c53190169595b4c9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4a5b383c5f2fd77c53190169595b4c9a)): ?>
<?php $component = $__componentOriginal4a5b383c5f2fd77c53190169595b4c9a; ?>
<?php unset($__componentOriginal4a5b383c5f2fd77c53190169595b4c9a); ?>
<?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.qty-input');
            const totalItemsEl = document.getElementById('total-items');
            const totalPriceEl = document.getElementById('total-price');
            const checkoutBtn = document.getElementById('checkout-btn');

            function updateCart() {
                let items = 0;
                let price = 0;

                inputs.forEach(input => {
                    const qty = parseInt(input.value) || 0;
                    if (qty > 0) {
                        const priceContainer = input.closest('.flex');
                        const unitPrice = parseFloat(priceContainer.querySelector('.product-price').value) || 0;
                        items += qty;
                        price += (qty * unitPrice);
                    }
                });

                totalItemsEl.textContent = items;
                totalPriceEl.textContent = 'RM' + price.toLocaleString('en-MY', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                
                if (items > 0) {
                    checkoutBtn.classList.add('active');
                    checkoutBtn.classList.replace('bg-gray-200', 'bg-blue-600');
                    checkoutBtn.classList.replace('text-gray-400', 'text-white');
                    checkoutBtn.classList.add('shadow-lg', 'shadow-blue-500/30', 'hover:-translate-y-0.5');
                    checkoutBtn.disabled = false;
                } else {
                    checkoutBtn.classList.remove('active');
                    checkoutBtn.classList.replace('bg-blue-600', 'bg-gray-200');
                    checkoutBtn.classList.replace('text-white', 'text-gray-400');
                    checkoutBtn.classList.remove('shadow-lg', 'shadow-blue-500/30', 'hover:-translate-y-0.5');
                    checkoutBtn.disabled = true;
                }
            }

            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const isPlus = btn.classList.contains('plus');
                    const input = btn.parentElement.querySelector('.qty-input');
                    const max = parseInt(input.max) || 0;
                    let val = parseInt(input.value) || 0;

                    if (isPlus && val < max) {
                        input.value = val + 1;
                    } else if (!isPlus && val > 0) {
                        input.value = val - 1;
                    }
                    updateCart();
                });
            });

            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    const max = parseInt(input.max) || 0;
                    let val = parseInt(input.value) || 0;
                    if (val < 0) input.value = 0;
                    if (val > max) input.value = max;
                    updateCart();
                });
            });

            // Scanner Event Listener
            window.addEventListener('order-barcode-scanned', (e) => {
                const sku = e.detail.sku;
                let found = false;
                
                inputs.forEach(input => {
                    if (input.dataset.sku === sku) {
                        found = true;
                        if (!input.disabled) {
                            const max = parseInt(input.max) || 0;
                            let val = parseInt(input.value) || 0;
                            if (val < max) {
                                input.value = val + 1;
                                updateCart();
                                // Highlight the matched product container briefly
                                const container = input.closest('.bg-gray-50\\/50');
                                if (container) {
                                    container.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50/50');
                                    setTimeout(() => container.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50/50'), 1000);
                                    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            } else {
                                alert(`Maximum stock (${max}) reached for this item.`);
                            }
                        } else {
                            alert("This item is currently out of stock.");
                        }
                    }
                });
                
                if (!found) {
                    alert("Scanned product not found in the catalog.");
                }
            });
        });
    </script>
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
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/reseller/orders/create.blade.php ENDPATH**/ ?>