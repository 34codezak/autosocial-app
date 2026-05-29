<div class="space-y-3">
    <div class="flex items-center justify-between">
        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Publish To</h4>
        <x-ui.button variant="ghost" size="sm" wire:click="selectAll">Select All</x-ui.button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
        @foreach($availableAccounts as $account)
            @php $key = "{$account['platform']}:{$account['handle']}"; @endphp
            <button wire:click="toggleAccount('{{ $key }}')"
                    class="flex items-center gap-3 p-3 rounded-lg border transition-all text-left
                    {{ in_array($key, $selected) ? 'border-orange-500 bg-orange-50 dark:bg-orange-900/20 ring-1 ring-orange-500' : 'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <x-ui.platform-icon :platform="$account['platform']" size="sm" />
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $account['handle'] }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ $account['platform'] }}</p>
                </div>
                <svg class="w-4 h-4 {{ in_array($key, $selected) ? 'text-orange-500' : 'text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </button>
        @endforeach
    </div>
    @if(empty($selected))
        <p class="text-xs text-red-500 mt-1">⚠️ Please select at least one account to continue.</p>
    @endif
</div>