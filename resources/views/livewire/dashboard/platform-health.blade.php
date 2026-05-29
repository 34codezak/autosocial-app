<div class="space-y-6">
    <x-ui.card>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Platform Connections</h3>
        <div class="space-y-3">
            @foreach($connections as $conn)
                <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">{{ match($conn['platform']) { 'Twitter' => '🐦', 'Instagram' => '📷', 'LinkedIn' => '💼', default => '🔗' } }}</span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $conn['platform'] }}</p>
                            <p class="text-xs text-gray-500">Synced {{ $conn['lastSync'] }}</p>
                        </div>
                    </div>
                    <x-ui.badge :variant="$conn['status'] === 'connected' ? 'success' : 'warning'" :dot="true">
                        {{ ucfirst($conn['status']) }}
                    </x-ui.badge>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-ui.card>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">API Quota Usage</h3>
        <div class="space-y-4">
            @foreach($apiQuotas as $quota)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-700 dark:text-gray-300">{{ $quota['platform'] }}</span>
                        <span class="text-gray-500">{{ $quota['used'] }} / {{ $quota['limit'] }} requests</span>
                    </div>
                    <x-ui.progress-bar :value="$quota['used']" :max="$quota['limit']" :variant="$quota['used'] > 80 ? 'red' : 'orange'" :showLabel="false" />
                </div>
            @endforeach
        </div>
    </x-ui.card>
</div>