@extends('layouts.app')

@section('title', 'About Us - AutoSocial | Our Mission & Team')
@section('description', 'Learn about AutoSocial\'s mission to make social media management accessible, efficient, and impactful for creators and businesses worldwide.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 bg-gradient-to-b from-primary-50 to-white dark:from-slate-900 dark:to-slate-800">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Building the Future of Social Media Management
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Founded in 2023, AutoSocial is on a mission to empower creators, brands, and agencies with intelligent tools that save time and drive growth.
            </p>
        </div>
    </section>

    {{-- Mission & Values --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                        Our Mission
                    </h2>
                    <p class="text-lg text-accent-500 dark:text-accent-400 mb-6">
                        We believe social media should be a force for connection, creativity, and business growth—not a source of stress and burnout.
                    </p>
                    <p class="text-accent-600 dark:text-accent-300 mb-8">
                        AutoSocial combines cutting-edge AI with intuitive design to help you focus on what matters: creating great content and building authentic relationships with your audience.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $values = [
                                ['icon' => 'heart', 'label' => 'User-First'],
                                ['icon' => 'lightbulb', 'label' => 'Innovation'],
                                ['icon' => 'shield', 'label' => 'Privacy'],
                                ['icon' => 'globe', 'label' => 'Accessibility'],
                            ];
                        @endphp
                        @foreach($values as $value)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center">
                                    @include("components.icons.{$value['icon']}")
                                </div>
                                <span class="font-medium text-accent-700 dark:text-accent-300">{{ $value['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-200 to-orange-200 dark:from-primary-900/30 dark:to-orange-900/30 rounded-3xl blur-2xl opacity-30"></div>
                    <img src="{{ asset('images/team-photo.jpg') }}" 
                         alt="AutoSocial team"
                         class="relative rounded-2xl shadow-xl border border-accent-200 dark:border-slate-700"
                         loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- Story Timeline --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-accent-800 dark:text-white mb-12">
                Our Journey
            </h2>
            
            <div class="relative">
                {{-- Timeline line --}}
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-primary-200 dark:bg-slate-600 hidden md:block"></div>
                
                <div class="space-y-12">
                    @php
                        $timeline = [
                            ['year' => '2023', 'title' => 'Founded', 'desc' => 'AutoSocial launched with a vision: make social media management joyful, not overwhelming.'],
                            ['year' => '2024', 'title' => 'AI Integration', 'desc' => 'Introduced AI-powered content suggestions, reaching 1,000+ early users.'],
                            ['year' => '2025', 'title' => 'Team Collaboration', 'desc' => 'Added approval workflows and role-based permissions for agencies.'],
                            ['year' => '2026', 'title' => 'Global Scale', 'desc' => 'Now serving 10,000+ users across 50+ countries with 99.9% uptime.'],
                        ];
                    @endphp
                    @foreach($timeline as $item)
                        <div class="relative flex gap-6 md:gap-8">
                            <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-primary-500/30">
                                {{ $item['year'] }}
                            </div>
                            <div class="pt-1">
                                <h3 class="text-xl font-semibold text-accent-800 dark:text-white mb-2">{{ $item['title'] }}</h3>
                                <p class="text-accent-500 dark:text-accent-400">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Team Preview --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-accent-800 dark:text-white mb-12">
                Meet the Team
            </h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $team = [
                        ['name' => 'Alex Chen', 'role' => 'CEO & Co-Founder', 'bio' => 'Ex-social media manager turned builder. Passionate about ethical AI.'],
                        ['name' => 'Maya Rodriguez', 'role' => 'CTO & Co-Founder', 'bio' => 'Full-stack engineer focused on scalable, accessible architecture.'],
                        ['name' => 'James Okonkwo', 'role' => 'Head of Design', 'bio' => 'Creating intuitive experiences that empower, not overwhelm.'],
                    ];
                @endphp
                @foreach($team as $member)
                    <div class="text-center p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700">
                        <div class="w-24 h-24 mx-auto bg-accent-200 dark:bg-slate-700 rounded-full mb-4 flex items-center justify-center">
                            <span class="text-2xl font-bold text-accent-500">{{ substr($member['name'], 0, 1) }}</span>
                        </div>
                        <h3 class="font-semibold text-accent-800 dark:text-white mb-1">{{ $member['name'] }}</h3>
                        <p class="text-sm text-primary-600 dark:text-primary-400 mb-3">{{ $member['role'] }}</p>
                        <p class="text-sm text-accent-500 dark:text-accent-400">{{ $member['bio'] }}</p>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="text-primary-600 hover:text-primary-700 font-medium inline-flex items-center gap-1">
                    View all team members
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                Join Our Mission
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Whether you're a user, partner, or potential team member—we'd love to hear from you.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-medium hover:from-primary-600 hover:to-primary-700 transition-all">
                    Start Free Trial
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-xl font-medium hover:border-primary-400 transition-colors">
                    Contact Us
                </a>
                <a href="#" class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-xl font-medium hover:border-primary-400 transition-colors">
                    Careers →
                </a>
            </div>
        </div>
    </section>
@endsection