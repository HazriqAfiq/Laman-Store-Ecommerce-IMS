<x-app-layout title="My Sales">

    {{-- ── Success notice ──────────────────────────────────────────────────── --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[13px] font-bold px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════
         HEADER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-black text-gray-900 tracking-tight uppercase">Sales History</h1>
            <p class="text-[12px] font-medium text-gray-500 mt-1 uppercase tracking-widest">Transactions for the selected period</p>
        </div>
        <a href="{{ route('reseller.sales.create') }}"
           class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-black hover:bg-gray-900
                  text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-black/10 transition-all duration-300 hover:-translate-y-0.5 shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Record Sale</span>
        </a>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         MONTH FILTER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-4 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        
        <form method="GET" action="{{ route('reseller.sales.index') }}" id="filter-form" class="flex flex-col sm:flex-row sm:items-center gap-3 w-full">
            <div class="flex items-center gap-2 text-[11px] font-black text-gray-400 uppercase tracking-widest shrink-0 px-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Timeframe
            </div>
            
            <div class="flex-1 flex flex-col sm:flex-row items-center gap-3">
                <select id="year" name="year" onchange="document.getElementById('filter-form').submit()"
                        class="w-full sm:w-auto px-6 py-2.5 text-[13px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-xl
                               focus:outline-none focus:ring-black focus:border-black
                               cursor-pointer appearance-none transition-all duration-300 pr-12 uppercase tracking-widest"
                        style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23000000%22><path fill-rule=%22evenodd%22 d=%22M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z%22 clip-rule=%22evenodd%22/></svg>');
                               background-repeat:no-repeat;background-position:right 1.2rem center;background-size:1.2rem;">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>

                <select id="month" name="month" onchange="document.getElementById('filter-form').submit()"
                        class="w-full sm:w-auto px-6 py-2.5 text-[13px] font-black text-gray-900 bg-gray-50 border border-gray-100 rounded-xl
                               focus:outline-none focus:ring-black focus:border-black
                               cursor-pointer appearance-none transition-all duration-300 pr-12 uppercase tracking-widest"
                        style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23000000%22><path fill-rule=%22evenodd%22 d=%22M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z%22 clip-rule=%22evenodd%22/></svg>');
                               background-repeat:no-repeat;background-position:right 1.2rem center;background-size:1.2rem;">
                    <option value="">All Months</option>
                    @foreach($availableMonths as $m)
                        <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                            {{ strtoupper(\Carbon\Carbon::create()->month($m)->format('F')) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="px-2 shrink-0">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-black text-[10px] font-black text-white rounded-lg tracking-[0.2em] uppercase shadow-lg shadow-black/10">
                <span class="w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.8)]"></span>
                {{ $periodLabel }}
            </span>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         KPI TOP ROW & CHART
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- KPIs Column --}}
        <div class="col-span-1 flex flex-col gap-5">
            {{-- Revenue --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-5 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300 flex-1">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-50 to-transparent rounded-tl-[80px] -mr-8 -mb-8 transition-transform duration-500 group-hover:scale-110"></div>
                <div class="flex items-start justify-between mb-4 relative z-10">
                    <span class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white shadow-xl shadow-black/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">My Revenue</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">RM{{ number_format($monthRevenue, 0) }}</p>
                </div>
            </div>

            {{-- Units Sold --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-5 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300 flex-1">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-50 to-transparent rounded-tl-[80px] -mr-8 -mb-8 transition-transform duration-500 group-hover:scale-110"></div>
                <div class="flex items-start justify-between mb-4 relative z-10">
                    <span class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white shadow-xl shadow-black/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Units Sold</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">{{ number_format($monthUnitsSold) }}</p>
                </div>
            </div>

            {{-- Transactions --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-5 relative overflow-hidden group hover:scale-[1.02] transition-all duration-300 flex-1">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-50 to-transparent rounded-tl-[80px] -mr-8 -mb-8 transition-transform duration-500 group-hover:scale-110"></div>
                <div class="flex items-start justify-between mb-4 relative z-10">
                    <span class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white shadow-xl shadow-black/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Transactions</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">{{ number_format($monthTransactions) }}</p>
                </div>
            </div>
        </div>

        {{-- Main Trend Chart --}}
        <div class="col-span-1 lg:col-span-3 bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-7 relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-[15px] font-black text-gray-900 tracking-tight">Performance Trend</h2>
                    <p class="text-[12px] font-medium text-gray-500 mt-1">Your revenue & volume for {{ $periodLabel }}</p>
                </div>
                <div class="flex items-center gap-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                    <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-md bg-black shadow-lg shadow-black/20"></span>Revenue</span>
                    <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-md bg-gray-200"></span>Units</span>
                </div>
            </div>
            <div class="relative h-[360px] w-full">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         SALES TABLE
    ═══════════════════════════════════════════════════════════════ --}}
    <div x-data="{ 
            loading: false,
            async fetchSales(url = null) {
                this.loading = true;
                const form = document.getElementById('filter-form');
                const formData = new FormData(form);
                const params = new URLSearchParams(formData);
                
                let targetUrl = url || `{{ route('reseller.sales.index') }}?${params.toString()}`;
                
                if (!url) {
                    window.location.href = targetUrl;
                    return;
                }

                try {
                    const response = await fetch(targetUrl, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const html = await response.text();
                    document.getElementById('table-container').innerHTML = html;
                    window.history.pushState({}, '', targetUrl);
                } catch (error) {
                    console.error('Error fetching sales:', error);
                } finally {
                    this.loading = false;
                }
            }
         }"
         @click="if($event.target.closest('.pagination a')) { $event.preventDefault(); fetchSales($event.target.closest('.pagination a').href); }"
         class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden mb-12 relative">
        
        <div x-show="loading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-50 flex items-center justify-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-10 h-10 border-4 border-blue-600/10 border-t-blue-600 rounded-full animate-spin"></div>
                <p class="text-[11px] font-bold text-blue-600 uppercase tracking-widest">Updating Ledger...</p>
            </div>
        </div>

        <div class="px-7 py-6 border-b border-gray-50/80 flex items-center justify-between bg-gray-50/20">
            <div>
                <h2 class="text-[14px] font-black text-gray-900 uppercase tracking-[0.1em]">Sales Ledger</h2>
                <p class="text-[11px] font-medium text-gray-500 mt-1 uppercase tracking-widest">
                    {{ $monthTransactions }} processing {{ Str::plural('record', $monthTransactions) }} for {{ $periodLabel }}
                </p>
            </div>
        </div>

        <div id="table-container">
            @include('reseller.sales.partials.table')
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         CHART JS
    ═══════════════════════════════════════════════════════════════ --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        Chart.defaults.font.family = "'Inter', 'Poppins', ui-sans-serif, sans-serif";
        Chart.defaults.font.size   = 11;
        Chart.defaults.color       = '#9ca3af';

        const gridColor = 'rgba(0,0,0,0.03)';
        const tooltipConfig = {
            backgroundColor: 'rgba(255,255,255,0.98)',
            borderColor: 'rgba(0,0,0,0.05)',
            borderWidth: 1,
            titleColor: '#111827',
            titleFont: { size: 13, weight: '800' },
            bodyColor: '#4b5563',
            bodyFont: { size: 12, weight: '600' },
            padding: 12, boxPadding: 8,
            usePointStyle: true, boxWidth: 8, boxHeight: 8,
            cornerRadius: 12, boxShadow: '0 4px 6px -1px rgba(0,0,0,0.1)'
        };

        const createGradient = (ctx, startColor, endColor, top=400, bottom=0) => {
            const gradient = ctx.createLinearGradient(0, top, 0, bottom);
            gradient.addColorStop(0, startColor);
            gradient.addColorStop(1, endColor);
            return gradient;
        };

        const canvas = document.getElementById('trendChart');
        if(canvas) {
            const trendCtx = canvas.getContext('2d');
            const revGradient = createGradient(trendCtx, 'rgba(59, 130, 246, 0.25)', 'rgba(59, 130, 246, 0)');
            
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: @json($trendLabels),
                    datasets: [
                        {
                            label: 'Revenue (RM)',
                            data: @json($trendRevenue),
                            borderColor: '#000000',
                            backgroundColor: createGradient(trendCtx, 'rgba(0, 0, 0, 0.05)', 'rgba(0, 0, 0, 0)'),
                            fill: true, tension: 0.4,
                            pointRadius: 0, pointHoverRadius: 6,
                            pointBackgroundColor: '#ffffff', pointBorderColor: '#000000',
                            borderWidth: 3, yAxisID: 'yRevenue',
                        },
                        {
                            label: 'Units Sold',
                            data: @json($trendUnits),
                            borderColor: '#e5e7eb',
                            backgroundColor: 'transparent',
                            fill: false, tension: 0.4,
                            pointRadius: 0, pointHoverRadius: 6,
                            pointBackgroundColor: '#ffffff', pointBorderColor: '#e5e7eb',
                            borderWidth: 2, borderDash: [6, 4], yAxisID: 'yUnits',
                        }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            ...tooltipConfig,
                            callbacks: {
                                label: ctx => {
                                    if (ctx.datasetIndex === 0) return ` RM ${Number(ctx.parsed.y).toLocaleString('en-MY', {minimumFractionDigits:2})}`;
                                    return ` ${ctx.parsed.y} Units`;
                                }
                            }
                        }
                    },
                    scales: {
                        yRevenue: { 
                            position: 'left', beginAtZero: true, 
                            grid: { color: gridColor }, border: { display: false }, 
                            ticks: { callback: v => 'RM' + Number(v).toLocaleString(), padding: 10, font: { weight: '600' } } 
                        },
                        yUnits: { 
                            position: 'right', beginAtZero: true, 
                            grid: { display: false }, border: { display: false }, 
                            ticks: { stepSize: Math.max(1, Math.ceil(Math.max(...@json($trendUnits))/5)), padding: 10 } 
                        },
                        x: { 
                            grid: { display: false }, border: { display: false }, 
                            ticks: { maxTicksLimit: 12, padding: 10, font: { weight: '600' } } 
                        }
                    }
                }
            });
        }
    </script>

</x-app-layout>
