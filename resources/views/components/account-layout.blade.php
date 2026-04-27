<x-storefront-layout :hasHero="false">
    <x-slot name="title">My Account</x-slot>

    @php
        $initials = collect(explode(' ', Auth::user()->name))
            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
            ->take(2)->implode('');
    @endphp

    <div class="bg-white min-h-screen">

        {{-- ── PAGE HEADER ─────────────────────────────────────────────── --}}
        <div class="border-b border-gray-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-0">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8">

                    {{-- Avatar + Name --}}
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center flex-shrink-0">
                            <span class="font-luxury text-lg text-white tracking-widest">{{ $initials }}</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.45em] mb-1">My Account</p>
                            <h1 class="font-luxury text-2xl md:text-3xl tracking-tight text-gray-900 leading-none">{{ Auth::user()->name }}</h1>
                            <p class="text-[11px] text-gray-400 font-medium tracking-[0.15em] uppercase mt-1.5">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    {{-- Sign Out --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-[10px] font-bold text-gray-400 hover:text-black uppercase tracking-[0.3em] transition-colors pb-0.5 border-b border-gray-200 hover:border-black">
                            Sign Out
                        </button>
                    </form>
                </div>

                {{-- ── TAB NAVIGATION ───────────────────────────────────────── --}}
                <nav class="flex overflow-x-auto scrollbar-hide -mb-px">
                    <a href="{{ route('account.index') }}"
                       class="flex-shrink-0 px-1 mr-8 pt-2 pb-4 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-200 border-b-2 whitespace-nowrap
                              {{ request()->routeIs('account.index') ? 'text-black border-black' : 'text-gray-400 border-transparent hover:text-gray-700 hover:border-gray-300' }}">
                        Overview
                    </a>
                    <a href="{{ route('account.orders') }}"
                       class="flex-shrink-0 px-1 mr-8 pt-2 pb-4 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-200 border-b-2 whitespace-nowrap
                              {{ request()->routeIs('account.orders') ? 'text-black border-black' : 'text-gray-400 border-transparent hover:text-gray-700 hover:border-gray-300' }}">
                        Orders
                    </a>
                    <a href="{{ route('account.addresses') }}"
                       class="flex-shrink-0 px-1 mr-8 pt-2 pb-4 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-200 border-b-2 whitespace-nowrap
                              {{ request()->routeIs('account.addresses') ? 'text-black border-black' : 'text-gray-400 border-transparent hover:text-gray-700 hover:border-gray-300' }}">
                        Addresses
                    </a>
                    <a href="{{ route('account.wishlist') }}"
                       class="flex-shrink-0 px-1 mr-8 pt-2 pb-4 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-200 border-b-2 whitespace-nowrap
                              {{ request()->routeIs('account.wishlist') ? 'text-black border-black' : 'text-gray-400 border-transparent hover:text-gray-700 hover:border-gray-300' }}">
                        Wishlist
                    </a>
                    <a href="{{ route('account.settings') }}"
                       class="flex-shrink-0 px-1 pt-2 pb-4 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-200 border-b-2 whitespace-nowrap
                              {{ request()->routeIs('account.settings') ? 'text-black border-black' : 'text-gray-400 border-transparent hover:text-gray-700 hover:border-gray-300' }}">
                        Settings
                    </a>
                </nav>
            </div>
        </div>

        {{-- ── PAGE CONTENT ─────────────────────────────────────────────── --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            {{ $slot }}
        </div>

    </div>
</x-storefront-layout>
