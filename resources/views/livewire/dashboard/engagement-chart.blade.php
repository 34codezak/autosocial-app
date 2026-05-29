<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Engagement Overview</h3>
        <select wire:model.live="period" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-orange-500 focus:ring-orange-500 py-1.5 px-3">
            <option value="24h">Last 24 Hours</option>
            <option value="7d">Last 7 Days</option>
            <option value="30d">Last 30 Days</option>
        </select>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 h-64">
        <canvas wire:ignore x-data x-init="initChart($el, $wire)" x-ref="chart"></canvas>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function initChart(el, wire) {
            const ctx = el.getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: wire.chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
                    scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
                }
            });
            wire.$on('chart-updated', (e) => {
                chart.data = e.detail.data;
                chart.update();
            });
        }
    </script>
    @endpush
</div>