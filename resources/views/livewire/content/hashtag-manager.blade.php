<div class="space-y-4">
    <div class="flex flex-wrap gap-2">
        @foreach($savedTags as $tag)
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300 text-sm">
                {{ $tag }}
                <button wire:click="removeTag('{{ $tag }}')" class="hover:text-orange-900 dark:hover:text-white transition">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </span>
        @endforeach
    </div>

    <div class="flex gap-2">
        <input type="text" wire:model.live="newTag" wire:keydown.enter="addTag" placeholder="#enter a hashtag"
               class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500">
        <x-ui.button wire:click="addTag">Add</x-ui.button>
        <x-ui.button variant="outline" wire:click="fetchSuggestions">✨ AI Suggest</x-ui.button>
    </div>

    @if($showSuggestions && count($suggestedTags) > 0)
        <div class="bg-gray-50 dark:bg-gray-800/50 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
            <p class="text-xs text-gray-500 mb-2">Suggested for your niche:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($suggestedTags as $sug)
                    <button wire:click="useSuggestion('{{ $sug }}')" class="text-xs px-2 py-1 rounded bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:border-orange-400 hover:text-orange-600 transition">
                        {{ $sug }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>