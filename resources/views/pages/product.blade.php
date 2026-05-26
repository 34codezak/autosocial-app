@extends('components.layouts.app')

@section('title', 'Product - AutoSocial | Social Media Automation Platform')
@section('description', 'Discover how AutoSocial helps you manage, schedule, and grow your social media presence with AI-powered tools and real-time analytics.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 bg-gradient-to-b from-primary-50 to-white dark:from-slate-900 dark:to-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 mb-6">
                        ✨ AI-Powered Platform
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                        One Dashboard.<br/>
                        <span class="text-primary-600">All Your Social Growth.</span>
                    </h1>
                    <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                        AutoSocial unifies content creation, scheduling, publishing, and analytics into one intelligent platform. Spend less time managing tools, more time growing your brand.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-medium hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                            Start Free Trial
                        </a>
                        <a href="{{ route('demo') }}" class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-xl font-medium hover:border-primary-400 transition-colors">
                            Watch Demo →
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-200 to-orange-200 dark:from-primary-900/30 dark:to-orange-900/30 rounded-3xl blur-2xl opacity-30"></div>
                    <img src="{{ asset('images/product-dashboard.png') }}" 
                         alt="AutoSocial dashboard showing content calendar and analytics"
                         class="relative rounded-2xl shadow-2xl border border-accent-200 dark:border-slate-700"
                         loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- Core Value Props --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-4">
                    Built for Modern Social Teams
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    Whether you're a solo creator or a 50-person agency, AutoSocial scales with your needs.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $props = [
                        [
                            'icon' => 'bolt',
                            'title' => 'Lightning Fast',
                            'desc' => 'Publish to 7+ platforms simultaneously. Queue management handles 10,000+ posts/day without slowdowns.',
                            'stats' => ['99.9% uptime', '<2s publish latency']
                        ],
                        [
                            'icon' => 'brain',
                            'title' => 'AI That Understands',
                            'desc' => 'Our models are trained on social media best practices. Get captions, hashtags, and timing suggestions that actually convert.',
                            'stats' => ['4.9/5 user rating', '87% engagement lift']
                        ],
                        [
                            'icon' => 'shield',
                            'title' => 'Enterprise Security',
                            'desc' => 'SOC 2 compliant, end-to-end encryption for tokens, and granular team permissions. Your data stays yours.',
                            'stats' => ['GDPR ready', 'ISO 27001 certified']
                        ],
                    ];
                @endphp

                @foreach($props as $prop)
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 hover:border-primary-300 transition-colors">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                            @include("components.icons.{$prop['icon']}")
                        </div>
                        <h3 class="text-xl font-semibold text-accent-800 dark:text-white mb-2">{{ $prop['title'] }}</h3>
                        <p class="text-accent-500 dark:text-accent-400 mb-4">{{ $prop['desc'] }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($prop['stats'] as $stat)
                                <span class="px-2 py-1 text-xs bg-accent-100 dark:bg-slate-700 text-accent-600 dark:text-accent-300 rounded">{{ $stat }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Workflow Visualization --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-4">
                    Your Workflow, Simplified
                </h2>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    From idea to impact in minutes, not hours.
                </p>
            </div>

            <div class="relative">
                {{-- Desktop Timeline --}}
                <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-primary-200 via-primary-400 to-primary-200 -translate-y-1/2"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    @php
                        $steps = [
                            ['icon' => 'pencil', 'title' => 'Create', 'desc' => 'Write captions, upload media, or use AI to generate content ideas'],
                            ['icon' => 'calendar', 'title' => 'Schedule', 'desc' => 'Drag to calendar, set recurring posts, or let AI suggest optimal times'],
                            ['icon' => 'rocket', 'title' => 'Publish', 'desc' => 'Auto-publish to all connected platforms with platform-optimized formatting'],
                            ['icon' => 'chart', 'title' => 'Analyze', 'desc' => 'Real-time analytics with AI insights to refine your strategy'],
                        ];
                    @endphp
                    
                    @foreach($steps as $i => $step)
                        <div class="relative text-center group">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary-500/30 group-hover:scale-105 transition-transform z-10">
                                @include("components.icons.{$step['icon']}")
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-white dark:bg-slate-800 rounded-full border-2 border-primary-400 flex items-center justify-center text-xs font-bold text-primary-600 z-20">
                                {{ $i + 1 }}
                            </div>
                            <h3 class="font-semibold text-accent-800 dark:text-white mb-2">{{ $step['title'] }}</h3>
                            <p class="text-sm text-accent-500 dark:text-accent-400">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Platform Support --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-4">
                Connect Any Platform
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-12">
                One login. All your social accounts. Always up-to-date.
            </p>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach([
                    ['Facebook', 'bg-[#1877F2]'],
                    ['Instagram', 'bg-gradient-to-tr from-[#f09433] via-[#e6683c] to-[#dc2743]'],
                    ['X', 'bg-black dark:bg-white'],
                    ['LinkedIn', 'bg-[#0A66C2]'],
                    ['TikTok', 'bg-black'],
                    ['Pinterest', 'bg-[#E60023]'],
                    ['YouTube', 'bg-[#FF0000]'],
                ] as [$name, $bg])
                    <div class="flex flex-col items-center p-4 rounded-xl bg-accent-50 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-slate-700 transition-colors group">
                        <div class="w-14 h-14 {{ $bg }} rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="text-white dark:text-black font-bold text-lg">{{ substr($name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium text-accent-600 dark:text-accent-300">{{ $name }}</span>
                    </div>
                @endforeach
            </div>
            
            <p class="mt-8 text-sm text-accent-400">
                + More platforms coming soon. <a href="{{ route('integrations') }}" class="text-primary-600 hover:underline">View all integrations →</a>
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-accent-800 dark:text-white mb-6">
                Ready to Transform Your Social Strategy?
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Join 10,000+ teams saving 10+ hours per week with AutoSocial.
            </p>
            <a href="{{ route('register') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold text-lg hover:from-primary-600 hover:to-primary-700 transition-all shadow-xl shadow-primary-500/30">
                Start Your Free Trial
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
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
    "priceCurrency": "USD"
  },
  "featureList": [
    "Multi-platform scheduling",
    "AI content generation",
    "Real-time analytics",
    "Team collaboration",
    "Approval workflows"
  ]
}
</script>
@endverbatim
@endpush