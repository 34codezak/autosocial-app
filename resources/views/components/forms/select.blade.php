@props(['label' => null, 'name' => null, 'error' => null])

@php
    $errorText = $error ?? ($errors->has($name) ? $errors->first($name) : null);
@endphp

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border ' . ($errorText ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-orange-500 focus:ring-orange-500') . ' bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-1 sm:text-sm py-2 px-3 appearance-none cursor-pointer']) }}
    >
        {{ $slot }}
    </select>
    @if($errorText)
        <p class="text-xs text-red-500 mt-1">{{ $errorText }}</p>
    @endif
</div>