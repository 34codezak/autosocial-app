<div class="space-y-6" x-data="{ show: @entangle('showCreate') }">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage API access for your applications.</p>
        <x-ui.button wire:click="$set('showCreate', true)" size="sm">+ Generate Key</x-ui.button>
    </div>

    @if($showCreate)
        <x-ui.card class="!p-4 bg-gray-50 dark:bg-gray-700/50">
            <form wire:submit="createKey" class="flex flex-col sm:flex-row gap-3">
                <input type="text" wire:model.live="keyName" placeholder="App name (e.g. iOS App)" 
                       class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500">
                <x-ui.button type="submit" size="sm">Create Key</x-ui.button>
            </form>
            @error('keyName') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
        </x-ui.card>
    @endif

    @if($newKey)
        <x-ui.alert variant="warning" dismissible class="mb-4">
            <div class="flex items-center justify-between">
                <span class="font-mono text-sm bg-white dark:bg-gray-800 px-2 py-1 rounded border border-dashed border-gray-300 dark:border-gray-600">{{ $newKey }}</span>
                <x-ui.button variant="ghost" size="sm" @click="navigator.clipboard.writeText(@js($newKey)); $wire.set('newKey', '')">Copy & Dismiss</x-ui.button>
            </div>
        </x-ui.alert>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Key</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created / Expires</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Last Used</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @foreach($keys as $key)
                    <tr x-data="{ revealed: false }">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $key['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-500">
                            <span x-show="!revealed" class="select-none">sk_...{{ substr($key['key'], -4) }}</span>
                            <span x-show="revealed" class="text-gray-900 dark:text-gray-200">{{ $key['key'] }}</span>
                            <button @click="revealed = !revealed" class="ml-2 text-xs text-orange-600 hover:text-orange-700" x-text="revealed ? 'Hide' : 'Show'"></button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $key['created_at'] }}</div>
                            <div class="text-xs {{ $key['expires_at'] && now()->gt($key['expires_at']) ? 'text-red-500' : 'text-gray-400' }}">
                                {{ $key['expires_at'] ? 'Expires: ' . $key['expires_at'] : 'No expiry' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key['last_used'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button wire:click="revoke('{{ $key['id'] }}')" class="text-red-600 hover:text-red-900 dark:hover:text-red-400 text-sm font-medium">Revoke</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>