<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Publishing Workflow</h3>
        @if($status !== 'idle')
            <span class="text-xs font-medium px-2 py-1 rounded-full {{ match($status) { 'success' => 'bg-green-100 text-green-700', 'error' => 'bg-red-100 text-red-700', default => 'bg-orange-100 text-orange-700' }}">
                {{ ucfirst($status) }}
            </span>
        @endif
    </div>

    <livewire:platforms.account-selector wire:model.live="targets" />

    <div class="mt-6 flex justify-end gap-3">
        <x-ui.button variant="secondary" @click="$wire.set('targets', [])">Reset</x-ui.button>
        <x-ui.button wire:click="publish" :disabled="$status === 'processing' || empty($targets)">
            <span wire:loading.remove wire:target="publish">Publish Now</span>
            <span wire:loading wire:target="publish">Processing...</span>
        </x-ui.button>
    </div>

    @if($message)
        <x-ui.alert variant="{{ $status === 'error' ? 'error' : 'success' }}" class="mt-4">
            {{ $message }}
        </x-ui.alert>
    @endif
</div>