@extends('components.layouts.app')

@section('title', 'AutoSocial - Social Media Automation on Autopilot')
@section('description', 'Manage all your social platforms from one intelligent dashboard. AI-powered content creation, scheduling, and analytics for brands, agencies, and creators.')

@section('content')
    <!-- Hero Section -->
    @include('components.hero', [
        'headline' => 'Your Growth, On Autopilot.',
        'subheadline' => 'Manage all your social platforms from one intelligent dashboard. AI-powered scheduling, analytics, and content creation.',
        'primaryCta' => ['text' => 'Start Free Trial', 'url' => route('register')],
        'secondaryCta' => ['text' => 'Watch Demo', 'url' => route('demo')],
        'heroImage' => asset('images/hero-dashboard.png'),
        'trustBadges' => [
            ['label' => '14-day free trial', 'icon' => 'check'],
            ['label' => 'No credit card required', 'icon' => 'shield'],
            ['label' => 'Cancel anytime', 'icon' => 'clock'],
        ]
    ])

    <!-- Social Proof -->
    <section class="py-12 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-accent-500 text-sm font-medium mb-6">Trusted by 10,000+ brands and creators</p>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-70">
                <!-- Logo placeholders - replace with actual SVGs -->
                @foreach(['Brand1', 'Brand2', 'Brand3', 'Brand4', 'Brand5', 'Brand6'] as $brand)
                    <div class="flex justify-center">
                        <span class="text-accent-400 dark:text-slate-500 font-semibold">{{ $brand }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Problems Solved -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-4">
                    Stop Struggling With Social Media
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    AutoSocial solves the challenges that keep marketers up at night.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @include('components.feature-card', [
                    'icon' => 'calendar',
                    'title' => 'Inconsistent Posting',
                    'description' => 'Never miss a beat. Schedule weeks of content in minutes with our intelligent calendar.',
                ])
                @include('components.feature-card', [
                    'icon' => 'chart',
                    'title' => 'Low Engagement',
                    'description' => 'AI analyzes your audience to suggest optimal posting times and content that converts.',
                ])
                @include('components.feature-card', [
                    'icon' => 'clock',
                    'title' => 'Time-Consuming Management',
                    'description' => 'Automate repetitive tasks. Focus on strategy while AutoSocial handles execution.',
                ])
                @include('components.feature-card', [
                    'icon' => 'analytics',
                    'title' => 'Poor Analytics',
                    'description' => 'Get actionable insights, not just numbers. Understand what drives real growth.',
                ])
                @include('components.feature-card', [
                    'icon' => 'layers',
                    'title' => 'Platform Chaos',
                    'description' => 'One dashboard for Facebook, Instagram, X, LinkedIn, TikTok, and more.',
                ])
                @include('components.feature-card', [
                    'icon' => 'team',
                    'title' => 'Team Coordination',
                    'description' => 'Collaborate seamlessly with approval workflows and role-based permissions.',
                ])
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-4">
                    How AutoSocial Works
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    From idea to impact in five simple steps.
                </p>
            </div>

            <div class="relative">
                <!-- Connection Line (Desktop) -->
                <div class="hidden md:block absolute top-1/2 left-0 right-0 h-0.5 bg-gradient-to-r from-primary-200 to-primary-400 -translate-y-1/2"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-5 gap-8 relative">
                    @php
                        $steps = [
                            ['num' => '01', 'title' => 'Create Content', 'desc' => 'Write captions, upload media, or let AI generate ideas'],
                            ['num' => '02', 'title' => 'Schedule Posts', 'desc' => 'Drag & drop to calendar or set recurring schedules'],
                            ['num' => '03', 'title' => 'AI Optimizes', 'desc' => 'Smart timing suggestions based on audience activity'],
                            ['num' => '04', 'title' => 'Auto Publish', 'desc' => 'Posts go live automatically across all platforms'],
                            ['num' => '05', 'title' => 'Track Analytics', 'desc' => 'Real-time insights and AI-powered growth recommendations'],
                        ];
                    @endphp
                    
                    @foreach($steps as $step)
                        <div class="relative text-center group">
                            <div class="w-12 h-12 mx-auto bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-full flex items-center justify-center font-bold mb-4 shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform">
                                {{ $step['num'] }}
                            </div>
                            <h3 class="font-semibold text-accent-800 dark:text-white mb-2">{{ $step['title'] }}</h3>
                            <p class="text-sm text-accent-500 dark:text-accent-400">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Supported Platforms -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-4">
                Connect Your Favorite Platforms
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-12">
                One login. All your social accounts.
            </p>
            
            <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                @foreach(['Facebook', 'Instagram', 'X', 'LinkedIn', 'TikTok', 'Pinterest', 'YouTube'] as $platform)
                    <div class="flex flex-col items-center p-4 rounded-xl bg-accent-50 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-slate-700 transition-colors group">
                        <div class="w-16 h-16 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="text-2xl font-bold text-accent-400 group-hover:text-primary-500 transition-colors">
                                {{ substr($platform, 0, 1) }}
                            </span>
                        </div>
                        <span class="text-sm font-medium text-accent-600 dark:text-accent-300">{{ $platform }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-4">
                    Loved by Marketers Worldwide
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    See why teams choose AutoSocial for their social media growth.
                </p>
            </div>
            
            @livewire('marketing.testimonial-slider')
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-6">
                Ready to Automate Your Social Growth?
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Join 10,000+ brands saving 10+ hours per week with AutoSocial.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                   class="px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold text-lg hover:from-primary-600 hover:to-primary-700 transition-all shadow-xl shadow-primary-500/30">
                    Start Your Free Trial
                </a>
                <a href="{{ route('demo') }}" 
                   class="px-8 py-4 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border-2 border-accent-200 dark:border-slate-600 rounded-xl font-semibold text-lg hover:border-primary-400 dark:hover:border-primary-500 transition-colors">
                    Watch Demo →
                </a>
            </div>
            <p class="mt-6 text-sm text-accent-400">
                ✓ 14-day free trial &nbsp; • &nbsp; ✓ No credit card required &nbsp; • &nbsp; ✓ Cancel anytime
            </p>
        </div>
    </section>
@endsection

@push('structured-data')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "AutoSocial",
  "applicationCategory": "SocialMediaManagementApplication",
  "operatingSystem": "Web",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD",
    "description": "Free 14-day trial, no credit card required"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "1247"
  }
}
</script>
@endverbatim
@endpush