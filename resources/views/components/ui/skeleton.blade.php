@props(['width' => 'w-full', 'height' => 'h-4', 'rounded' => true, 'animate' => true])

<div {{ $attributes->merge(['class' => "$width $height bg-gray-200 dark:bg-gray-700 " . ($rounded ? 'rounded' : '') . ($animate ? ' animate-pulse' : '')]) }}></div>