@props([
    'title' => config('app.name') . ' | Dashboard',
    'pollInterval' => '5s',
    'header' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-gray-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="h-full antialiased text-gray-900 dark:text-gray-100">
    <div class="h-screen flex flex-col overflow-hidden bg-gray-50 dark:bg-gray-900">
        {{-- Top Bar --}}
        <header class="flex items-center justify-between h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6">
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full animate-pulse"></span> Live
                </span>
            </div>
            {{ $header ?? '' }}
        </header>

        {{-- Main Content with Polling Context --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8"
              x-data="{ polling: true }"
              wire:poll.{{ $pollInterval }}="refreshDashboard"
              @keydown.window.ctrl.k="$refs.search.focus()">
            
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>