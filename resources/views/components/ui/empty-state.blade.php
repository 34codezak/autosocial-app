@props(['icon' => null, 'title' => 'No data found', 'description' => ''])

<div class="flex flex-col items-center justify-center py-16 px-4 text-center">
    @if($icon)
        <div class="text-gray-300 dark:text-gray-600 mb-4">
            {{ $icon }}
        </div>
    @endif
    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
    @if($description)
        <p class="mt-1 max-w-md text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
    @endif
    @if(isset($actions))
        <div class="mt-6 flex gap-3">
            {{ $actions }}
        </div>
    @endif
</div>