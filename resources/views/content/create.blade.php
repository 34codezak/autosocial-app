<x-layouts.app title="Create Content">
    <x-slot:header>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Content Studio</h2>
    </x-slot:header>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <livewire:content.post-composer />
            <livewire:content.content-calendar />
        </div>
        <div class="space-y-6">
            <livewire:content.media-library />
            <livewire:content.hashtag-manager />
            <livewire:content.schedule-picker />
        </div>
    </div>
</x-layouts.app>