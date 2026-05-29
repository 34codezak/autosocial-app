@props(['name', 'checked' => false, 'label' => null, 'description' => null])

<label class="flex items-center justify-between cursor-pointer group">
    <div class="flex flex-col">
        @if($label)
            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $label }}</span>
        @endif
        @if($description)
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
        @endif
    </div>

    <input type="checkbox" name="{{ $name }}" class="sr-only peer" {{ $checked ? 'checked' : '' }}>
    <div class="relative w-11 h-6 bg-gray-200 dark:bg-gray-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-orange-500 rounded-full peer dark:peer-checked:bg-orange-500 peer-checked:bg-orange-500 transition-colors">
        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-5 shadow-sm"></div>
    </div>
</label>