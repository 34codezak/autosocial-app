@props(['src' => null, 'name' => '', 'size' => 'md', 'status' => null])

@php
    $sizes = match($size) {
        'sm' => 'h-8 w-8 text-xs',
        'md' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
        'xl' => 'h-16 w-16 text-lg',
        default => $size,
    };
    $initials = collect(explode(' ', trim($name)))->map(fn($n) => strtoupper(substr($n, 0, 1)))->take(2)->join('');
    $bgColors = ['bg-orange-500', 'bg-red-500', 'bg-amber-500', 'bg-rose-500'];
    $bgClass = $bgColors[abs(crc32($name)) % count($bgColors)];
@endphp

<div class="relative inline-flex {{ $sizes }}">
    @if($src)
        <img class="rounded-full object-cover h-full w-full border-2 border-white dark:border-gray-800" src="{{ $src }}" alt="{{ $name }}">
    @else
        <div class="rounded-full flex items-center justify-center text-white font-semibold {{ $bgClass }} h-full w-full border-2 border-white dark:border-gray-800 shadow-sm">
            {{ $initials ?: '?' }}
        </div>
    @endif

    @if($status)
        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full ring-2 ring-white dark:ring-gray-800 {{ match($status) { 'online' => 'bg-green-400', 'busy' => 'bg-red-500', 'away' => 'bg-yellow-400', default => 'bg-gray-300 dark:bg-gray-500' } }}"></span>
    @endif
</div>