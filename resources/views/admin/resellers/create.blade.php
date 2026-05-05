<x-app-layout title="Add Reseller">

    <div class="max-w-full">

        <a href="{{ route('admin.resellers.index') }}"
           class="inline-flex items-center gap-1.5 text-[11px] font-black uppercase tracking-widest text-gray-400 hover:text-black mb-6 transition-all duration-300 hover:-translate-x-1">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Resellers
        </a>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50/80 bg-gray-50/20">
                <h1 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.1em]">Register New Reseller</h1>
                <p class="text-[11px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Create authorized reseller account</p>
            </div>

            <form action="{{ route('admin.resellers.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Full Name <span class="text-red-500">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autofocus
                                placeholder="e.g. Ahmad Rizal"
                                class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border rounded-xl transition-all duration-300
                                       focus:outline-none focus:ring-black focus:border-black placeholder:text-gray-400 uppercase tracking-widest
                                       {{ $errors->has('name') ? 'border-red-400' : 'border-gray-100' }}">
                        @error('name')
                            <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                                placeholder="reseller@example.com"
                                class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border rounded-xl transition-all duration-300
                                       focus:outline-none focus:ring-black focus:border-black placeholder:text-gray-400 uppercase tracking-widest
                                       {{ $errors->has('email') ? 'border-red-400' : 'border-gray-100' }}">
                        @error('email')
                            <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Commission Rate --}}
                    <div>
                        <label for="commission_rate" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Commission Rate (%) <span class="text-red-500">*</span></label>
                        <input id="commission_rate" name="commission_rate" type="number" step="0.01" value="{{ old('commission_rate', 15.00) }}"
                                placeholder="e.g. 15.00"
                                class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border rounded-xl transition-all duration-300
                                       focus:outline-none focus:ring-black focus:border-black placeholder:text-gray-400 uppercase tracking-widest
                                       {{ $errors->has('commission_rate') ? 'border-red-400' : 'border-gray-100' }}">
                        @error('commission_rate')
                            <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-gray-100 my-6"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Password <span class="text-red-500">*</span></label>
                        <input id="password" name="password" type="password"
                                placeholder="Min. 8 characters"
                                class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border rounded-xl transition-all duration-300
                                       focus:outline-none focus:ring-black focus:border-black placeholder:text-gray-400
                                       {{ $errors->has('password') ? 'border-red-400' : 'border-gray-100' }}">
                        @error('password')
                            <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Confirm Password <span class="text-red-500">*</span></label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="Re-type password"
                                class="w-full px-4 py-3 text-[14px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-xl transition-all duration-300
                                       focus:outline-none focus:ring-black focus:border-black placeholder:text-gray-400">
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                    <a href="{{ route('admin.resellers.index') }}"
                       class="px-8 py-3 text-[11px] font-black uppercase tracking-widest text-gray-400 hover:text-black bg-white border border-gray-100 hover:bg-gray-50 rounded-xl transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-black hover:bg-gray-900
                                   text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        <span>Create Account</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
