<x-account-layout>
    <div x-data="{ open: false }">

        {{-- ── PAGE HEADER ──────────────────────────────────────────────── --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-14 pb-10 border-b border-gray-100">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.5em] mb-3">Saved Locations</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-none tracking-tight">Addresses</h2>
            </div>
            <button @click="open = true"
                    class="inline-flex items-center gap-3 px-10 py-4 bg-black text-white text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gray-800 transition-colors">
                + Add Address
            </button>
        </div>

        {{-- ── ADD ADDRESS MODAL ──────────────────────────────────────────── --}}
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div @click.away="open = false"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="bg-white w-full max-w-2xl border border-gray-100 shadow-2xl overflow-hidden">
                <div class="flex justify-between items-center px-10 py-8 border-b border-gray-100">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] mb-1">New Entry</p>
                        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Add Address</h3>
                    </div>
                    <button @click="open = false" class="p-2 text-gray-300 hover:text-black transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form action="{{ route('account.addresses.store') }}" method="POST" class="px-10 py-8">
                    @csrf
                    <div class="grid grid-cols-2 gap-x-8 gap-y-7 mb-8">
                        <div class="col-span-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Label (e.g. Home, Office)</label>
                            <input type="text" name="label" placeholder="Home" class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] text-gray-900 font-bold focus:ring-0 focus:border-black transition-colors placeholder-gray-200">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Recipient Name</label>
                            <input type="text" name="recipient_name" required class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Phone Number</label>
                            <input type="text" name="phone" required class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                        </div>
                        <div class="col-span-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Street Address</label>
                            <input type="text" name="address_line_1" required placeholder="Street name and building number" class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors placeholder-gray-200">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">City</label>
                            <input type="text" name="city" required class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">Postcode</label>
                            <input type="text" name="postal_code" required class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                        </div>
                        <div class="col-span-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] block mb-3">State</label>
                            <input type="text" name="state" required class="w-full bg-transparent border-0 border-b border-gray-200 py-3 px-0 text-[14px] font-bold text-gray-900 focus:ring-0 focus:border-black transition-colors">
                        </div>
                        <div class="col-span-2 flex items-center gap-4 pt-1">
                            <input type="checkbox" name="is_default" id="is_default" value="1" class="w-4 h-4 rounded-none border-gray-200 text-black focus:ring-0 focus:ring-offset-0 cursor-pointer">
                            <label for="is_default" class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] cursor-pointer">Set as default shipping address</label>
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-8 pt-6 border-t border-gray-100">
                        <button type="button" @click="open = false" class="text-[10px] font-bold uppercase tracking-[0.4em] text-gray-400 hover:text-black transition-colors">Cancel</button>
                        <button type="submit" class="px-10 py-4 bg-black text-white text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gray-800 transition-colors">Save Address</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── ADDRESS CARDS ─────────────────────────────────────────────── --}}
        @if($addresses->isEmpty())
            <div class="py-40 text-center">
                <div class="w-16 h-16 border border-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-6 h-6 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                    </svg>
                </div>
                <p class="font-luxury text-3xl text-gray-200 mb-3 tracking-tight">No addresses saved</p>
                <p class="text-[12px] text-gray-300 font-medium mb-8 tracking-wide">Add an address to speed up checkout.</p>
                <button @click="open = true" class="text-[11px] font-bold uppercase tracking-[0.4em] text-black border-b border-black pb-1 hover:opacity-50 transition-opacity">
                    Add Your First Address
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($addresses as $address)
                    <div class="relative border border-gray-100 p-8 hover:border-gray-900 hover:shadow-sm transition-all duration-300 group">

                        {{-- Default badge --}}
                        @if($address->is_default)
                            <span class="absolute top-5 right-5 text-[9px] font-bold text-black uppercase tracking-[0.35em] border border-black px-2 py-0.5">Default</span>
                        @endif

                        {{-- Icon --}}
                        <div class="w-9 h-9 border border-gray-100 flex items-center justify-center mb-6 group-hover:border-gray-300 transition-colors">
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>

                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] mb-3">{{ $address->label ?? 'Address' }}</p>
                        <p class="text-lg font-bold text-gray-900 mb-1 leading-tight tracking-tight">{{ $address->recipient_name }}</p>
                        <p class="text-[12px] text-gray-400 font-medium mb-5 tracking-wide">{{ $address->phone }}</p>

                        <div class="space-y-0.5 mb-8 pb-8 border-b border-gray-100">
                            <p class="text-[13px] text-gray-500 font-medium">{{ $address->address_line_1 }}</p>
                            <p class="text-[13px] text-gray-500 font-medium">{{ $address->city }}, {{ $address->postal_code }}</p>
                            @if($address->state)
                                <p class="text-[13px] text-gray-400 font-medium uppercase tracking-wide">{{ $address->state }}</p>
                            @endif
                        </div>

                        <form action="{{ route('account.addresses.delete', $address) }}" method="POST"
                              onsubmit="return confirm('Remove this address? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-300 hover:text-red-400 transition-colors">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-account-layout>
