<div x-data="{ dragging: @entangle('isDragging') }"
     @dragover.prevent="dragging = true"
     @dragleave.prevent="dragging = false"
     @drop.prevent="dragging = false; $dispatch('files-dropped', { files: $event.dataTransfer.files })"
     class="space-y-4">
    
    <x-ui.card>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Media Library</h3>
            <x-ui.button size="sm" wire:click="$dispatch('open-upload-modal')">+ Upload</x-ui.button>
        </div>

        <div class="border-2 border-dashed rounded-xl p-6 text-center transition-colors"
             :class="dragging ? 'border-orange-500 bg-orange-50 dark:bg-orange-900/20' : 'border-gray-200 dark:border-gray-700'">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m0 0l3-3m0 0l3 3"/></svg>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Drag & drop images here</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mt-4">
            @foreach($mediaFiles as $media)
                <div wire:click="toggleSelect('{{ $media['id'] }}')"
                     class="relative aspect-square rounded-lg overflow-hidden cursor-pointer border-2 transition-all {{ in_array($media['id'], $selectedIds) ? 'border-orange-500 ring-2 ring-orange-200 dark:ring-orange-800' : 'border-transparent hover:border-gray-300' }}">
                    <img src="{{ $media['url'] }}" alt="{{ $media['name'] }}" class="w-full h-full object-cover" loading="lazy">
                    @if(in_array($media['id'], $selectedIds))
                        <div class="absolute top-2 right-2 bg-orange-500 text-white rounded-full p-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </x-ui.card>
</div>