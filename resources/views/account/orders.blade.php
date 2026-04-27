<x-account-layout>

    {{-- ── PAGE HEADER ──────────────────────────────────────────────────── --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-14 pb-10 border-b border-gray-100">
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.5em] mb-3">Purchase History</p>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-none tracking-tight">Orders</h2>
        </div>
        <a href="{{ route('storefront.collection') }}"
           class="inline-flex items-center gap-3 text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 hover:text-black border-b border-gray-200 hover:border-black pb-0.5 transition-all whitespace-nowrap group">
            Continue Shopping
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="py-40 text-center">
            <p class="font-luxury text-4xl text-gray-200 mb-4 tracking-tight">Your order history is empty</p>
            <p class="text-[12px] text-gray-300 font-medium mb-10 tracking-wide">Completed purchases will appear here.</p>
            <a href="{{ route('storefront.collection') }}"
               class="inline-flex items-center gap-3 text-[11px] font-bold uppercase tracking-[0.4em] text-black border-b border-black pb-1 hover:opacity-50 transition-opacity group">
                Discover the Collection
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    @else
        <div class="divide-y divide-gray-100">
            @foreach($orders as $order)
                <div class="py-12 group/order">

                    {{-- Order Meta Row --}}
                    <div class="flex flex-wrap items-start justify-between gap-6 mb-10">
                        <div class="flex flex-wrap gap-x-10 gap-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-1.5">Order</p>
                                <p class="text-[15px] font-bold text-gray-900 tracking-tight">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-1.5">Placed</p>
                                <p class="text-[14px] text-gray-600 font-bold tracking-tight">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-1.5">Status</p>
                                <span class="inline-flex items-center px-2.5 py-1 border text-[9px] font-bold uppercase tracking-[0.2em]
                                    @if($order->status === 'delivered') border-emerald-200 text-emerald-700 bg-emerald-50
                                    @elseif($order->status === 'cancelled') border-red-200 text-red-700 bg-red-50
                                    @else border-amber-200 text-amber-700 bg-amber-50 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            @if(in_array($order->status, ['pending', 'paid']))
                                <div class="flex items-end">
                                    <form action="{{ route('account.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                        @csrf
                                        <button type="submit" class="text-[10px] font-bold text-red-400 hover:text-red-600 uppercase tracking-[0.2em] transition-colors border-b border-red-100 hover:border-red-600 pb-0.5">
                                            Cancel Order
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-1.5">Total</p>
                            <p class="text-2xl font-bold text-gray-900 tracking-tight">RM {{ number_format($order->total_price, 2) }}</p>
                        </div>
                    </div>

                    {{-- Status Stepper --}}
                    @if($order->status !== 'cancelled')
                    <div class="mb-12">
                        @php
                            $statusOrder = ['pending', 'paid', 'processing', 'shipped', 'delivered'];
                            $currentIdx = array_search($order->status, $statusOrder);
                            $steps = [
                                'pending'    => 'Placed',
                                'paid'       => 'Paid',
                                'processing' => 'Processing',
                                'shipped'    => 'Shipped',
                                'delivered'  => 'Delivered',
                            ];
                        @endphp
                        <div class="relative flex justify-between items-center w-full max-w-2xl">
                            <div class="absolute top-1/2 left-0 w-full h-[1px] bg-gray-100 -translate-y-1/2"></div>
                            @foreach($statusOrder as $idx => $s)
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $idx <= $currentIdx ? 'bg-black' : 'bg-gray-200' }} transition-colors duration-500"></div>
                                    <p class="text-[8px] font-bold uppercase tracking-widest mt-3 {{ $idx <= $currentIdx ? 'text-black' : 'text-gray-300' }}">
                                        {{ $steps[$s] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Order Items --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        <div class="lg:col-span-2 space-y-5">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-5">
                                    {{-- Product Image --}}
                                    <div class="w-[60px] h-[60px] flex-shrink-0 border border-gray-100 bg-gray-50/50 flex items-center justify-center p-2">
                                        <img src="{{ $item->product->primaryImage
                                            ? asset('storage/' . $item->product->primaryImage->image_path)
                                            : 'https://placehold.co/80x80/f9fafb/d1d5db?text=' . urlencode(substr($item->product->name, 0, 1)) }}"
                                             class="w-full h-full object-contain mix-blend-multiply"
                                             alt="{{ $item->product->name }}">
                                    </div>
                                    {{-- Product Info --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[14px] font-bold text-gray-900 tracking-tight truncate">{{ $item->product->name }}</p>
                                        <p class="text-[11px] text-gray-400 font-medium mt-0.5">
                                            Qty {{ $item->quantity }}
                                            <span class="mx-1.5 text-gray-200">·</span>
                                            RM {{ number_format($item->price, 2) }} each
                                        </p>
                                    </div>
                                    {{-- Line Total --}}
                                    <p class="text-[14px] font-bold text-gray-800 flex-shrink-0">RM {{ number_format($item->quantity * $item->price, 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        {{-- Dispatch Address --}}
                        @if($order->shippingAddress)
                            <div class="lg:col-span-1">
                                <div class="border border-gray-100 p-6">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.4em] mb-4">Dispatched To</p>
                                    <div class="space-y-0.5">
                                        <p class="text-[13px] font-bold text-gray-800">{{ $order->shippingAddress->full_name }}</p>
                                        <p class="text-[13px] text-gray-400 font-medium">{{ $order->shippingAddress->address }}</p>
                                        <p class="text-[13px] text-gray-400 font-medium">{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->postal_code }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        @if($orders->hasPages())
            <div class="mt-16 pt-10 border-t border-gray-100 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    @endif

</x-account-layout>
