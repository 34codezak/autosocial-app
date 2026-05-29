@props(['label' => null, 'name' => null, 'error' => null])

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css" media="print" onload="this.media='all'">
<style>.dark .flatpickr-day.selected { background: #f97316; border-color: #f97316; }</style>
@endpush

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif
    <div x-data="{
            el: $refs.input,
            fp: null
        }"
        x-init="fp = flatpickr(el, {
            dateFormat: 'Y-m-d',
            theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
            onChange: function(selectedDates, dateStr) {
                @this.set(@js($name), dateStr);
            }
        })"
        class="relative">
        <input
            x-ref="input"
            id="{{ $name }}"
            {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-orange-500 focus:ring-orange-500 focus:outline-none focus:ring-1 sm:text-sm py-2 px-3']) }}
        >
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
    </div>
    @error($name) <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
</div>