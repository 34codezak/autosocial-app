<x-ui.card>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
        <x-ui.button variant="ghost" size="sm">View All</x-ui.button>
    </div>
    <div class="flow-root">
        <ul class="-mb-8">
            @foreach($activities as $activity)
                <li>
                    <div class="relative pb-8">
                        @if(!$loop->last)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                    <span class="text-sm">{{ match($activity['type']) { 'post_published' => '📝', 'connection_added' => '🔗', 'schedule_failed' => '⚠️', 'milestone' => '🎉', default => '📌' } }}</span>
                                </span>
                            </div>
                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $activity['details'] }}
                                        <span class="font-medium text-gray-900 dark:text-white ml-1">{{ $activity['platform'] }}</span>
                                    </p>
                                </div>
                                <div class="whitespace-nowrap text-right text-sm text-gray-500 dark:text-gray-400">
                                    {{ $activity['time'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-ui.card>