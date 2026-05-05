<x-app-layout title="Partner Workspace">
    <div class="min-h-screen bg-gray-50/30">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tighter">Partner Workspace</h1>
                <p class="text-sm font-bold text-gray-500 mt-1 uppercase tracking-widest text-[10px]">Strategic Business Environment & Earnings Architecture</p>
            </div>
            

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            {{-- Lifetime Revenue --}}
            <div class="bg-white rounded-[2rem] p-7 shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-700 shadow-sm">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div class="h-12 w-28"><canvas id="sparklineTotalRev"></canvas></div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lifetime Volume</p>
                <h3 class="text-3xl font-black text-gray-900 tabular-nums tracking-tighter">RM{{ number_format($myTotalRevenue, 0) }}</h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ number_format($myTotalSales) }} Transactions</span>
                </div>
            </div>

            {{-- Monthly Velocity --}}
            <div class="bg-white rounded-[2rem] p-7 shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-700 shadow-sm">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="h-12 w-28"><canvas id="sparklineMonthly"></canvas></div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Current Month</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-3xl font-black text-gray-900 tabular-nums tracking-tighter">RM{{ number_format($thisMonthRevenue, 0) }}</h3>
                    @if($revenueChange !== null)
                        <span class="flex items-center text-[10px] font-black {{ $revenueChange >= 0 ? 'text-emerald-500 bg-emerald-50' : 'text-rose-500 bg-rose-50' }} px-2.5 py-1 rounded-xl uppercase tracking-wider shadow-sm">
                            {{ $revenueChange >= 0 ? '↑' : '↓' }} {{ abs($revenueChange) }}%
                        </span>
                    @endif
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Revenue Velocity</span>
                </div>
            </div>

            {{-- Estimated Earnings --}}
            <div class="bg-white rounded-[2rem] p-7 shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-700 shadow-sm">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="h-12 w-28"><canvas id="sparklineEarnings"></canvas></div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">My Earnings</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-3xl font-black text-gray-900 tabular-nums tracking-tighter">RM{{ number_format($myCommission, 0) }}</h3>
                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.2em] border-b-2 border-emerald-500/20 pb-0.5">Commission</span>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Active Partner Benefits</span>
                </div>
            </div>

            {{-- Inventory Level --}}
            <div class="bg-white rounded-[2rem] p-7 shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-700 shadow-sm">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                    </div>
                    <div class="h-12 w-28"><canvas id="sparklineStock"></canvas></div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Personal Stock</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-3xl font-black text-gray-900 tabular-nums tracking-tighter">{{ number_format($myTotalUnits) }}</h3>
                    <span class="text-[9px] font-black {{ $lowStockProducts->count() > 0 ? 'text-amber-500 bg-amber-50' : 'text-gray-400 bg-gray-50' }} px-2 py-1 rounded-lg uppercase tracking-wider">
                        {{ $lowStockProducts->count() > 0 ? 'Action Needed' : 'Stable' }}
                    </span>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Inventory Core</span>
                </div>
            </div>
        </div>

        {{-- 3. STRATEGIC INTELLIGENCE SECTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            {{-- Strategic Insights --}}
            <div class="bg-black text-white rounded-[2rem] p-8 shadow-xl shadow-black/10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -m-8 w-48 h-48 bg-white/5 rounded-full blur-3xl group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse shadow-[0_0_10px_rgba(99,102,241,0.8)]"></span>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Strategic Insights</h3>
                </div>
                <div class="space-y-6 relative z-10">
                    @foreach($insights as $insight)
                        <div class="flex items-start gap-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-2 shrink-0"></div>
                            <p class="text-sm font-bold leading-relaxed text-gray-100">{{ $insight }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Goal Progress --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)] relative group" x-data="{ editing: false }">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Monthly Revenue Goal</h3>
                    <button @click="editing = true" class="text-[10px] font-black text-indigo-600 hover:underline uppercase tracking-widest transition-all">Adjust Target</button>
                </div>

                @if($monthlyGoal > 0)
                    <div class="flex flex-col md:flex-row items-center justify-around gap-8">
                        <div class="relative w-36 h-36 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="72" cy="72" r="68" stroke="currentColor" stroke-width="8" fill="transparent" class="text-gray-50"/>
                                <circle cx="72" cy="72" r="68" stroke="currentColor" stroke-width="8" fill="transparent" class="text-black" stroke-dasharray="{{ 2 * pi() * 68 }}" stroke-dashoffset="{{ (1 - ($goalProgress / 100)) * (2 * pi() * 68) }}" style="transition: stroke-dashoffset 1s ease-in-out;"/>
                            </svg>
                            <div class="absolute flex flex-col items-center">
                                <span class="text-3xl font-black text-gray-900 tracking-tighter">{{ $goalProgress }}%</span>
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Efficiency</span>
                            </div>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="text-sm font-black text-gray-900 uppercase tracking-wider mb-2">Current Target</p>
                            <h4 class="text-2xl font-black text-indigo-600 tracking-tighter">RM{{ number_format($monthlyGoal, 0) }}</h4>
                            <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">RM{{ number_format($thisMonthRevenue, 2) }} Earned</p>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-10">
                        <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">No Goal Set</p>
                        <button @click="editing = true" class="bg-black text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-black/20 hover:-translate-y-0.5 transition-all">Set Monthly Target</button>
                    </div>
                @endif

                {{-- Goal Edit Overlay --}}
                <div x-show="editing" x-cloak class="absolute inset-0 bg-white/95 backdrop-blur-sm z-20 p-8 flex flex-col justify-center animate-in fade-in zoom-in duration-200 rounded-[2rem]">
                    <form action="{{ route('reseller.dashboard.goal') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 block text-center">Monthly Revenue Goal (RM)</label>
                            <input type="number" name="monthly_goal" value="{{ $monthlyGoal }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-4 text-center text-2xl font-black focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white text-[11px] font-black uppercase tracking-widest py-3.5 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Update Goal</button>
                            <button type="button" @click="editing = false" class="px-6 bg-gray-100 text-gray-600 text-[11px] font-black uppercase tracking-widest py-3.5 rounded-xl hover:bg-gray-200 transition-all">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 4. SALES COMMAND CENTER --}}
        <div class="mb-10">
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider">Personal Sales Trend</h3>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mt-1">Daily Revenue & Volume Analysis</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                            <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest">Revenue</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-indigo-200"></span>
                            <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest">Units</span>
                        </div>
                    </div>
                </div>
                <div class="h-[400px] relative">
                    <canvas id="mainSalesChart"></canvas>
                </div>
        </div>


        {{-- 5. SECONDARY CHARTS & INVENTORY ROW --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-10">
            {{-- Volume Performance (Horizontal Bar) --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider">Volume Leaderboard</h3>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mt-1">Units Sold by SKU</p>
                    </div>
                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-xl">Top Sellers</span>
                </div>
                <div class="h-[280px] relative">
                    <canvas id="topSellersChart"></canvas>
                </div>
            </div>

            {{-- Weekly Velocity --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col group hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-500">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider">Weekly Activity</h3>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mt-1">Sales Velocity by Day</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                        <span class="text-[9px] font-black text-emerald-600 uppercase">Personal</span>
                    </div>
                </div>
                <div class="h-[280px] relative">
                    <canvas id="weeklyVelocityChart"></canvas>
                </div>
            </div>

            {{-- Category Focus --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col group hover:shadow-xl hover:shadow-purple-500/5 transition-all duration-500">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider">Category Focus</h3>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mt-1">Market Distribution</p>
                    </div>
                </div>
                <div class="h-[280px] relative">
                    <canvas id="categoryFocusChart"></canvas>
                </div>
            </div>

            {{-- Earnings Breakdown --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider mb-8">Earnings Breakdown</h3>
                <div class="h-[200px] relative flex items-center justify-center">
                    <canvas id="earningsBreakdownChart"></canvas>
                    <div class="absolute flex flex-col items-center pointer-events-none">
                        <span class="text-2xl font-black text-gray-900">RM{{ number_format($thisMonthRevenue, 0) }}</span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">This Month</span>
                    </div>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="flex flex-col items-center p-3 bg-gray-50 rounded-2xl">
                        <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Commission</p>
                        <span class="text-xs font-black text-emerald-600">RM{{ number_format($thisMonthRevenue * 0.15, 0) }}</span>
                    </div>
                    <div class="flex flex-col items-center p-3 bg-gray-50 rounded-2xl">
                        <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Orders</p>
                        <span class="text-xs font-black text-gray-900">{{ $myRecentSales->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 6. INVENTORY HEALTH RADAR --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden mb-10">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider">My Inventory Radar</h3>
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mt-1">Personal SKU Stock Analysis</p>
                </div>
                <a href="{{ route('reseller.orders.create') }}" class="text-[10px] font-black text-indigo-600 hover:underline uppercase tracking-widest">Purchase Stock</a>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($lowStockProducts->take(4) as $p)
                        @php
                            $percent = min(max(($p->quantity / 50) * 100, 5), 100); 
                            $statusColor = $p->quantity <= 5 ? 'bg-rose-500' : ($p->quantity < 15 ? 'bg-amber-500' : 'bg-emerald-500');
                            $textColor = $p->quantity <= 5 ? 'text-rose-600' : ($p->quantity < 15 ? 'text-amber-600' : 'text-emerald-600');
                        @endphp
                        <div class="flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <div class="max-w-[70%]">
                                    <p class="text-[11px] font-black text-gray-900 uppercase truncate">{{ $p->product?->name }}</p>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $p->product?->volume_ml }}ml Edition</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-black {{ $textColor }}">{{ $p->quantity }}</span>
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Units</p>
                                </div>
                            </div>
                            <div class="w-full h-1.5 bg-gray-50 rounded-full overflow-hidden">
                                <div class="h-full rounded-full {{ $statusColor }} transition-all duration-1000 shadow-[0_0_8px_rgba(0,0,0,0.1)]" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 flex flex-col items-center justify-center py-4 opacity-50">
                            <svg class="w-10 h-10 text-emerald-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Personal Stock Levels Optimal</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- 6. RECENT SALES LEDGER --}}
        <div class="mb-6 flex items-end justify-between px-2">
            <div>
                <h2 class="text-xl font-extrabold text-gray-900 tracking-tight uppercase">Sales Ledger</h2>
                <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Personal Transaction Architecture</p>
            </div>
            <a href="{{ route('reseller.sales.index') }}" class="text-[10px] font-black text-gray-400 hover:text-black uppercase tracking-widest transition-colors">View All</a>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Transaction Date</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Product Intelligence</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Qty</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Revenue</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Momentum</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($myRecentSales->take(5) as $sale)
                            <tr class="hover:bg-indigo-50/20 transition-all group">
                                <td class="px-8 py-5">
                                    <p class="text-sm font-bold text-gray-900">{{ $sale->created_at->format('d M, Y') }}</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mt-0.5">{{ $sale->created_at->format('h:i A') }}</p>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-sm font-bold text-gray-900">{{ $sale->product->name }}</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $sale->product->volume_ml }}ml Edition</p>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="inline-flex items-center justify-center min-w-[2.5rem] h-7 bg-white border border-gray-200 rounded-lg text-xs font-black text-gray-900 shadow-sm">
                                        {{ $sale->quantity }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <p class="text-sm font-extrabold text-gray-900">RM{{ number_format($sale->total_price, 2) }}</p>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end">
                                        <div class="w-16 h-6">
                                            <canvas class="table-sparkline" data-values="{{ json_encode([rand(10,50), rand(30,70), rand(20,60), rand(50,90), rand(40,80), rand(70,100), rand(60,110)]) }}"></canvas>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-16 text-center">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]">No transactions recorded yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- CHART.JS ARCHITECTURE --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        // Global Defaults
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.font.weight = '600';
        Chart.defaults.font.size = 11;

        const tooltipStyle = {
            backgroundColor: '#1e293b',
            titleFont: { size: 12, weight: 'bold' },
            padding: 12,
            cornerRadius: 12,
            displayColors: false
        };

        // Helper: Sparkline
        const createSparkline = (id, data, color) => {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map((_, i) => i),
                    datasets: [{
                        data: data,
                        borderColor: color,
                        borderWidth: 2,
                        pointRadius: 0,
                        tension: 0.4,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: { x: { display: false }, y: { display: false } }
                }
            });
        };

        // 1. KPI Sparklines
        createSparkline('sparklineTotalRev', @json($sparkRevenue), '#6366f1');
        createSparkline('sparklineMonthly', @json($sparkRevenue), '#3b82f6');
        createSparkline('sparklineEarnings', @json($sparkRevenue->map(fn($v) => $v * 0.15)), '#10b981');
        createSparkline('sparklineStock', @json($sparkUnits), '#f59e0b');

        // 2. Main Sales Trend
        const mainCtx = document.getElementById('mainSalesChart').getContext('2d');
        const mainGradient = mainCtx.createLinearGradient(0, 0, 0, 350);
        mainGradient.addColorStop(0, 'rgba(99, 102, 241, 0.08)');
        mainGradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

        new Chart(mainCtx, {
            type: 'line',
            data: {
                labels: @json($trendLabels),
                datasets: [
                    {
                        label: 'Revenue',
                        data: @json($trendRevenue),
                        borderColor: '#6366f1',
                        backgroundColor: mainGradient,
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Units',
                        data: @json($trendUnits),
                        borderColor: '#c7d2fe',
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: tooltipStyle
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false },
                        ticks: { 
                            callback: v => 'RM' + v.toLocaleString(),
                            font: { weight: 'bold' }
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { display: false },
                        ticks: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { maxTicksLimit: 7, font: { weight: 'bold' } }
                    }
                }
            }
        });

        // 3. Top Sellers Bar (Horizontal)
        const barCtx = document.getElementById('topSellersChart').getContext('2d');
        const barGradient = barCtx.createLinearGradient(0, 0, 400, 0);
        barGradient.addColorStop(0, '#6366f1');
        barGradient.addColorStop(1, '#a78bfa');

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: @json($topProductLabels),
                datasets: [{
                    data: @json($topProductData),
                    backgroundColor: barGradient,
                    borderRadius: 20,
                    borderSkipped: false,
                    barThickness: 12,
                    hoverBackgroundColor: '#4f46e5'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false }, 
                    tooltip: tooltipStyle 
                },
                scales: {
                    x: { 
                        display: false,
                        grid: { display: false }
                    },
                    y: { 
                        grid: { display: false }, 
                        ticks: { 
                            font: { size: 10, weight: 'black' },
                            color: '#111827'
                        } 
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // 4. Earnings Donut
        const donutCtx = document.getElementById('earningsBreakdownChart').getContext('2d');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: @json($topProductLabels->take(3)),
                datasets: [{
                    data: @json($topProductRev->take(3)),
                    backgroundColor: ['#6366f1', '#8b5cf6', '#a78bfa'],
                    borderWidth: 0,
                    hoverOffset: 12,
                    spacing: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '82%',
                plugins: { 
                    legend: { display: false }, 
                    tooltip: tooltipStyle 
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 2500,
                    easing: 'easeOutQuart'
                }
            }
        });

        // 5. Weekly Velocity Chart
        const weeklyCtx = document.getElementById('weeklyVelocityChart').getContext('2d');
        const weeklyGradient = weeklyCtx.createLinearGradient(0, 0, 0, 300);
        weeklyGradient.addColorStop(0, '#10b981');
        weeklyGradient.addColorStop(1, '#34d399');

        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    data: @json($weeklyVelocityData),
                    backgroundColor: weeklyGradient,
                    borderRadius: 10,
                    barThickness: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: tooltipStyle },
                scales: {
                    y: { display: false, grid: { display: false } },
                    x: { grid: { display: false }, ticks: { font: { size: 9, weight: 'bold' } } }
                }
            }
        });

        // 6. Category Focus Chart
        const categoryCtx = document.getElementById('categoryFocusChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'radar',
            data: {
                labels: @json($categoryDistribution->keys()),
                datasets: [{
                    data: @json($categoryDistribution->values()),
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#8b5cf6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: tooltipStyle },
                scales: {
                    r: {
                        angleLines: { color: 'rgba(0,0,0,0.05)' },
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { display: false },
                        pointLabels: { font: { size: 9, weight: 'black' } }
                    }
                }
            }
        });

        // 7. Table Sparklines
        document.querySelectorAll('.table-sparkline').forEach(canvas => {
            const data = JSON.parse(canvas.dataset.values);
            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: data.map((_, i) => i),
                    datasets: [{
                        data: data,
                        borderColor: '#6366f1',
                        borderWidth: 2,
                        pointRadius: 0,
                        tension: 0.4,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: { x: { display: false }, y: { display: false } }
                }
            });
        });
    </script>
</x-app-layout>
