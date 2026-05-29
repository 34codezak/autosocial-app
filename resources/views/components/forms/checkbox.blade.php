@props(['label' => null, 'name' => null])

<label class="inline-flex items-center cursor-pointer group">
    <input
        type="checkbox"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'rounded border-gray-300 dark:border-gray-600 text-orange-600 focus:ring-orange-500 h-4 w-4 transition duration-150 ease-in-out cursor-pointer']) }}
    >
    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">
        {{ $label ?? $slot }}
    </span>
</label>