<x-ui.card>
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Platform Connections</h3>
    <div class="space-y-3">
        @foreach($platforms as $platform)
            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-orange-200 dark:hover:border-orange-700 transition-all">
                <div class="flex items-center gap-4">
                    <x-ui.platform-icon :platform="$platform['id']" size="lg" />
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $platform['name'] }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <x-ui.badge :variant="match($platform['status']) { 'active' => 'success', 'token_expiring_soon' => 'warning', default => 'neutral' }" :dot="true">
                                {{ ucfirst(str_replace('_', ' ', $platform['status'])) }}
                            </x-ui.badge>
                            @if($platform['connected'])
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ count($platform['accounts']) }} account(s)</span>
                            @endif
                        </div>
                    </div>
                </div>
                @if($platform['connected'])
                    <x-ui.button variant="outline" size="sm" wire:click="disconnect('{{ $platform['id'] }}')">Disconnect</x-ui.button>
                @else
                    <x-ui.button size="sm" wire:click="initiateOAuth('{{ $platform['id'] }}')">Connect</x-ui.button>
                @endif
            </div>
        @endforeach
    </div>
</x-ui.card>