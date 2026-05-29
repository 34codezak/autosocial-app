<x-ui.card>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Audience Growth</h3>
        <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
            @foreach(['7d' => '7D', '30d' => '30D', '90d' => '90D'] as $val => $label)
                <button
                    wire:click="setRange('{{ $val }}')"
                    class="px-3 py-1 text-xs font-medium rounded-md transition-all {{ $range === $val ? 'bg-white dark:bg-gray-600 text-orange-600 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700' }}"
                >{{ $label }}</button>
            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p class="text-xs text-gray-500 dark:text-gray-400">Current Followers</p>
            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">{{ number_format($data['current']) }}</p>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p class="text-xs text-gray-500 dark:text-gray-400">Net Growth</p>
            <p class="mt-1 text-xl font-bold text-green-600 dark:text-green-400">+{{ number_format($data['netGrowth']) }}</p>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p class="text-xs text-gray-500 dark:text-gray-400">Daily Avg</p>
            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">{{ $data['dailyAverage'] }}</p>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p class="text-xs text-gray-500 dark:text-gray-400">Top Source</p>
            <p class="mt-1 text-xl font-bold text-orange-600 dark:text-orange-400">{{ $data['topSource'] }}</p>
        </div>
    </div>
</x-ui.card>