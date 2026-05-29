@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'error' => null,
    'hint' => null,
    'icon' => null,
    'disabled' => false,
])

@php
    $errorText = $error ?? ($errors->has($name ?? '') ? $errors->first($name) : null);
@endphp

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $attributes->get('id', $name) }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }} @if($attributes->get('required')) <span class="text-orange-500">*</span> @endif
        </label>
    @endif

    <div class="relative">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $attributes->get('id', $name) }}"
            {{ $attributes->merge([
                'class' => 'block w-full rounded-lg border ' . ($errorText ? 'border-red-300 dark:border-red-700 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:border-orange-500 focus:ring-orange-500') . ' bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-1 disabled:bg-gray-50 disabled:text-gray-500 disabled:border-gray-200 sm:text-sm py-2 px-3 ' . ($icon ? 'pl-10' : '')
            ]) }}
            @disabled($disabled)
        >
        @if($icon)
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                {{ $icon }}
            </div>
        @endif
    </div>

    @if($errorText)
        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ $errorText }}
        </p>
    @elseif($hint)
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $hint }}</p>
    @endif
</div>