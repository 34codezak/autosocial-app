@props(['shadow' => true, 'hover' => false, 'borderless' => false])

@php
    $base = 'bg-white dark:bg-gray-800 rounded-xl overflow-hidden';
    $shadow = $shadow ? 'shadow-sm' : '';
    $border = $borderless ? '' : 'border border-gray-200 dark:border-gray-700';
    $hover = $hover ? 'transition-all hover:shadow-md hover:border-orange-200 dark:hover:border-orange-700/50' : '';
@endphp

<div {{ $attributes->merge(['class' => "$base $shadow $border $hover"]) }}>
    @if(isset($header))
        <div class="px-4 py-4 sm:px-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
            {{ $header }}
        </div>
    @endif

    <div class="px-4 py-4 sm:px-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-3 sm:px-6 bg-gray-50/50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>