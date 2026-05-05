<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Full Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                       class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-xl transition-all duration-300
                              focus:outline-none focus:ring-black focus:border-black uppercase tracking-widest">
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                       class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-xl transition-all duration-300
                              focus:outline-none focus:ring-black focus:border-black uppercase tracking-widest">
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 border border-amber-100 rounded-xl">
                        <p class="text-[11px] font-black text-amber-800 uppercase tracking-widest">
                            Your email address is unverified.
                            <button form="send-verification" class="ml-2 text-black underline hover:text-gray-700 transition-colors">
                                Click here to re-send verification
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                                A new verification link has been sent.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="inline-flex items-center gap-2 px-10 py-3.5 bg-black hover:bg-gray-900 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Update Identity</span>
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-[11px] font-black text-emerald-600 uppercase tracking-widest">Changes Saved.</p>
            @endif
        </div>
    </form>
</section>
