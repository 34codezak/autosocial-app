<x-layouts.dashboard title="Dashboard" :header="null">
    <livewire:dashboard.stats-overview />
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="lg:col-span-2">
            <livewire:dashboard.engagement-chart />
        </div>
        <div>
            <livewire:dashboard.audience-growth />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <livewire:dashboard.platform-health />
        <livewire:dashboard.recent-activity />
    </div>
</x-layouts.dashboard>

<livewire:dashboard.quick-actions />