@props(['label' => null, 'name' => null, 'error' => null, 'maxChars' => null, 'autoResize' => true])

@php
    $errorText = $error ?? ($errors->has($name) ? $errors->first($name) : null);
@endphp

<div class="flex flex-col gap-1.5" x-data="{ el: $refs.textarea }">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    <textarea
        x-ref="textarea"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border ' . ($errorText ? 'border-red-300 dark:border-red-700 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:border-orange-500 focus:ring-orange-500') . ' bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-1 sm:text-sm py-2 px-3']) }}
        @if($autoResize)
            @input="el.style.height = 'auto'; el.style.height = el.scrollHeight + 'px'"
            x-init="el.style.height = el.scrollHeight + 'px'"
        @endif
    ></textarea>

    @if($maxChars)
        <div class="flex justify-between items-center">
            @if($errorText)
                <p class="text-xs text-red-500">{{ $errorText }}</p>
            @else
                <p class="text-xs text-gray-400" x-text="`${el.value.length} / {{ $maxChars }}`"></p>
            @endif
        </div>
    @elseif($errorText)
        <p class="text-xs text-red-500 mt-1">{{ $errorText }}</p>
    @endif
</div>