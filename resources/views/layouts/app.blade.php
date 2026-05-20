<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>


<!--

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); 
               if (darkMode) document.documentElement.classList.add('dark');
               window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                   if (localStorage.getItem('darkMode') === null) {
                       document.documentElement.classList.toggle('dark', e.matches);
                   }
               });"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta --}}
    <title>@yield('title', 'AutoSocial - Social Media Automation on Autopilot')</title>
    <meta name="description" content="@yield('description', 'Manage all your social platforms from one intelligent dashboard. AI-powered scheduling, analytics, and growth tools.')">
    <meta name="keywords" content="social media management, content scheduling, AI marketing, analytics, automation">
    
    {{-- Open Graph / Twitter Cards --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og:title', 'AutoSocial')">
    <meta property="og:description" content="@yield('og:description', 'Your Growth, On Autopilot.')">
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))">
    <meta property="og:url" content="@yield('og:url', request()->url())">
    <meta name="twitter:card" content="summary_large_image">
    
    {{-- Accessibility --}}
    <link rel="preload" href="{{ asset('fonts/inter-var.woff2') }}" as="font" type="font/woff2" crossorigin>
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('icon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    
    {{-- Structured Data --}}
    @stack('structured-data')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-accent-800 dark:text-accent-200 antialiased transition-colors duration-200">
    
    {{-- Skip to Content (Accessibility) --}}
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary-600 focus:text-white focus:rounded-lg">
        Skip to main content
    </a>

    {{-- Navbar Component --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main id="main-content" class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer Component --}}
    @include('components.footer')

    {{-- Floating Support Widget --}}
    @include('components.support-widget')

    {{-- Scripts --}}
    @livewireScripts
    @stack('scripts')
    
    {{-- Cookie Consent (GDPR) --}}
    @include('components.cookie-consent')
</body>
</html>

-->
