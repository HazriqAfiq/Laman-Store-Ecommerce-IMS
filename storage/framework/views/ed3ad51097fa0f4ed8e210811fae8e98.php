<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Record Sale']); ?>

    <div class="max-w-full">

        
        <a href="<?php echo e(route('reseller.sales.index')); ?>"
           class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gray-400 hover:text-gray-700 mb-6 transition-all duration-200 hover:-translate-x-1">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Sales History
        </a>

        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-md shadow-gray-200/40 overflow-hidden">

            
            <div class="px-8 py-6 border-b border-gray-50/80 bg-gray-50/20">
                <h1 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.1em]">Record New Sale</h1>
                <p class="text-[11px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Select product and quantity from stock</p>
            </div>

            
            <form id="sale-form"
                  action="<?php echo e(route('reseller.sales.store')); ?>"
                  method="POST"
                  class="p-8 space-y-8">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    
                    <div class="space-y-6">
                        
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="product_id" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest">
                                    Product <span class="text-black">*</span>
                                </label>
                                <button type="button" @click="$dispatch('open-scanner')" class="text-[11px] font-black text-black hover:opacity-70 flex items-center gap-1 uppercase tracking-widest transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                    Scan
                                </button>
                            </div>
                            <select id="product_id"
                                    name="product_id"
                                    required
                                    class="w-full px-4 py-3 text-[14px] font-medium text-gray-900 bg-gray-50/50 border rounded-xl transition-all duration-300
                                           focus:outline-none focus:ring-black/5 focus:border-black
                                           cursor-pointer appearance-none bg-no-repeat bg-[position:right_1rem_center] bg-[length:1em_1em]
                                           <?php echo e($errors->has('product_id') ? 'border-red-400 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200'); ?>"
                                    style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22currentColor%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E');">
                                <option value="">— Select a product —</option>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($stock->product_id); ?>"
                                            data-price="<?php echo e($stock->product->retail_price); ?>"
                                            data-stock="<?php echo e($stock->quantity); ?>"
                                            data-volume="<?php echo e($stock->product->volume_ml); ?>"
                                            data-sku="<?php echo e($stock->product->sku); ?>"
                                            <?php echo e(old('product_id') == $stock->product_id ? 'selected' : ''); ?>>
                                        <?php echo e($stock->product->name); ?> (<?php echo e($stock->product->volume_ml); ?>ml)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label for="quantity" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">
                                Quantity <span class="text-black">*</span>
                            </label>
                            <div class="flex gap-3">
                                <button type="button"
                                        id="qty-minus"
                                        class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-200
                                               text-gray-500 hover:bg-gray-100 hover:text-gray-800 transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                                    </svg>
                                </button>

                                <input id="quantity"
                                       name="quantity"
                                       type="number"
                                       min="1"
                                       value="<?php echo e(old('quantity', 1)); ?>"
                                       required
                                       class="flex-1 text-center text-[16px] font-black text-gray-900 border bg-gray-50/50 rounded-xl px-4 py-3
                                              transition-all duration-300 focus:outline-none focus:ring-black/5 focus:border-black
                                              <?php echo e($errors->has('quantity') ? 'border-red-400' : 'border-gray-200'); ?>">

                                <button type="button"
                                        id="qty-plus"
                                        class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-200
                                               text-gray-500 hover:bg-gray-100 hover:text-gray-800 transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>

                            
                            <p id="stock-warning" class="hidden mt-2 text-[12px] font-bold text-amber-600 flex items-center gap-1.5 bg-amber-50 border border-amber-100 px-3 py-2 rounded-lg">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span id="stock-warning-text"></span>
                            </p>

                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="space-y-6">
                        
                        
                        <div id="product-info" class="hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                            <h3 class="text-[11px] font-black text-black uppercase tracking-widest mb-4">Stock Overview</h3>
                            <div class="grid grid-cols-2 gap-y-5 gap-x-4">
                                <div>
                                    <p class="text-[11px] font-bold text-gray-500 mb-0.5">Unit Price</p>
                                    <p id="info-price" class="text-[16px] font-black text-gray-900">—</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold text-gray-500 mb-0.5">Volume</p>
                                    <p id="info-volume" class="text-[16px] font-black text-gray-900">—</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-[11px] font-bold text-gray-500 mb-1">Available in Stock</p>
                                    <div class="flex items-center gap-3">
                                        <p id="info-stock" class="text-[20px] font-black text-black">—</p>
                                        <div class="flex-1 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                            <div id="info-stock-bar" class="h-1.5 rounded-full bg-black transition-all duration-500" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div id="total-preview" class="hidden rounded-3xl border border-gray-100 bg-gray-50 p-6 flex flex-col items-center justify-center text-center shadow-inner">
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Estimated Revenue</p>
                            <p id="preview-total" class="text-4xl font-black text-gray-900 tracking-tight mb-2">RM0.00</p>
                            <p class="text-[12px] font-bold text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm border border-gray-200">
                                <span id="preview-qty">1</span> unit(s) × <span id="preview-unit-price">RM0.00</span>
                            </p>
                        </div>
                    </div>
                    
                </div>

                
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                    <button type="button" id="reset-btn"
                            class="px-5 py-3 text-[13px] font-bold text-gray-500 hover:text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-all duration-300 hover:shadow-sm">
                        Reset
                    </button>

                    <button type="submit" id="submit-btn"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-black hover:opacity-90
                                   text-white text-[13px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5
                                   focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirm Sale
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-[12px] font-medium text-gray-400 text-center mt-6">
            <span class="inline-block w-2 h-2 rounded-full bg-black mr-1.5 opacity-50"></span>
            Stock levels will instantly reflect this transaction upon confirmation.
        </p>

    </div>

    
    <?php if (isset($component)) { $__componentOriginal4a5b383c5f2fd77c53190169595b4c9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a5b383c5f2fd77c53190169595b4c9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.scanner-modal','data' => ['targetEvent' => 'barcode-scanned']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('scanner-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['target-event' => 'barcode-scanned']); ?>
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
    (function () {
        const productSelect  = document.getElementById('product_id');
        const qtyInput       = document.getElementById('quantity');
        const qtyMinus       = document.getElementById('qty-minus');
        const qtyPlus        = document.getElementById('qty-plus');
        const productInfo    = document.getElementById('product-info');
        const totalPreview   = document.getElementById('total-preview');
        const infoPrice      = document.getElementById('info-price');
        const infoStock      = document.getElementById('info-stock');
        const infoVolume     = document.getElementById('info-volume');
        const infoStockBar   = document.getElementById('info-stock-bar');
        const previewQty     = document.getElementById('preview-qty');
        const previewUnit    = document.getElementById('preview-unit-price');
        const previewTotal   = document.getElementById('preview-total');
        const stockWarning   = document.getElementById('stock-warning');
        const stockWarnText  = document.getElementById('stock-warning-text');
        const submitBtn      = document.getElementById('submit-btn');
        const resetBtn       = document.getElementById('reset-btn');

        let currentPrice = 0;
        let currentStock = 0;
        let maxStockBase = 100; // heuristic for progress bar

        const fmt = v => 'RM ' + Number(v).toLocaleString('en-MY', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        function update() {
            const selected = productSelect.options[productSelect.selectedIndex];
            const qty      = Math.max(1, parseInt(qtyInput.value) || 1);

            if (!selected || !selected.value) {
                productInfo.classList.add('hidden');
                totalPreview.classList.add('hidden');
                stockWarning.classList.add('hidden');
                currentPrice = 0;
                currentStock = 0;
                submitBtn.disabled = true;
                return;
            }

            currentPrice = parseFloat(selected.dataset.price) || 0;
            currentStock = parseInt(selected.dataset.stock)   || 0;
            const volume = selected.dataset.volume || '—';

            infoPrice.textContent  = fmt(currentPrice);
            infoStock.textContent  = currentStock + ' units';
            infoVolume.textContent = volume + 'ml';
            productInfo.classList.remove('hidden');

            let pct = Math.min(100, Math.max(5, (currentStock / maxStockBase) * 100));
            
            if (currentStock <= 5) {
                infoStock.className = 'text-[20px] font-black text-red-600';
                infoStockBar.className = 'h-1.5 rounded-full transition-all duration-500 bg-red-500';
                infoStockBar.style.width = pct + '%';
            } else if (currentStock <= 15) {
                infoStock.className = 'text-[20px] font-black text-amber-500';
                infoStockBar.className = 'h-1.5 rounded-full transition-all duration-500 bg-amber-400';
                infoStockBar.style.width = pct + '%';
            } else {
                infoStock.className = 'text-[20px] font-black text-black';
                infoStockBar.className = 'h-1.5 rounded-full transition-all duration-500 bg-black';
                infoStockBar.style.width = pct + '%';
            }

            qtyInput.max = currentStock;
            if (qty > currentStock) {
                qtyInput.value = currentStock;
            }

            const safeQty   = Math.min(Math.max(1, parseInt(qtyInput.value) || 1), currentStock);
            const totalAmt  = currentPrice * safeQty;

            previewQty.textContent   = safeQty;
            previewUnit.textContent  = fmt(currentPrice);
            previewTotal.textContent = fmt(totalAmt);
            totalPreview.classList.remove('hidden');

            if (safeQty >= currentStock) {
                stockWarnText.textContent = `Only ${currentStock} unit${currentStock !== 1 ? 's' : ''} available — quantity capped.`;
                stockWarning.classList.remove('hidden');
            } else {
                stockWarning.classList.add('hidden');
            }

            submitBtn.disabled = currentStock === 0;
        }

        qtyMinus.addEventListener('click', () => {
            const v = parseInt(qtyInput.value) || 1;
            if (v > 1) { qtyInput.value = v - 1; update(); }
        });

        qtyPlus.addEventListener('click', () => {
            const v = parseInt(qtyInput.value) || 1;
            if (v < currentStock) { qtyInput.value = v + 1; update(); }
        });

        productSelect.addEventListener('change', update);
        qtyInput.addEventListener('input', update);

        resetBtn.addEventListener('click', () => {
            productSelect.value = '';
            qtyInput.value      = 1;
            productInfo.classList.add('hidden');
            totalPreview.classList.add('hidden');
            stockWarning.classList.add('hidden');
            submitBtn.disabled  = true;
            currentPrice = 0;
            currentStock = 0;
        });

        // Listen for scanner events
        window.addEventListener('barcode-scanned', (e) => {
            const scannedSku = e.detail.sku;
            let found = false;
            Array.from(productSelect.options).forEach(opt => {
                if (opt.dataset.sku === scannedSku) {
                    productSelect.value = opt.value;
                    found = true;
                }
            });
            
            if (found) {
                const currentQty = parseInt(qtyInput.value) || 0;
                qtyInput.value = currentQty + 1; // Increment quantity automatically on scan
                update();
            } else {
                alert("Scanned product not found in your inventory!");
            }
        });

        if (productSelect.value) { update(); } else { submitBtn.disabled = true; }

    })();
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
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/reseller/sales/create.blade.php ENDPATH**/ ?>