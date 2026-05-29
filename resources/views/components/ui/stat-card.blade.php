@props(['icon' => null, 'label', 'value', 'trend' => null, 'trendUp' => true, 'iconColor' => 'orange'])

<x-ui.card class="!p-4">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ $label }}</p>
            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $value }}</p>
        </div>
        @if($icon)
            <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-{{ $iconColor }}-100 dark:bg-{{ $iconColor }}-900/30 text-{{ $iconColor }}-600 dark:text-{{ $iconColor }}-400">
                {{ $icon }}
            </div>
        @endif
    </div>
    @if($trend)
        <div class="mt-3 flex items-center text-sm">
            <span class="flex items-center font-medium {{ $trendUp ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                <svg class="w-4 h-4 mr-1 {{ $trendUp ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $trend }}
            </span>
            <span class="ml-2 text-gray-500 dark:text-gray-400">vs last period</span>
        </div>
    @endif
</x-ui.card>