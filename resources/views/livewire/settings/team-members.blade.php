<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ count($members) }} member(s) in your workspace</p>
        <x-ui.button wire:click="$toggle('showInviteForm')" size="sm" wire:loading.attr="disabled">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Invite Member
        </x-ui.button>
    </div>

    @if($showInviteForm)
        <x-ui.card class="!p-4 bg-orange-50 dark:bg-orange-900/10 border-orange-200 dark:border-orange-800">
            <form wire:submit="sendInvite" class="flex flex-col sm:flex-row gap-3">
                <input type="email" wire:model.live="inviteEmail" placeholder="colleague@company.com" 
                       class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500">
                <select wire:model.live="inviteRole" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="viewer">Viewer</option>
                    <option value="editor">Editor</option>
                    <option value="admin">Admin</option>
                </select>
                <x-ui.button type="submit" size="sm">Send Invite</x-ui.button>
            </form>
            @error('inviteEmail') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
        </x-ui.card>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @foreach($members as $member)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <x-ui.avatar :name="$member['name']" size="sm" class="mr-3" />
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $member['name'] ?: 'Pending Invite' }}</div>
                                    <div class="text-sm text-gray-500">{{ $member['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select wire:change="changeRole('{{ $member['id'] }}', $event.target.value)" 
                                    class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm py-1.5 px-2 focus:border-orange-500 focus:ring-orange-500">
                                @foreach(['viewer', 'editor', 'admin'] as $role)
                                    <option value="{{ $role }}" {{ $member['role'] === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-ui.badge :variant="$member['status'] === 'active' ? 'success' : 'warning'" :dot="true">{{ ucfirst($member['status']) }}</x-ui.badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="removeMember('{{ $member['id'] }}')" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>