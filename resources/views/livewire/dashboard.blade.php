<div wire:poll.5s="refreshData" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header & Live Indicator --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Dashboard</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Real-time engagement & content performance</p>
        </div>
        <div class="flex items-center gap-3 bg-white dark:bg-slate-800 px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
            <span class="relative flex h-2.5 w-2.5" aria-hidden="true">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
            </span>
            <span class="text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wide">Live</span>
            <span class="text-xs text-slate-400 dark:text-slate-500">
                | Updated: {{ $lastUpdated }}
            </span>        
        </div>
    </div>

    {{-- Metric Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach($metrics as $key => $metric)
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 shadow-sm hover:shadow-md transition-shadow"
                wire:key="metric-{{ $key }}">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                        @php
                            $icons = [
                                'eye' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
                                'heart' => 'M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z',
                                'chat' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                                'share' => 'M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z'
                            ];
                        @endphp
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icons[$metric['icon']] ?? $icons['eye'] }}"/></svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $metric['trendUp'] ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400'}}">
                        {{ $metric['trendUp'] ? '↑' : '↓' }} 
                        {{ $metric['trend'] >= 0 ? '+' : '' }}{{ number_format(abs((float) $metric['trend']), 1) }}%
                    </span>
                </div>
                <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ number_format($metric['value']) }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 capitalize">{{ ucfirst(str_replace('_', ' ', $key)) }} (24h)</p>
            </div>
        @endforeach
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Trend Chart with ApexCharts --}}
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 dark:text-white">Engagement Trend</h2>
                <select wire:model.live="trendPeriod" class="text-xs bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-md px-2 py-1 text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                    <option value="24h">24 Hours</option>
                    <option value="7d">7 Days</option>
                    <option value="30d">30 Days</option>
                </select>
            </div>
            
            {{-- ApexCharts Container --}}
            <div id="trendChart" wire:ignore class="h-64"></div>
            
            {{-- Fallback if JS fails --}}
            <div id="chartFallback" class="hidden h-48 flex items-center justify-center text-slate-400 text-sm border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-lg">
                Chart loading...
            </div>
        </div>

        {{-- Platform Breakdown --}}
        @isset($platformBreakdown)
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Platform Performance</h2>
            @php $totalEngagement = collect($platformBreakdown)->sum('engagement') ?: 1; @endphp
            <div class="space-y-4">
                @foreach($platformBreakdown as $platform)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-700 dark:text-slate-300">{{ $platform['name'] }}</span>
                            <span class="font-medium text-slate-800 dark:text-white">{{ number_format($platform['engagement']) }}</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2 overflow-hidden">
                            <div class="h-2 rounded-full bg-gradient-to-r {{ $platform['color'] }}" style="width: {{ min(($platform['engagement'] / $totalEngagement) * 100, 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('services') }}" class="mt-4 inline-flex items-center text-sm text-orange-600 dark:text-orange-400 hover:underline hover:text-orange-700 transition-colors">
                View detailed analytics →
            </a>
        </div>
        @endisset
    </div>

    {{-- Recent Activity & Quick Links --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Posts --}}
        @isset($recentPosts)
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Recent Posts</h2>
            <div class="space-y-3">
                @foreach($recentPosts as $post)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors border border-transparent hover:border-slate-200 dark:hover:border-slate-600" wire:key="post-{{ $post['id'] ?? $loop->index }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-lg shrink-0">
                                @php
                                    $typeIcons = ['image' => '🖼️', 'video' => '🎥', 'text' => '📝', 'document' => '📄'];
                                @endphp
                                {{ $typeIcons[$post['type']] ?? '📄' }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-slate-800 dark:text-white truncate">{{ $post['title'] }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $post['platform'] }} • {{ $post['time'] }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0 ml-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                {{ match($post['status']) {
                                    'published'  => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'publishing' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
                                    'scheduled'  => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                    default      => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300'
                                } }}">
                                {{ ucfirst($post['status']) }}
                            </span>
                            @if($post['engagement'] > 0)
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ number_format($post['engagement']) }} engagements</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endisset

        {{-- Quick Resource Links --}}
        <div class="bg-gradient-to-br from-orange-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-xl border border-orange-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Workspace Shortcuts</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('workspace') . '#editor' }}" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-orange-400 dark:hover:border-orange-500 transition-colors group">
                    <svg class="w-6 h-6 text-orange-500 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Post Editor</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-orange-400 dark:hover:border-orange-500 transition-colors group">
                    <svg class="w-6 h-6 text-orange-500 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Media Library</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-orange-400 dark:hover:border-orange-500 transition-colors group">
                    <svg class="w-6 h-6 text-orange-500 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Analytics Hub</span>
                </a>
                <a href="{{ route('workspace') }}" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-orange-400 dark:hover:border-orange-500 transition-colors group">
                    <svg class="w-6 h-6 text-orange-500 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Settings</span>
                </a>
            </div>
            <div class="mt-4 p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                <p class="text-xs text-orange-800 dark:text-orange-200">
                    💡 <strong>Tip:</strong> Connect your AI assistant to auto-generate captions & hashtags directly from this dashboard.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ApexCharts Script + Initialization --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.0/dist/apexcharts.min.js"></script>
<script>
document.addEventListener('livewire:navigated', initTrendChart);
document.addEventListener('DOMContentLoaded', initTrendChart);

function initTrendChart() {
    const chartEl = document.getElementById('trendChart');
    if (!chartEl) return;

    // Get data from Livewire component via global window variable
    // Livewire automatically serializes public properties
    const trendData = @json($trendData);
    const isDark = document.documentElement.classList.contains('dark');
    
    // Generate x-axis labels based on trendPeriod
    const period = @json($trendPeriod);
    const labels = generateTimeLabels(period, trendData.length);
    
    const options = {
        series: [{
            name: 'Engagements',
            data: trendData
        }],
        chart: {
            type: 'area',
            height: 256,
            fontFamily: 'inherit',
            foreColor: isDark ? '#94a3b8' : '#475569',
            toolbar: { show: false },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 300,
                animateGradually: { enabled: false },
                dynamicAnimation: { enabled: true, speed: 300 }
            },
            events: {
                mounted: function() {
                    document.getElementById('chartFallback')?.classList.add('hidden');
                }
            }
        },
        dataLabels: { enabled: false },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: [isDark ? '#fb923c' : '#f97316']
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: isDark ? 0.3 : 0.4,
                opacityTo: 0.05,
                stops: [0, 90, 100],
                colorStops: [[
                    { offset: 0, color: isDark ? '#fb923c' : '#f97316', opacity: 0.4 },
                    { offset: 100, color: isDark ? '#1e293b' : '#fff', opacity: 0 }
                ]]
            }
        },
        grid: {
            borderColor: isDark ? '#334155' : '#e2e8f0',
            strokeDashArray: 4,
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        xaxis: {
            categories: labels,
            labels: {
                style: { colors: isDark ? '#94a3b8' : '#64748b', fontSize: '11px' },
                rotate: -45,
                rotateAlways: false,
                hideOverlappingLabels: true
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { colors: isDark ? '#94a3b8' : '#64748b', fontSize: '11px' },
                formatter: function(val) {
                    return val >= 1000 ? (val/1000).toFixed(1) + 'k' : val;
                }
            },
            min: 0,
            forceNiceScale: true
        },
        tooltip: {
            theme: isDark ? 'dark' : 'light',
            x: { format: 'dd MMM HH:mm' },
            y: {
                formatter: function(val) {
                    return val.toLocaleString() + ' interactions';
                }
            },
            marker: { show: true },
            style: { fontSize: '12px' }
        },
        markers: {
            size: 0,
            hover: { size: 4, sizeOffset: 3 }
        },
        responsive: [{
            breakpoint: 640,
            options: {
                chart: { height: 200 },
                xaxis: { labels: { rotate: -30 } }
            }
        }]
    };

    // Destroy existing chart if re-initializing
    if (window.trendChart) {
        window.trendChart.destroy();
    }
    
    window.trendChart = new ApexCharts(chartEl, options);
    window.trendChart.render();
    
    // Listen for Livewire updates to refresh chart data
    Livewire.hook('message.processed', (message, component) => {
        if (component.snapshot.data.trendData && window.trendChart) {
            const newData = component.snapshot.data.trendData;
            const newPeriod = component.snapshot.data.trendPeriod;
            const newLabels = generateTimeLabels(newPeriod, newData.length);
            
            window.trendChart.updateOptions({
                series: [{ data: newData }],
                xaxis: { categories: newLabels }
            }, false, true);
        }
    });
}

function generateTimeLabels(period, count) {
    const labels = [];
    const now = new Date();
    
    if (period === '24h') {
        for (let i = count - 1; i >= 0; i--) {
            const time = new Date(now - i * 60 * 60 * 1000);
            labels.push(time.getHours() + ':00');
        }
    } else if (period === '7d') {
        for (let i = count - 1; i >= 0; i--) {
            const date = new Date(now - i * 24 * 60 * 60 * 1000);
            labels.push(date.toLocaleDateString('en-US', { weekday: 'short' }));
        }
    } else {
        for (let i = count - 1; i >= 0; i--) {
            const date = new Date(now - i * 24 * 60 * 60 * 1000);
            labels.push(date.getDate() + ' ' + date.toLocaleDateString('en-US', { month: 'short' }));
        }
    }
    
    return labels;
}

// Handle dark mode toggle
if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if (window.trendChart) {
            initTrendChart();
        }
    });
}
</script>
@endpush
