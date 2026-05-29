<x-ui.card class="p-0 h-[600px] flex flex-col">
    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Unified Inbox</h3>
        <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
            @foreach(['all', 'twitter', 'instagram', 'linkedin'] as $plat)
                <button wire:click="setFilter('{{ $plat }}')"
                        class="px-2.5 py-1 text-xs font-medium rounded-md transition-all {{ $filter === $plat ? 'bg-white dark:bg-gray-600 text-orange-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                    {{ ucfirst($plat) }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden">
        {{-- Message List --}}
        <div class="w-full md:w-1/3 border-r border-gray-200 dark:border-gray-700 overflow-y-auto">
            @forelse($messages as $msg)
                <div wire:click="selectMessage({{ json_encode($msg) }})"
                     class="p-4 border-b border-gray-100 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-750 transition {{ $activeMessage['id'] === $msg['id'] ? 'bg-orange-50 dark:bg-orange-900/10 border-l-4 border-l-orange-500' : '' }}">
                    <div class="flex items-start gap-3">
                        <x-ui.avatar :name="$msg['sender']" size="sm" class="shrink-0" />
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $msg['sender'] }}</p>
                                <span class="text-xs text-gray-500">{{ $msg['time'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 mt-1">
                                <x-ui.platform-icon :platform="$msg['platform']" size="sm" class="!h-4 !w-4" />
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $msg['preview'] }}</p>
                            </div>
                        </div>
                        @if($msg['unread'])
                            <span class="w-2 h-2 rounded-full bg-orange-500 shrink-0 mt-1"></span>
                        @endif
                    </div>
                </div>
            @empty
                <x-ui.empty-state icon="📭" title="No messages" description="Your inbox is empty for this filter." />
            @endforelse
        </div>

        {{-- Message Detail --}}
        <div class="hidden md:flex flex-1 flex-col p-6">
            @if($activeMessage)
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.avatar :name="$activeMessage['sender']" size="md" />
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $activeMessage['sender'] }}</p>
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <x-ui.platform-icon :platform="$activeMessage['platform']" size="sm" class="!h-3 !w-3" />
                            {{ ucfirst($activeMessage['platform']) }}
                        </p>
                    </div>
                </div>
                <div class="flex-1 bg-gray-50 dark:bg-gray-800 rounded-xl p-4 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                    {{ $activeMessage['full_text'] }}
                </div>
                <div class="mt-4">
                    <textarea class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500" rows="3" placeholder="Type a quick reply..."></textarea>
                    <div class="flex justify-end mt-2">
                        <x-ui.button size="sm">Reply</x-ui.button>
                    </div>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-12 h-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <p class="text-sm">Select a message to view details</p>
                </div>
            @endif
        </div>
    </div>
</x-ui.card>