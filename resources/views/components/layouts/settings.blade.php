@props([
    'title' => 'Settings',
    'navigation' => null,
    'activeTab' => 'general',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-gray-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | Settings</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="h-full antialiased text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-12 gap-6">
            {{-- Navigation Column --}}
            <aside class="col-span-12 lg:col-span-3">
                <nav class="space-y-1" aria-label="Settings navigation">
                    {{ $navigation ?? '' }}
                </nav>
            </aside>

            {{-- Content Column --}}
            <main class="col-span-12 lg:col-span-9">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="px-4 py-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your account and workspace preferences.</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>