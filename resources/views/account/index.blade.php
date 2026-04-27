<x-account-layout>

    {{-- ── WELCOME GREETING ─────────────────────────────────────────────── --}}
    @php
        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
        $firstName = explode(' ', Auth::user()->name)[0];
    @endphp
    <div class="mb-12">
        <p class="font-luxury text-2xl md:text-3xl text-gray-800 leading-snug">
            {{ $greeting }}, {{ $firstName }}.
        </p>
        <p class="text-[12px] text-gray-400 font-medium mt-2 tracking-wide">Here's a summary of your account.</p>
    </div>

    {{-- ── STAT CARDS ───────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-gray-100 border border-gray-100 mb-14">

        {{-- Latest Order --}}
        <div class="bg-white p-10 group hover:bg-gray-50/60 transition-colors duration-300">
            <div class="flex items-center justify-between mb-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em]">Latest Order</p>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-gray-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"/>
                </svg>
            </div>
            @if($latestOrder)
                <p class="text-4xl font-black text-gray-900 mb-1 tracking-tight">RM {{ number_format($latestOrder->total_price, 2) }}</p>
                <div class="flex items-center gap-3 mb-8 mt-2">
                    <p class="text-[11px] text-gray-400 font-medium uppercase tracking-[0.15em]">{{ $latestOrder->created_at->format('d M Y') }}</p>
                    <span class="inline-flex items-center px-2 py-0.5 border text-[9px] font-bold uppercase tracking-[0.2em]
                        {{ $latestOrder->status === 'paid' ? 'border-emerald-200 text-emerald-600 bg-emerald-50' : 'border-amber-200 text-amber-600 bg-amber-50' }}">
                        {{ ucfirst($latestOrder->status) }}
                    </span>
                </div>
                <a href="{{ route('account.orders') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.3em] text-black border-b border-black pb-0.5 hover:opacity-40 transition-opacity">
                    View History
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @else
                <p class="text-2xl font-bold text-gray-200 mb-8 tracking-tight">No orders yet</p>
                <a href="{{ route('storefront.collection') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.3em] text-black border-b border-black pb-0.5 hover:opacity-40 transition-opacity">
                    Shop Now
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @endif
        </div>

        {{-- Default Address --}}
        <div class="bg-white p-10 group hover:bg-gray-50/60 transition-colors duration-300">
            <div class="flex items-center justify-between mb-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em]">Shipping Address</p>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-gray-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                </svg>
            </div>
            @if($defaultAddress)
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">{{ $defaultAddress->label ?? 'Default' }}</p>
                <p class="text-xl font-bold text-gray-900 mb-1 tracking-tight">{{ $defaultAddress->recipient_name }}</p>
                <p class="text-[13px] text-gray-400 font-medium leading-relaxed">{{ $defaultAddress->address_line_1 }}</p>
                <p class="text-[13px] text-gray-400 font-medium leading-relaxed mb-8">{{ $defaultAddress->city }}, {{ $defaultAddress->postal_code }}</p>
                <a href="{{ route('account.addresses') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.3em] text-black border-b border-black pb-0.5 hover:opacity-40 transition-opacity">
                    Manage
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @else
                <p class="text-2xl font-bold text-gray-200 mb-8 tracking-tight">None saved</p>
                <a href="{{ route('account.addresses') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.3em] text-black border-b border-black pb-0.5 hover:opacity-40 transition-opacity">
                    Add Address
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @endif
        </div>

        {{-- Loyalty Points --}}
        <div class="bg-white p-10 group hover:bg-gray-50/60 transition-colors duration-300">
            <div class="flex items-center justify-between mb-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em]">Loyalty Rewards</p>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-amber-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-4xl font-black text-gray-900 mb-1 tracking-tight">{{ number_format(Auth::user()->loyalty_points) }} <span class="text-lg font-bold text-gray-400">pts</span></p>
            <p class="text-[11px] text-emerald-600 font-bold tracking-[0.25em] uppercase mb-8">
                Signature Member
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.25em] border border-gray-100 px-2.5 py-1">100 pts = RM 1</span>
                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.25em] border border-gray-100 px-2.5 py-1">Next Tier at 5,000</span>
            </div>
        </div>

    </div>

    {{-- ── QUICK LINKS ───────────────────────────────────────────────────── --}}
    <div>
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.5em] mb-8">Quick Access</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <a href="{{ route('storefront.collection') }}" class="group block">
                <div class="flex items-end justify-between border-b border-gray-100 pb-5 group-hover:border-black transition-all duration-300">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-2 group-hover:text-black transition-colors">Catalog</p>
                        <p class="text-xl font-bold text-gray-900 tracking-tight">Shop Collection</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-black group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('account.orders') }}" class="group block">
                <div class="flex items-end justify-between border-b border-gray-100 pb-5 group-hover:border-black transition-all duration-300">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-2 group-hover:text-black transition-colors">Records</p>
                        <p class="text-xl font-bold text-gray-900 tracking-tight">Order History</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-black group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('account.settings') }}" class="group block">
                <div class="flex items-end justify-between border-b border-gray-100 pb-5 group-hover:border-black transition-all duration-300">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-2 group-hover:text-black transition-colors">Identity</p>
                        <p class="text-xl font-bold text-gray-900 tracking-tight">Account Settings</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-black group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </a>

        </div>
    </div>

</x-account-layout>
