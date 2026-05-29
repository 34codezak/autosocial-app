@props(['tabs' => [], 'default' => 0])

<div x-data="{ activeTab: @js($default) }" class="space-y-4">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Tabs">
            @foreach($tabs as $index => $tab)
                <button
                    @click="activeTab = {{ $index }}"
                    :class="{ 'border-orange-500 text-orange-600 dark:text-orange-400': activeTab === {{ $index }}, 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600': activeTab !== {{ $index }} }"
                    class="whitespace-nowrap border-b-2 py-3 px-1 text-sm font-medium transition-colors focus:outline-none"
                >
                    {{ $tab }}
                </button>
            @endforeach
        </nav>
    </div>

    <div class="relative">
        @foreach($tabs as $index => $_)
            <div x-show="activeTab === {{ $index }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                {{ ${'slot' . $index} ?? '' }}
            </div>
        @endforeach
    </div>
</div>