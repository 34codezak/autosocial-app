@props([
    'title' => config('app.name'),
    'sidebar' => null,
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
    <div x-data="{ sidebarOpen: false }" class="h-screen flex overflow-hidden bg-gray-100 dark:bg-gray-900">

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" @click.away="sidebarOpen = false" class="fixed inset-0 z-40 flex md:hidden" x-cloak>
            <div class="fixed inset-0 bg-gray-900/50 transition-opacity"></div>
            <aside class="relative flex-1 flex flex-col max-w-xs w-full bg-white dark:bg-gray-800 transition ease-in-out duration-300 transform">
                @if($sidebar)
                    {{ $sidebar }}
                @endif
            </aside>
        </div>

        {{-- Desktop Sidebar --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 z-50 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            @if($sidebar)
                {{ $sidebar }}
            @endif
        </aside>

        {{-- Main Column --}}
        <div class="flex-1 flex flex-col md:pl-64">
            {{-- Header --}}
            <header class="sticky top-0 z-30 flex items-center justify-between h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6">
                <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-label="Open sidebar">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div class="flex-1 px-4 sm:px-6">
                    {{ $header ?? '' }}
                </div>

                {{-- User/Notification Area --}}
                <div class="flex items-center gap-3" x-data="{ open: false }" @click.outside="open = false">
                    <button class="p-2 rounded-full text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <span class="sr-only">Notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <img class="h-8 w-8 rounded-full bg-gray-300" src="https://ui-avatars.com/api/?name=User&background=random" alt="">
                        </button>
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>