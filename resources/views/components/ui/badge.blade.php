@props(['variant' => 'default', 'dot' => false, 'pill' => false])

@php
    $variantClasses = match($variant) {
        'default' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-300',
        'success' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
        'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
        'error' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
        'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
        'neutral' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        default => $variant,
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-2.5 py-0.5 text-xs font-medium rounded-full {$variantClasses} " . ($pill ? 'rounded-full' : '')]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
    @endif
    {{ $slot }}
</span>