<section>
    <div class="bg-red-50/30 border border-red-100 rounded-2xl p-6 mb-8">
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-xl bg-white border border-red-100 flex items-center justify-center text-red-600 shrink-0 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-[13px] font-black text-red-900 uppercase tracking-tight">Warning: Irreversible Action</p>
                <p class="text-[11px] font-medium text-red-600 mt-0.5">Deleting your account will purge all associated data, including transaction history and inventory records.</p>
            </div>
        </div>
    </div>

    {{-- Trigger button --}}
    <button type="button" id="delete-account-btn"
            class="inline-flex items-center gap-2 px-10 py-3.5 bg-white hover:bg-red-50
                   text-red-600 text-[11px] font-black uppercase tracking-[0.2em] rounded-xl border border-red-100 transition-all duration-300
                   hover:-translate-y-0.5 shadow-xl shadow-red-500/5">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        <span>Terminate Account</span>
    </button>

    {{-- Confirm Modal --}}
    <div id="delete-account-modal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4 backdrop-blur-md bg-black/40 transition-all duration-500">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 w-full max-w-md p-10 transform scale-100">
            <div class="flex flex-col items-center text-center mb-8">
                <div class="w-16 h-16 rounded-3xl bg-red-50 flex items-center justify-center mb-5">
                    <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 tracking-tight uppercase">Confirm Termination</h3>
                <p class="text-[12px] font-medium text-gray-500 mt-2 uppercase tracking-widest leading-relaxed">
                    Please provide your account password to verify your identity and confirm deletion.
                </p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div>
                    <label for="delete_password" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Security Key / Password</label>
                    <input id="delete_password" name="password" type="password" placeholder="••••••••"
                           class="w-full px-5 py-4 text-[14px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-2xl transition duration-300
                                  focus:outline-none focus:ring-black focus:border-black uppercase tracking-[0.2em]
                                  {{ $errors->userDeletion->has('password') ? 'border-red-400' : '' }}">
                    @if($errors->userDeletion->has('password'))
                        <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest px-1">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <button type="button" id="cancel-delete-btn"
                            class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400 bg-white border border-gray-100 hover:bg-gray-50 hover:text-black rounded-2xl transition-all duration-300">
                        Nevermind
                    </button>
                    <button type="submit"
                            class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-white bg-red-600 hover:bg-red-700 rounded-2xl shadow-xl shadow-red-500/20 transition-all duration-300 hover:-translate-y-0.5">
                        Destroy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const delModal = document.getElementById('delete-account-modal');
        const triggerBtn = document.getElementById('delete-account-btn');
        const cancelBtn = document.getElementById('cancel-delete-btn');

        triggerBtn.addEventListener('click', () => {
            delModal.classList.remove('hidden');
            delModal.classList.add('flex');
            setTimeout(() => delModal.children[0].classList.add('opacity-100', 'scale-100'), 10);
        });

        cancelBtn.addEventListener('click', () => {
            delModal.classList.add('hidden');
            delModal.classList.remove('flex');
        });

        // Close on backdrop click
        delModal.addEventListener('click', (e) => {
            if (e.target === delModal) {
                delModal.classList.add('hidden');
                delModal.classList.remove('flex');
            }
        });

        // Auto-open if errors
        @if($errors->userDeletion->isNotEmpty())
            delModal.classList.remove('hidden');
            delModal.classList.add('flex');
        @endif
    </script>
</section>
