@props(['variant' => 'info', 'dismissible' => false, 'icon' => null])

@php
    $variants = [
        'info' => 'bg-blue-50 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        'success' => 'bg-green-50 text-green-800 dark:bg-green-900/20 dark:text-green-300 border-green-200 dark:border-green-800',
        'warning' => 'bg-yellow-50 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800',
        'error' => 'bg-red-50 text-red-800 dark:bg-red-900/20 dark:text-red-300 border-red-200 dark:border-red-800',
    ];
    $colors = [
        'info' => 'text-blue-500 dark:text-blue-400',
        'success' => 'text-green-500 dark:text-green-400',
        'warning' => 'text-yellow-500 dark:text-yellow-400',
        'error' => 'text-red-500 dark:text-red-400',
    ];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    {{ $attributes->merge(['class' => "rounded-lg p-4 border {$variants[$variant]} flex items-start gap-3"]) }}
>
    @if($icon)
        <span class="shrink-0 mt-0.5 {{ $colors[$variant] }}">{{ $icon }}</span>
    @else
        <span class="shrink-0 mt-0.5 {{ $colors[$variant] }}">
            @svg(match($variant) { 'info' => 'heroicon-o-information-circle', 'success' => 'heroicon-o-check-circle', 'warning' => 'heroicon-o-exclamation-triangle', 'error' => 'heroicon-o-x-circle', default => 'heroicon-o-information-circle' }, 'w-5 h-5')
        </span>
    @endif

    <div class="flex-1 min-w-0">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button @click="show = false" class="shrink-0 -mr-1 -mt-1 p-1 rounded-md opacity-70 hover:opacity-100 transition-opacity">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    @endif
</div>