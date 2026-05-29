@props(['text' => '', 'placement' => 'top'])

@php
    $positionClasses = match($placement) {
        'top' => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
        'bottom' => 'top-full left-1/2 -translate-x-1/2 mt-2',
        'left' => 'right-full top-1/2 -translate-y-1/2 mr-2',
        'right' => 'left-full top-1/2 -translate-y-1/2 ml-2',
        default => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
    };
@endphp

<div class="relative inline-flex group">
    {{ $slot }}
    <div
        x-data="{ show: false }"
        @mouseenter="show = true"
        @mouseleave="show = false"
        x-show="show"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="absolute z-50 px-2.5 py-1.5 text-xs font-medium text-white bg-gray-900 dark:bg-gray-700 rounded shadow-lg pointer-events-none whitespace-nowrap {{ $positionClasses }}"
        style="display: none;"
    >
        {{ $text }}
        <div class="{{ match($placement) { 'top' => 'absolute top-full left-1/2 -translate-x-1/2 -mt-px border-4 border-transparent border-t-gray-900 dark:border-t-gray-700', 'bottom' => 'absolute bottom-full left-1/2 -translate-x-1/2 -mb-px border-4 border-transparent border-b-gray-900 dark:border-b-gray-700', 'left' => 'absolute left-full top-1/2 -translate-y-1/2 -ml-px border-4 border-transparent border-l-gray-900 dark:border-l-gray-700', 'right' => 'absolute right-full top-1/2 -translate-y-1/2 -mr-px border-4 border-transparent border-r-gray-900 dark:border-r-gray-700', default => 'hidden' }}"></div>
    </div>
</div>