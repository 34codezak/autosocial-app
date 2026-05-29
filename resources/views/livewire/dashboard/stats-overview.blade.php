<div>
    @if($loading)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach(range(1, 4) as $_)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 space-y-3">
                    <x-ui.skeleton width="w-24" height="h-4" />
                    <x-ui.skeleton width="w-16" height="h-6" />
                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($metrics as $metric)
                <x-ui.stat-card
                    :label="$metric['label']"
                    :value="$metric['value']"
                    :trend="$metric['trend']"
                    :trendUp="$metric['trendUp']"
                >
                    <x-slot:icon>{{ $metric['icon'] }}</x-slot:icon>
                </x-ui.stat-card>
            @endforeach
        </div>
    @endif
</div>