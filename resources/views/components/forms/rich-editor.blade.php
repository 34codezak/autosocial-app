@props(['label' => null, 'name' => null])

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif
    
    <div x-data="{ value: '' }"
         @trix-change="value = $event.target.editor.innerHTML; @this.set(@js($name), value)"
         @trix-initialize="if($wire.get(@js($name))) $event.target.editor.innerHTML = $wire.get(@js($name))"
         class="prose dark:prose-invert max-w-none">
        <input id="{{ $name }}" type="hidden" name="{{ $name }}" />
        <trix-editor input="{{ $name }}" class="trix-content min-h-[150px] rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:border-orange-500 focus:ring-orange-500"></trix-editor>
    </div>
    @push('scripts')
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>.trix-button-group:not(:first-child) { display: none; } /* Simplify toolbar */</style>
    @endpush
</div>