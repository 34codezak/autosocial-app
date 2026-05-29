<div class="space-y-4">
    @forelse($accounts as $account)
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
            <div class="flex items-center gap-4">
                <x-ui.platform-icon :platform="$account['platform']" size="lg" />
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $account['handle'] }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <x-ui.badge :variant="match($account['status']) { 'active' => 'success', 'warning' => 'warning', default => 'error' }" :dot="true">
                            {{ ucfirst($account['status']) }}
                        </x-ui.badge>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Connected {{ $account['connected_at'] }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-3 sm:mt-0">
                @if($account['status'] === 'expired' || $account['status'] === 'warning')
                    <x-ui.button variant="outline" size="sm" wire:click="reconnect('{{ $account['id'] }}')">Refresh Token</x-ui.button>
                @endif
                <x-ui.button variant="ghost" size="sm" wire:click="revoke('{{ $account['id'] }}')" class="text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20">Disconnect</x-ui.button>
            </div>
        </div>
    @empty
        <x-ui.empty-state title="No connected accounts" description="Connect your social platforms to start publishing and tracking analytics." />
    @endforelse
</div>