<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> 
        Promotions Configuration
     <?php $__env->endSlot(); ?>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Promotions Configuration</h1>
            <p class="text-sm font-medium text-gray-500 mt-1">Manage content and visibility for the automated Promotions page, and execute global sale events.</p>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg flex items-center border border-green-200">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                <div class="text-sm font-medium"><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Quick Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex items-center gap-5 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-xl bg-indigo-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-indigo-500/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Active Promos</p>
                    <p class="text-2xl font-bold text-gray-900 tracking-tight leading-none"><?php echo e(number_format($activePromosCount ?? 0)); ?></p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex items-center gap-5 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-xl bg-violet-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-violet-500/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Scheduled</p>
                    <p class="text-2xl font-bold text-gray-900 tracking-tight leading-none"><?php echo e(number_format($scheduledPromosCount ?? 0)); ?></p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex items-center gap-5 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Promo Revenue</p>
                    <p class="text-2xl font-bold text-gray-900 tracking-tight leading-none">RM<?php echo e(number_format($totalPromoRevenue ?? 0, 2)); ?></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Left Column: Page Settings (60%) -->
            <div class="lg:col-span-3 space-y-6">
                <form action="<?php echo e(route('admin.settings.page.update', $page)); ?>" method="POST" enctype="multipart/form-data" id="mainSettingsForm">
                    <?php echo csrf_field(); ?>
                    
                    <div class="space-y-6">
                        
                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupKey => $groupTitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $groupSettings = $settings->where('group', $groupKey);
                            ?>
                            <?php if($groupSettings->count() > 0): ?>
                                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                                    <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100">
                                        <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wider"><?php echo e($groupTitle); ?></h2>
                                    </div>
                                    
                                    <div class="p-6 space-y-6">
                                        <?php
                                            // Pre-process booleans to group them if they are 'marketing' settings
                                            $booleanSettings = $groupSettings->where('type', 'boolean');
                                            $otherSettings = $groupSettings->where('type', '!=', 'boolean');
                                        ?>

                                        <!-- Render Non-Boolean Settings (Images, Textareas, Texts) -->
                                        <?php $__currentLoopData = $otherSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                                                <label class="block text-sm font-bold text-gray-800 mb-2 capitalize"><?php echo e(str_replace(['_', $groupKey . ' '], [' ', ''], $setting->key)); ?></label>
                                                
                                                <?php if($setting->type === 'image'): ?>
                                                    <?php
                                                        $aspectRatio = str_contains($setting->key, 'hero_image') ? 'aspect-[21/9]' : 'aspect-video';
                                                    ?>
                                                    <div x-data="{ 
                                                            preview: '<?php echo e($setting->value ? (str_contains($setting->value, 'http') ? $setting->value : asset('storage/' . $setting->value)) : ''); ?>',
                                                            isDropping: false
                                                        }" class="space-y-4">
                                                        
                                                        <div @dragover.prevent="isDropping = true" 
                                                             @dragleave.prevent="isDropping = false" 
                                                             @drop.prevent="isDropping = false; if($event.dataTransfer.files[0]) { preview = URL.createObjectURL($event.dataTransfer.files[0]); $refs.fileInput.files = $event.dataTransfer.files; }"
                                                             :class="{'border-blue-500 bg-blue-50': isDropping, 'border-gray-200 bg-gray-50/50': !isDropping}"
                                                             class="relative w-full max-w-2xl rounded-2xl border-2 border-dashed flex flex-col items-center justify-center transition-all duration-300 overflow-hidden group <?php echo e($aspectRatio); ?>">
                                                            
                                                            <!-- Background Preview -->
                                                            <div x-show="preview" class="absolute inset-0 z-0">
                                                                <img :src="preview" class="w-full h-full object-cover">
                                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                                    <span class="text-white font-bold tracking-widest uppercase text-xs">Change Image</span>
                                                                </div>
                                                            </div>

                                                            <!-- Empty State -->
                                                            <div x-show="!preview" class="z-10 flex flex-col items-center justify-center text-gray-400 pointer-events-none">
                                                                <svg class="w-10 h-10 mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                                <span class="text-xs font-black uppercase tracking-widest text-gray-500">Drag & Drop Hero Image</span>
                                                                <span class="text-[10px] text-gray-400 mt-1">or click to browse</span>
                                                            </div>

                                                            <!-- Hidden File Input -->
                                                            <input type="file" x-ref="fileInput" name="<?php echo e($setting->key); ?>" accept="image/*" 
                                                                   @change="if($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                                        </div>
                                                    </div>
                                                    
                                                <?php elseif($setting->type === 'textarea'): ?>
                                                    <textarea name="<?php echo e($setting->key); ?>" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm"><?php echo e(old($setting->key, $setting->value)); ?></textarea>
                                                    
                                                <?php else: ?>
                                                    <input type="text" name="<?php echo e($setting->key); ?>" value="<?php echo e(old($setting->key, $setting->value)); ?>" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm">
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Render Boolean Settings Grouped (Switches) -->
                                        <?php if($booleanSettings->count() > 0): ?>
                                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-5 space-y-4">
                                                <?php $__currentLoopData = $booleanSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="flex items-center justify-between" x-data="{ checked: <?php echo e($setting->value === '1' || $setting->value === 'true' ? 'true' : 'false'); ?> }">
                                                        <div>
                                                            <label class="block text-sm font-black text-gray-800 capitalize"><?php echo e(str_replace('_', ' ', $setting->key)); ?></label>
                                                            <p class="text-[11px] text-gray-500 mt-0.5">Toggle visibility on the storefront interface.</p>
                                                        </div>
                                                        <!-- Horizontal Switch -->
                                                        <button type="button" 
                                                                @click="checked = !checked"
                                                                :class="checked ? 'bg-black' : 'bg-gray-100'"
                                                                class="relative inline-flex h-6 w-12 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-500 ease-in-out focus:outline-none shadow-inner">
                                                            <span class="sr-only">Toggle <?php echo e($setting->key); ?></span>
                                                            <span :class="checked ? 'translate-x-6' : 'translate-x-0'"
                                                                  class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-xl ring-0 transition duration-500 ease-in-out"></span>
                                                        </button>
                                                        <!-- Hidden actual input for form submission -->
                                                        <input type="hidden" name="<?php echo e($setting->key); ?>" :value="checked ? '1' : '0'">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-200 flex justify-end">
                            <button type="submit" class="bg-black text-white hover:bg-gray-900 font-black py-3 px-12 rounded-xl transition-all shadow-lg shadow-black/10 hover:scale-[1.02] active:scale-[0.98] flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span>Save Configuration</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Column: Global Promotion Actions (40% Sticky) -->
            <div class="lg:col-span-2">
                <div class="sticky top-24 space-y-6">
                    <?php
                        $isGlobalSaleActive = \App\Models\Setting::where('key', 'is_global_sale_active')->first()?->value === '1';
                        $globalSaleDesc = \App\Models\Setting::where('key', 'global_sale_description')->first()?->value;
                    ?>

                    <!-- Global Promo Card -->
                    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden relative">
                        <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100 flex flex-col gap-2">
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest">Global Sale Event</h2>
                                <?php if($isGlobalSaleActive): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-50 text-green-700 uppercase tracking-widest border border-green-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        Active
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if($isGlobalSaleActive): ?>
                                <p class="text-xs font-bold text-green-700"><?php echo e($globalSaleDesc); ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if($isGlobalSaleActive): ?>
                            <div class="p-6 relative z-10 bg-white">
                                <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                                    A global promotion is currently overriding individual product settings. You must end the current sale before launching a new one.
                                </p>
                                <form action="<?php echo e(route('admin.settings.endGlobalSale')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-black py-3 px-6 rounded-xl transition-colors shadow-sm uppercase text-xs tracking-widest flex items-center justify-center gap-2" onclick="return confirm('Are you sure you want to end the active global sale?')">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        End Global Sale
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div x-data="{ 
                                    promoType: 'discount_percent', 
                                    discountPercent: '', 
                                    showModal: false,
                                    getImpactText() {
                                        if (this.promoType === 'bogo') return 'Will apply Buy 1 Free 1 to targeted products.';
                                        if (this.discountPercent) return 'Will apply a ' + this.discountPercent + '% discount to targeted products.';
                                        return 'Configure your discount to see impact.';
                                    }
                                }" 
                                class="relative z-10">
                                
                                <form action="<?php echo e(route('admin.settings.globalPromotion')); ?>" method="POST" id="globalPromoForm" class="p-6">
                                    <?php echo csrf_field(); ?>
                                    <p class="text-xs text-gray-500 mb-6 leading-relaxed">
                                        Launch a store-wide or category-specific sale. This tool instantly applies your promotion rules to active products, overwriting any existing individual promotions.
                                    </p>

                                    <?php if($errors->any()): ?>
                                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                            <ul class="list-disc list-inside text-[11px] text-red-600 font-bold uppercase tracking-widest">
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="space-y-5">
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Promotion Type</label>
                                                <select name="promotion_type" x-model="promoType" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors">
                                                    <option value="discount_percent">Percentage Discount</option>
                                                    <option value="bogo">Buy 1 Free 1 (BOGO)</option>
                                                </select>
                                            </div>
                                            <div x-show="promoType === 'discount_percent'">
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Discount %</label>
                                                <input type="number" name="discount_percentage" x-model="discountPercent" min="1" max="100" :required="promoType === 'discount_percent'" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors" placeholder="e.g. 20">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Target Category</label>
                                            <select name="target_category" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors">
                                                <option value="">All Products (Store-wide)</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Target Audience</label>
                                                <select name="promotion_target" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors">
                                                    <option value="all">All Users</option>
                                                    <option value="direct">Direct Storefront Only</option>
                                                    <option value="reseller">Resellers Only</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Min. Quantity</label>
                                                <input type="number" name="promotion_min_qty" value="1" min="1" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors">
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Badge Text</label>
                                                <input type="text" name="promotion_badge" :placeholder="promoType === 'bogo' ? 'BUY 1 GET 1' : 'SALE'" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black sm:text-sm transition-colors">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 pt-2">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Starts At (GMT+8)</label>
                                                <input type="datetime-local" name="promotion_starts_at" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black text-xs px-3 py-2 transition-colors">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Ends At (GMT+8)</label>
                                                <input type="datetime-local" name="promotion_ends_at" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 shadow-sm focus:border-black focus:ring-black text-xs px-3 py-2 transition-colors">
                                            </div>
                                        </div>
                                        
                                        <div class="pt-4 mt-2">
                                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 flex items-start gap-2">
                                                <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <p class="text-[11px] text-gray-500 font-medium" x-text="getImpactText()"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-8">
                                        <button type="button" @click="if ($event.target.closest('form').reportValidity()) { showModal = true }" class="w-full bg-black text-white hover:bg-gray-900 font-black py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-black/10 hover:shadow-black/20 uppercase text-xs tracking-widest">
                                            Execute Global Sale
                                        </button>
                                    </div>

                                    <!-- Custom Confirmation Modal -->
                                    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                            <div x-show="showModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-gray-100">
                                                <div class="bg-white px-6 pt-6 pb-6">
                                                    <div class="sm:flex sm:items-start">
                                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 class="text-lg font-black text-gray-900 tracking-tight" id="modal-title">Execute Global Promotion</h3>
                                                            <div class="mt-2 text-sm text-gray-500 space-y-3">
                                                                <p>
                                                                    This action will immediately overwrite the promotion settings for <strong class="text-gray-900">up to <?php echo e($totalActiveProducts); ?> active products</strong> (depending on your category filter).
                                                                </p>
                                                                <p class="font-medium text-gray-700">Are you sure you want to proceed?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-6 py-4 flex items-center gap-3 justify-end border-t border-gray-100">
                                                    <button type="button" @click="showModal = false" class="inline-flex justify-center rounded-xl border border-gray-200 px-5 py-2.5 bg-white text-xs font-bold text-gray-700 hover:bg-gray-50 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <button type="button" @click="$event.target.closest('form').submit()" class="inline-flex justify-center rounded-xl border border-transparent px-5 py-2.5 bg-red-600 text-xs font-bold text-white hover:bg-red-700 transition-colors uppercase tracking-widest shadow-sm shadow-red-600/20">
                                                        Yes, Execute
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Quick Link -->
                    <div class="bg-transparent text-center px-6">
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">
                            <span>Manage Individual Promos Instead</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/admin/settings/marketing.blade.php ENDPATH**/ ?>