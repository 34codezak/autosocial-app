@props(['value' => 0, 'max' => 100, 'variant' => 'orange', 'showLabel' => true, 'striped' => false, 'animated' => false])

@php
    $percentage = min(100, max(0, ($value / $max) * 100));
    $colorClass = match($variant) {
        'orange' => 'bg-orange-500',
        'red' => 'bg-red-500',
        'green' => 'bg-green-500',
        'blue' => 'bg-blue-500',
        'gray' => 'bg-gray-500',
        default => $variant,
    };
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($showLabel)
        <div class="flex justify-between mb-1 text-xs font-medium text-gray-500 dark:text-gray-400">
            <span>{{ $slot ?? 'Progress' }}</span>
            <span>{{ round($percentage) }}%</span>
        </div>
    @endif
    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
        <div
            class="h-full rounded-full {{ $colorClass }} {{ $striped ? 'bg-[length:1rem_1rem] bg-[linear-gradient(45deg,rgba(255,255,255,.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,.15)_50%,rgba(255,255,255,.15)_75%,transparent_75%,transparent)]' : '' }} {{ $animated ? 'animate-[progress-stripes_1s_linear_infinite]' : '' }} transition-all duration-500 ease-out"
            style="width: {{ $percentage }}%;"
            role="progressbar"
            aria-valuenow="{{ $value }}"
            aria-valuemin="0"
            aria-valuemax="{{ $max }}"
        ></div>
    </div>
</div>