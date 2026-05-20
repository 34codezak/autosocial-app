@extends('layouts.app')

@section('title', 'Features - AutoSocial | Complete Social Media Toolkit')
@section('description', 'Explore AutoSocial\'s powerful features: AI content creation, smart scheduling, team collaboration, analytics, and automation tools.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Everything You Need to Grow
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400">
                Powerful features designed for creators, brands, and agencies.
            </p>
        </div>
    </section>

    {{-- Feature Categories --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                @php
                    $categories = ['All', 'Content', 'Scheduling', 'Analytics', 'Team', 'Automation'];
                @endphp
                @foreach($categories as $cat)
                    <button class="px-4 py-2 rounded-full text-sm font-medium bg-accent-100 dark:bg-slate-800 text-accent-700 dark:text-accent-300 hover:bg-primary-100 hover:text-primary-700 transition-colors"
                            x-data
                            @click="$dispatch('filter-features', { category: '{{ $cat }}' })">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" 
                 x-data="{ filter: 'All' }"
                 @filter-features.window="filter = $event.detail.category">
                
                @php
                    $features = [
                        ['category' => 'Content', 'icon' => 'pencil', 'title' => 'AI Caption Generator', 'desc' => 'Generate on-brand captions in seconds. Supports 20+ languages and tone customization.'],
                        ['category' => 'Content', 'icon' => 'hashtag', 'title' => 'Smart Hashtag Suggestions', 'desc' => 'AI recommends high-performing hashtags based on your content and audience.'],
                        ['category' => 'Content', 'icon' => 'image', 'title' => 'Media Library', 'desc' => 'Organize images, videos, and GIFs with tags, folders, and AI-powered search.'],
                        
                        ['category' => 'Scheduling', 'icon' => 'calendar', 'title' => 'Visual Calendar', 'desc' => 'Drag-and-drop scheduling with color-coded platforms and status indicators.'],
                        ['category' => 'Scheduling', 'icon' => 'clock', 'title' => 'Best Time Suggestions', 'desc' => 'AI analyzes your audience activity to recommend optimal posting times.'],
                        ['category' => 'Scheduling', 'icon' => 'repeat', 'title' => 'Recurring Posts', 'desc' => 'Set evergreen content to auto-repost on your schedule.'],
                        
                        ['category' => 'Analytics', 'icon' => 'chart', 'title' => 'Unified Analytics', 'desc' => 'See performance across all platforms in one dashboard. Export custom reports.'],
                        ['category' => 'Analytics', 'icon' => 'trending', 'title' => 'Engagement Predictions', 'desc' => 'AI forecasts post performance before you publish.'],
                        ['category' => 'Analytics', 'icon' => 'report', 'title' => 'ROI Tracking', 'desc' => 'Connect UTM parameters to track conversions from social posts.'],
                        
                        ['category' => 'Team', 'icon' => 'users', 'title' => 'Role-Based Permissions', 'desc' => 'Control access with Owner, Admin, Creator, Analyst, and Viewer roles.'],
                        ['category' => 'Team', 'icon' => 'approval', 'title' => 'Approval Workflows', 'desc' => 'Require manager approval before posts go live. Customizable by platform.'],
                        ['category' => 'Team', 'icon' => 'comment', 'title' => 'Team Comments', 'desc' => 'Discuss drafts and strategies directly on posts with @mentions.'],
                        
                        ['category' => 'Automation', 'icon' => 'bot', 'title' => 'Auto-Replies', 'desc' => 'Set up AI-powered responses to common comments and DMs.'],
                        ['category' => 'Automation', 'icon' => 'refresh', 'title' => 'Content Recycling', 'desc' => 'Automatically reshare top-performing posts with fresh captions.'],
                        ['category' => 'Automation', 'icon' => 'workflow', 'title' => 'Campaign Automation', 'desc' => 'Create multi-post campaigns that publish automatically over time.'],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 hover:border-primary-300 transition-colors"
                         x-show="filter === 'All' || filter === '{{ $feature['category'] }}'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                @include("components.icons.{$feature['icon']}")
                            </div>
                            <div>
                                <h3 class="font-semibold text-accent-800 dark:text-white mb-1">{{ $feature['title'] }}</h3>
                                <p class="text-sm text-accent-500 dark:text-accent-400">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Integrations Preview --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                        Works With Your Favorite Tools
                    </h2>
                    <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                        Connect AutoSocial to your existing workflow. No more switching between tabs.
                    </p>
                    <ul class="space-y-4 mb-8">
                        @foreach(['Canva', 'Google Drive', 'Dropbox', 'Slack', 'Zapier', 'Make'] as $tool)
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-accent-600 dark:text-accent-300">{{ $tool }} integration</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('integrations') }}" class="text-primary-600 hover:text-primary-700 font-medium inline-flex items-center gap-1">
                        View all 50+ integrations
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-200 to-orange-200 dark:from-primary-900/30 dark:to-orange-900/30 rounded-3xl blur-2xl opacity-30"></div>
                    <img src="{{ asset('images/integrations-grid.png') }}" 
                         alt="AutoSocial integrations dashboard"
                         class="relative rounded-2xl shadow-xl border border-accent-200 dark:border-slate-700"
                         loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                See Features in Action
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Watch a 3-minute demo of AutoSocial's key features.
            </p>
            <a href="{{ route('demo') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                Watch Demo
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </a>
        </div>
    </section>
@endsection