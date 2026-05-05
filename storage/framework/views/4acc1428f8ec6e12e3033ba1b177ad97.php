<section>
    <p class="text-sm text-gray-600 mb-5">
        Once your account is deleted, all data will be permanently removed. This action cannot be undone.
    </p>

    
    <button type="button"
            id="delete-account-btn"
            class="inline-flex items-center gap-2 px-8 py-3 bg-white hover:bg-red-50
                   text-red-600 text-[11px] font-black uppercase tracking-[0.2em] rounded-xl border border-red-100 transition-all duration-200
                   hover:-translate-y-0.5 shadow-xl shadow-red-500/5">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Terminate Account
    </button>

    
    <div id="delete-account-modal"
         class="fixed inset-0 z-50 hidden items-center justify-center p-4 backdrop-blur-sm"
         style="background:rgba(0,0,0,0.4);">
        <div class="bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.2)] border border-gray-100 w-full max-w-sm p-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[15px] font-black text-gray-900 tracking-tight">Account Termination</h3>
                    <p class="text-[11px] font-medium text-gray-400 mt-0.5">This action is permanent and irreversible.</p>
                </div>
            </div>

            <form method="post" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div>
                    <label for="delete_password" class="block text-[12px] font-black text-gray-400 uppercase tracking-widest mb-2">Confirm password</label>
                    <input id="delete_password"
                           name="password"
                           type="password"
                           placeholder="••••••••"
                           class="w-full px-4 py-3 text-sm text-gray-900 bg-gray-50 border rounded-xl transition duration-200
                                  focus:outline-none focus:ring-black focus:border-black
                                  <?php echo e($errors->userDeletion->has('password') ? 'border-red-400' : 'border-gray-200'); ?>">
                    <?php if($errors->userDeletion->has('password')): ?>
                        <p class="mt-1.5 text-xs text-red-500"><?php echo e($errors->userDeletion->first('password')); ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex gap-3">
                    <button type="button"
                            id="cancel-delete-btn"
                            class="flex-1 px-4 py-3 text-[11px] font-black uppercase tracking-widest text-gray-500 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-3 text-[11px] font-black uppercase tracking-widest text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-lg shadow-red-500/20 transition-all duration-200">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('delete-account-modal');
        document.getElementById('delete-account-btn').addEventListener('click', () => {
            modal.classList.remove('hidden'); modal.classList.add('flex');
        });
        document.getElementById('cancel-delete-btn').addEventListener('click', () => {
            modal.classList.add('hidden'); modal.classList.remove('flex');
        });
        modal.addEventListener('click', e => { if (e.target === modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } });

        // Auto-open if there were validation errors
        <?php if($errors->userDeletion->isNotEmpty()): ?>
            document.getElementById('delete-account-modal').classList.remove('hidden');
            document.getElementById('delete-account-modal').classList.add('flex');
        <?php endif; ?>
    </script>
</section>
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>