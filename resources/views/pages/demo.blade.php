@extends('layouts.app')

@section('title', 'Interactive Demo - AutoSocial')
@section('description', 'Experience AutoSocial before you sign up. Try our interactive demo dashboard with sample data.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 bg-gradient-to-b from-primary-50 to-white dark:from-slate-900 dark:to-slate-800">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 mb-6">
                🎥 No Signup Required
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Try AutoSocial Before You Commit
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Explore our interactive demo with sample data. See exactly how AutoSocial works—no credit card, no email required.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <button @click="$dispatch('scroll-to-demo')" 
                        class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-medium hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                    Jump to Demo
                </button>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-xl font-medium hover:border-primary-400 transition-colors">
                    Start Free Trial →
                </a>
            </div>
        </div>
    </section>

    {{-- Video Walkthrough --}}
    <section class="py-12">
        <div class="max-w-5xl mx-auto px-4">
            <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl border border-accent-200 dark:border-slate-700 bg-accent-100 dark:bg-slate-800 flex items-center justify-center">
                {{-- Placeholder for video embed --}}
                <div class="text-center p-8">
                    <div class="w-20 h-20 mx-auto bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-accent-600 dark:text-accent-300 font-medium">Demo Video Loading...</p>
                    <p class="text-sm text-accent-400 mt-2">3:24 • Dashboard walkthrough, scheduling, analytics</p>
                </div>
                {{-- Real implementation: --}}
                {{-- <iframe src="https://player.vimeo.com/video/..." class="w-full h-full" frameborder="0" allow="autoplay; fullscreen" allowfullscreen loading="lazy"></iframe> --}}
            </div>
        </div>
    </section>

    {{-- Interactive Mock Dashboard --}}
    <section id="demo-section" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-4">
                    Interactive Demo Dashboard
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    Click around to explore key features. All data is sample content.
                </p>
            </div>

            @livewire('marketing.demo-carousel')

            <div class="mt-12 grid md:grid-cols-3 gap-6">
                @php
                    $highlights = [
                        ['title' => 'Drag & Drop Scheduling', 'desc' => 'Move posts between days with a simple drag. Changes save automatically.'],
                        ['title' => 'AI Content Assistant', 'desc' => 'Click the magic wand to generate caption variations, hashtags, or rewrite tone.'],
                        ['title' => 'Real-Time Preview', 'desc' => 'See exactly how your post will look on each platform before publishing.'],
                    ];
                @endphp
                @foreach($highlights as $item)
                    <div class="p-5 rounded-xl bg-accent-50 dark:bg-slate-800/50 border border-accent-200 dark:border-slate-700">
                        <h4 class="font-semibold text-accent-800 dark:text-white mb-2">{{ $item['title'] }}</h4>
                        <p class="text-sm text-accent-500 dark:text-accent-400">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Feature Mini-Demos --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-accent-800 dark:text-white mb-12">
                See Key Features in Action
            </h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                {{-- AI Caption Generator --}}
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center">
                            @include('components.icons.sparkles')
                        </div>
                        <h3 class="font-semibold text-accent-800 dark:text-white">AI Caption Generator</h3>
                    </div>
                    <div class="bg-accent-50 dark:bg-slate-900 rounded-xl p-4 mb-4">
                        <p class="text-sm text-accent-500 dark:text-accent-400 mb-2">Input:</p>
                        <p class="text-accent-800 dark:text-white font-medium">"New product launch for eco-friendly water bottles"</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-accent-600 dark:text-accent-300">✨ <strong>Generated:</strong> "Hydrate sustainably 🌱 Our new eco-bottles are here! Made from 100% recycled materials. #EcoFriendly #Sustainability"</p>
                        <p class="text-sm text-accent-600 dark:text-accent-300">✨ <strong>Tone: Professional:</strong> "Introducing our latest innovation in sustainable hydration. Crafted from recycled materials for the environmentally conscious consumer."</p>
                    </div>
                </div>

                {{-- Analytics Preview --}}
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center">
                            @include('components.icons.chart')
                        </div>
                        <h3 class="font-semibold text-accent-800 dark:text-white">Analytics Snapshot</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="p-3 bg-accent-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-xs text-accent-500">Engagement Rate</p>
                            <p class="text-xl font-bold text-primary-600">4.8%</p>
                            <p class="text-xs text-green-600">↑ 12% vs last week</p>
                        </div>
                        <div class="p-3 bg-accent-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-xs text-accent-500">Top Post</p>
                            <p class="text-sm font-medium text-accent-800 dark:text-white">"Summer Sale"</p>
                            <p class="text-xs text-accent-500">2.4K engagements</p>
                        </div>
                    </div>
                    <div class="h-32 bg-accent-100 dark:bg-slate-700 rounded-lg flex items-center justify-center">
                        <p class="text-sm text-accent-400">[Interactive chart would render here]</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Your free trial includes all Pro features. No credit card required.
            </p>
            <a href="{{ route('register') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold text-lg hover:from-primary-600 hover:to-primary-700 transition-all shadow-xl shadow-primary-500/30">
                Start Your Free Trial
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <p class="mt-6 text-sm text-accent-400">
                ✓ Full access to all features &nbsp; • &nbsp; ✓ Cancel anytime &nbsp; • &nbsp; ✓ Data exports included
            </p>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('livewire:initialized', () => {
    window.addEventListener('scroll-to-demo', () => {
        document.getElementById('demo-section')?.scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
@endpush