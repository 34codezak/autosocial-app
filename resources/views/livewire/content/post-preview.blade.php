<div class="space-y-4">
    <div class="flex justify-center gap-2 mb-4">
        @foreach(['twitter', 'linkedin', 'instagram'] as $plat)
            @if(in_array($plat, $platforms))
                <button wire:click="setActive('{{ $plat }}')"
                        class="px-3 py-1.5 text-xs font-medium rounded-full transition {{ $activePlatform === $plat ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                    {{ ucfirst($plat) }}
                </button>
            @endif
        @endforeach
    </div>

    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
        @if($activePlatform === 'twitter')
            <div class="flex gap-3">
                <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-lg shrink-0">👤</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-gray-900 dark:text-white">Your Brand</span>
                        <span class="text-gray-500 text-sm">@yourbrand</span>
                    </div>
                    <p class="mt-2 text-gray-800 dark:text-gray-200 whitespace-pre-wrap break-words">{{ $content ?: 'Your post content will appear here...' }}</p>
                    @if(count($media) > 0)
                        <div class="mt-3 grid grid-cols-2 gap-2 rounded-xl overflow-hidden">
                            <div class="h-32 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 text-xs">Media 1</div>
                            <div class="h-32 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 text-xs">Media 2</div>
                        </div>
                    @endif
                </div>
            </div>
        @elseif($activePlatform === 'linkedin')
            <div class="flex gap-3">
                <div class="h-12 w-12 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></div>
                <div class="flex-1">
                    <div class="font-bold text-gray-900 dark:text-white">Your Brand</div>
                    <div class="text-xs text-gray-500">Just now</div>
                    <p class="mt-2 text-gray-800 dark:text-gray-200 whitespace-pre-wrap line-clamp-4">{{ $content ?: 'Your post content will appear here...' }}</p>
                    @if(count($media) > 0)
                        <div class="mt-3 h-48 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400">Image Preview</div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center">
                <div class="h-56 bg-gray-200 dark:bg-gray-700 rounded-lg mb-3 flex items-center justify-center text-gray-400">Instagram Preview</div>
                <p class="text-sm text-gray-800 dark:text-gray-200 text-left whitespace-pre-wrap">{{ $content ?: 'Your caption will appear here...' }}</p>
            </div>
        @endif
    </div>
</div>