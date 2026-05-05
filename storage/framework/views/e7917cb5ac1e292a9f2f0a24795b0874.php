<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profile Settings']); ?>

    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-black text-gray-900 tracking-tight uppercase">Profile Settings</h1>
            <p class="text-[12px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Manage account security and preferences</p>
        </div>
        
        <span class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-[0.2em]
            <?php echo e(auth()->user()->isAdmin() ? 'bg-black text-white shadow-xl shadow-black/10' : 'bg-white text-gray-900 border border-gray-100 shadow-sm'); ?> self-start sm:self-auto">
            <span class="w-1.5 h-1.5 rounded-full <?php echo e(auth()->user()->isAdmin() ? 'bg-white shadow-[0_0_8px_rgba(255,255,255,0.5)]' : 'bg-black'); ?>"></span>
            <?php echo e(auth()->user()->role); ?>

        </span>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">

            
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center gap-4 bg-gray-50/20">
                    <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white shrink-0 shadow-xl shadow-black/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.2em]">Profile Information</h2>
                        <p class="text-[11px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Identity & Verification Settings</p>
                    </div>
                </div>
                <div class="p-8">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center gap-4 bg-gray-50/20">
                    <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white shrink-0 shadow-xl shadow-black/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.2em]">Security Access</h2>
                        <p class="text-[11px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Account Authentication & Encryption</p>
                    </div>
                </div>
                <div class="p-8">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <?php if(auth()->user()->role === 'reseller'): ?>
                <div class="bg-white rounded-3xl border border-red-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                    <div class="px-8 py-6 border-b border-red-50 flex items-center gap-4 bg-red-50/30">
                        <div class="w-10 h-10 rounded-xl bg-white border border-red-100 flex items-center justify-center text-red-600 shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-[14px] font-black text-red-900 uppercase tracking-[0.2em]">Sensitive Operations</h2>
                            <p class="text-[11px] font-medium text-red-400 mt-1 uppercase tracking-widest">Irreversible Account Actions</p>
                        </div>
                    </div>
                    <div class="p-8">
                        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        
        <div class="space-y-8">

            
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/10">
                    <h2 class="text-[13px] font-black text-gray-900 uppercase tracking-[0.2em]">Verified Identity</h2>
                    <p class="text-[10px] font-medium text-gray-400 mt-0.5 uppercase tracking-widest">Real-time status</p>
                </div>

                
                <div class="px-6 py-8 flex flex-col items-center border-b border-gray-50 bg-white">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-3xl bg-black flex items-center justify-center text-white font-black text-3xl shadow-2xl shadow-black/20 transition-transform group-hover:scale-105 duration-500">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-xl bg-white border border-gray-100 flex items-center justify-center shadow-lg" title="Active">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                        </div>
                    </div>
                    <p class="mt-5 text-[17px] font-black text-gray-900 tracking-tight"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-[11px] font-black text-gray-400 mt-1 uppercase tracking-[0.2em]"><?php echo e(auth()->user()->role); ?></p>
                </div>

                
                <div class="px-8 py-6 space-y-5 bg-white">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Account Type</span>
                        <span class="text-[11px] font-black text-gray-900 uppercase tracking-[0.1em]"><?php echo e(auth()->user()->role); ?></span>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Registration</span>
                        <span class="text-[11px] font-black text-gray-900 uppercase tracking-[0.1em]"><?php echo e(auth()->user()->created_at->format('d M Y')); ?></span>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Current Status</span>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-emerald-700 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full uppercase tracking-widest">
                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                            Verified
                        </span>
                    </div>
                </div>
            </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Email Verified</span>
                        <?php if(auth()->user()->email_verified_at): ?>
                            <span class="inline-flex items-center gap-1 text-[11px] font-black text-black uppercase tracking-widest">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Verified
                            </span>
                        <?php else: ?>
                            <span class="text-[11px] font-black text-amber-600 uppercase tracking-widest">Unverified</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50">
                    <h2 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.1em]">Notifications</h2>
                    <p class="text-[11px] font-medium text-gray-400 mt-0.5 uppercase tracking-widest">System and alert preferences</p>
                </div>
                <div class="px-6 py-4 space-y-4">
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-[13px] font-bold text-gray-800">Low Stock Alerts</p>
                            <p class="text-[11px] font-medium text-gray-400">Notify when stock is critical.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0 group">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-100 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-4 after:w-4 after:transition-all duration-500 peer-checked:bg-black shadow-inner"></div>
                        </label>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-[13px] font-bold text-gray-800">Sales Recorded</p>
                            <p class="text-[11px] font-medium text-gray-400">Alerts for every new sale.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0 group">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-100 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-4 after:w-4 after:transition-all duration-500 peer-checked:bg-black shadow-inner"></div>
                        </label>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-[13px] font-bold text-gray-800">Order Updates</p>
                            <p class="text-[11px] font-medium text-gray-400">Status changes on wholesale orders.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0 group">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-100 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-4 after:w-4 after:transition-all duration-500 peer-checked:bg-black shadow-inner"></div>
                        </label>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-[13px] font-bold text-gray-800">Email Notifications</p>
                            <p class="text-[11px] font-medium text-gray-400">Receive alerts via email.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0 group">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-100 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-4 after:w-4 after:transition-all duration-500 peer-checked:bg-black shadow-inner"></div>
                        </label>
                    </div>
                    <div class="pt-1">
                        <p class="text-[10px] font-medium text-gray-400 italic">* Notification preferences are saved locally for now.</p>
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
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/profile/edit.blade.php ENDPATH**/ ?>