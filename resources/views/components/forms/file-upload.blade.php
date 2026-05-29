@props(['label' => null, 'name' => null, 'error' => null, 'multiple' => false, 'accept' => '*/*'])

@php
    $errorText = $error ?? ($errors->has($name) ? $errors->first($name) : null);
@endphp

<div x-data="{ dragging: false, preview: null }" class="flex flex-col gap-2">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif
    
    <div
        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl transition-all duration-200 cursor-pointer
        {{ $errorText ? 'border-red-300 bg-red-50' : 'border-gray-300 hover:border-orange-400 hover:bg-orange-50/30 dark:border-gray-600 dark:hover:border-orange-500 dark:hover:bg-orange-900/10' }}"
        :class="{ 'border-orange-500 bg-orange-50 dark:bg-orange-900/20': dragging }"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; $dispatch('file-selected', $event.dataTransfer.files); preview = URL.createObjectURL($event.dataTransfer.files[0])"
        x-on:click="$refs.fileInput.click()"
    >
        <input x-ref="fileInput" type="file" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }} accept="{{ $accept }}" {{ $attributes->whereStartsWith('wire:model') }} class="hidden" @change="if($event.target.files.length) { preview = URL.createObjectURL($event.target.files[0]) }">
        
        <template x-if="!preview">
            <div class="flex flex-col items-center text-gray-500 dark:text-gray-400">
                <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m0 0l3-3m0 0l3 3"/></svg>
                <span class="text-xs font-medium">Click to upload or drag and drop</span>
            </div>
        </template>

        <template x-if="preview">
            <div class="relative h-full w-full flex items-center justify-center p-2">
                <template x-if="preview.match(/\.(jpg|jpeg|png|gif|webp)$/i)">
                    <img :src="preview" class="h-full w-full object-cover rounded-lg">
                </template>
                <template x-if="!preview.match(/\.(jpg|jpeg|png|gif|webp)$/i)">
                    <div class="flex flex-col items-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="text-xs mt-1">File selected</span>
                    </div>
                </template>
            </div>
        </template>
    </div>
    @if($errorText)
        <p class="text-xs text-red-500">{{ $errorText }}</p>
    @endif
</div>