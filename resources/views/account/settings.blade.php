<x-account-layout>

    {{-- ── PAGE TITLE ────────────────────────────────────────────────────── --}}
    <div class="mb-14 pb-10 border-b border-gray-100">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.5em] mb-3">Preferences</p>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-none tracking-tight">Settings</h2>
    </div>

    {{-- Success notice --}}
    @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div class="mb-12 flex items-center gap-4 px-6 py-4 border border-emerald-100 bg-emerald-50/50">
            <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-3 h-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-[11px] font-bold uppercase tracking-[0.4em] text-emerald-700">Changes saved successfully</p>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-px bg-gray-100 border border-gray-100 mb-16">

        {{-- ── PERSONAL INFORMATION ──────────────────────────────────────── --}}
        <div class="bg-white p-10 xl:p-12">
            <div class="flex items-start gap-3 mb-10">
                <div class="w-8 h-8 border border-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] mb-1">Profile</p>
                    <h3 class="text-xl font-bold text-gray-900 tracking-tight">Personal Information</h3>
                </div>
            </div>
            <form method="post" action="{{ route('profile.update') }}" class="space-y-9 max-w-sm">
                @csrf
                @method('patch')
                <div>
                    <label for="name" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Full Name</label>
                    <input id="name" name="name" type="text"
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                           class="w-full bg-transparent border-0 border-b border-gray-200 py-3.5 px-0 text-[15px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors placeholder-gray-200">
                    <x-input-error class="mt-2 text-[11px] font-bold uppercase tracking-widest text-red-400" :messages="$errors->get('name')" />
                </div>
                <div>
                    <label for="email" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Email Address</label>
                    <input id="email" name="email" type="email"
                           value="{{ old('email', $user->email) }}" required autocomplete="username"
                           class="w-full bg-transparent border-0 border-b border-gray-200 py-3.5 px-0 text-[15px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                    <x-input-error class="mt-2 text-[11px] font-bold uppercase tracking-widest text-red-400" :messages="$errors->get('email')" />
                </div>
                <div class="pt-2">
                    <button type="submit"
                            class="inline-flex items-center px-10 py-4 bg-black text-white text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gray-800 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- ── CHANGE PASSWORD ───────────────────────────────────────────── --}}
        <div class="bg-white p-10 xl:p-12">
            <div class="flex items-start gap-3 mb-10">
                <div class="w-8 h-8 border border-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] mb-1">Security</p>
                    <h3 class="text-xl font-bold text-gray-900 tracking-tight">Change Password</h3>
                </div>
            </div>
            <form method="post" action="{{ route('password.update') }}" class="space-y-9 max-w-sm">
                @csrf
                @method('put')
                <div>
                    <label for="update_password_current_password" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Current Password</label>
                    <input id="update_password_current_password" name="current_password" type="password"
                           autocomplete="current-password"
                           class="w-full bg-transparent border-0 border-b border-gray-200 py-3.5 px-0 text-[15px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-[11px] font-bold uppercase tracking-widest text-red-400" />
                </div>
                <div>
                    <label for="update_password_password" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">New Password</label>
                    <input id="update_password_password" name="password" type="password"
                           autocomplete="new-password"
                           class="w-full bg-transparent border-0 border-b border-gray-200 py-3.5 px-0 text-[15px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-[11px] font-bold uppercase tracking-widest text-red-400" />
                </div>
                <div>
                    <label for="update_password_password_confirmation" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Confirm New Password</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                           autocomplete="new-password"
                           class="w-full bg-transparent border-0 border-b border-gray-200 py-3.5 px-0 text-[15px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-[11px] font-bold uppercase tracking-widest text-red-400" />
                </div>
                <div class="pt-2">
                    <button type="submit"
                            class="inline-flex items-center px-10 py-4 bg-black text-white text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gray-800 transition-colors">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- ── DANGER ZONE ───────────────────────────────────────────────────── --}}
    <div class="border border-red-100 p-8 md:p-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 border border-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3.5 h-3.5 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-red-400 uppercase tracking-[0.5em] mb-1.5">Danger Zone</p>
                    <h4 class="text-lg font-bold text-gray-900 mb-2 tracking-tight">Delete Account</h4>
                    <p class="text-[13px] text-gray-400 font-medium max-w-sm leading-relaxed">Permanently removes your account and all associated data. This action cannot be undone.</p>
                </div>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('This will permanently delete your account. Proceed?')">
                @csrf
                @method('delete')
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <input type="password" name="password" placeholder="Confirm with password"
                           class="bg-transparent border-0 border-b border-red-100 py-3 px-0 text-[13px] text-gray-700 focus:ring-0 focus:border-red-300 transition-colors placeholder-gray-300 font-medium min-w-[220px]">
                    <button type="submit"
                            class="px-8 py-3 border border-red-200 text-red-400 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-red-500 hover:text-white hover:border-red-500 transition-all whitespace-nowrap">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-account-layout>
