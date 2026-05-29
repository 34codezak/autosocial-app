<div x-data="{ showPreview: false }" class="space-y-4">
    <x-ui.card>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Compose Post</h3>
            <x-ui.button variant="ghost" size="sm" @click="showPreview = !showPreview">
                <span x-text="showPreview ? 'Edit' : 'Preview'"></span>
            </x-ui.button>
        </div>

        <div x-show="!showPreview" class="space-y-4">
            {{-- Platform Selector --}}
            <div class="flex flex-wrap gap-2">
                @foreach($platforms as $platform)
                    <button wire:click="togglePlatform('{{ $platform['id'] }}')"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg border transition-all {{ in_array($platform['id'], $selectedPlatforms) ? 'border-orange-500 bg-orange-50 dark:bg-orange-900/20 text-orange-600' : 'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        <span>{{ $platform['icon'] }}</span>
                        <span class="text-sm font-medium">{{ $platform['name'] }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Text Area --}}
            <textarea wire:model.live="content"
                      class="w-full h-32 px-3 py-2 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500 resize-none"
                      placeholder="What's happening?"
                      maxlength="{{ $platforms[0]['limit'] ?? 280 }}"></textarea>

            {{-- Char Counter & Media Upload --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <label class="cursor-pointer p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <input type="file" wire:model.live="media" multiple class="hidden">
                    </label>
                    @if(count($media) > 0)
                        <span class="text-xs text-gray-500">{{ count($media) }} file(s)</span>
                    @endif
                </div>
                <span class="text-xs font-medium {{ $this->getRemainingChars() < 0 ? 'text-red-500' : 'text-gray-500' }}">
                    {{ $this->getRemainingChars() }} characters left
                </span>
            </div>

            {{-- Scheduling Toggle --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                <x-ui.toggle wire:model.live="scheduling" name="schedule_post" label="Schedule Post" />
                @if($scheduling)
                    <div class="flex gap-2 w-full sm:w-auto">
                        <input type="datetime-local" wire:model.live="scheduledAt"
                               class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                        <select wire:model.live="timezone" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                            <option value="UTC">UTC</option>
                            <option value="America/New_York">ET</option>
                            <option value="America/Chicago">CT</option>
                            <option value="America/Los_Angeles">PT</option>
                        </select>
                    </div>
                @endif
            </div>
        </div>

        <div x-show="showPreview" class="min-h-[300px]">
            <livewire:content.post-preview :content="$content" :media="$media" :platforms="$selectedPlatforms" />
        </div>
    </x-ui.card>

    <div class="flex justify-end gap-3">
        <x-ui.button variant="secondary" @click="$wire.set('content', ''); $wire.set('media', []); $wire.set('selectedPlatforms', [])">Discard</x-ui.button>
        <x-ui.button wire:click="save" :disabled="$this->getRemainingChars() < 0 || empty($selectedPlatforms)" wire:loading.attr="disabled">
            <span wire:loading.remove>Publish {{ $scheduling ? 'Later' : 'Now' }}</span>
            <span wire:loading>Processing...</span>
        </x-ui.button>
    </div>
</div>