{{-- resources/views/components/nav-link.blade.php --}}
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-600 dark:border-primary-400 text-sm font-medium leading-5 text-primary-600 dark:text-primary-400 focus:outline-none focus:border-primary-700 dark:focus:border-primary-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-accent-500 dark:text-accent-400 hover:text-primary-600 dark:hover:text-primary-400 hover:border-accent-300 dark:hover:border-slate-600 focus:outline-none focus:text-primary-600 dark:focus:text-primary-400 focus:border-accent-300 dark:focus:border-slate-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>