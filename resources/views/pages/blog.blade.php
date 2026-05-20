@extends('layouts.app')

@section('title', 'Blog - AutoSocial | Social Media Tips & Insights')
@section('description', 'Expert tips, platform updates, and growth strategies for social media managers, creators, and brands.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 bg-gradient-to-b from-primary-50 to-white dark:from-slate-900 dark:to-slate-800">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 mb-6">
                📚 Resources & Insights
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                The AutoSocial Blog
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Actionable strategies, platform updates, and behind-the-scenes stories to help you grow your social presence.
            </p>
            
            {{-- Search & Filter --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-2xl mx-auto">
                <input type="search" 
                       placeholder="Search articles..." 
                       class="flex-1 px-4 py-3 rounded-xl border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                       aria-label="Search blog posts">
                <select class="px-4 py-3 rounded-xl border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        aria-label="Filter by category">
                    <option>All Categories</option>
                    <option>Strategy</option>
                    <option>Platform Updates</option>
                    <option>AI & Automation</option>
                    <option>Case Studies</option>
                </select>
            </div>
        </div>
    </section>

    {{-- Featured Post --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-8">Featured</h2>
            
            <article class="grid md:grid-cols-2 gap-8 p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 hover:border-primary-300 transition-colors">
                <div>
                    <span class="inline-block px-3 py-1 text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 rounded-full mb-4">
                        Strategy
                    </span>
                    <h3 class="text-2xl font-bold text-accent-800 dark:text-white mb-3">
                        <a href="#" class="hover:text-primary-600 transition-colors">The 2026 Social Media Playbook: What's Working Now</a>
                    </h3>
                    <p class="text-accent-500 dark:text-accent-400 mb-4">
                        Discover the tactics top brands are using to cut through the noise and drive real engagement in 2026.
                    </p>
                    <div class="flex items-center gap-4 text-sm text-accent-400">
                        <span>By Sarah Kim</span>
                        <span>•</span>
                        <span>Jun 12, 2026</span>
                        <span>•</span>
                        <span>8 min read</span>
                    </div>
                </div>
                <div class="rounded-xl overflow-hidden bg-accent-100 dark:bg-slate-700 aspect-video flex items-center justify-center">
                    <span class="text-accent-400">[Featured image]</span>
                </div>
            </article>
        </div>
    </section>

    {{-- Blog Posts Grid --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-8">Latest Articles</h2>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $posts = [
                        ['category' => 'Platform Updates', 'title' => 'Instagram\'s New Algorithm: What Changed & How to Adapt', 'excerpt' => 'Break down the latest Instagram update and actionable steps to maintain your reach.', 'author' => 'Maya R.', 'date' => 'Jun 10', 'readTime' => '5 min'],
                        ['category' => 'AI & Automation', 'title' => 'Using AI for Social Media: A Practical Guide for Beginners', 'excerpt' => 'Learn how to leverage AI tools without losing your brand voice or authenticity.', 'author' => 'Alex C.', 'date' => 'Jun 8', 'readTime' => '7 min'],
                        ['category' => 'Case Study', 'title' => 'How a Local Bakery Grew Instagram Followers by 300% in 90 Days', 'excerpt' => 'Real results from a small business using AutoSocial\'s scheduling and analytics.', 'author' => 'James O.', 'date' => 'Jun 5', 'readTime' => '6 min'],
                        ['category' => 'Strategy', 'title' => 'Content Pillars: Build a Sustainable Social Strategy', 'excerpt' => 'Define your core themes to create consistent, on-brand content that resonates.', 'author' => 'Sarah K.', 'date' => 'Jun 3', 'readTime' => '4 min'],
                        ['category' => 'Platform Updates', 'title' => 'TikTok for Business: New Features You Should Know', 'excerpt' => 'Explore TikTok\'s latest business tools and how to integrate them into your workflow.', 'author' => 'Maya R.', 'date' => 'May 30', 'readTime' => '5 min'],
                        ['category' => 'AI & Automation', 'title' => 'Automating Engagement: When (and When Not) to Use Auto-Replies', 'excerpt' => 'Best practices for using AI-powered responses while maintaining authentic connections.', 'author' => 'Alex C.', 'date' => 'May 28', 'readTime' => '6 min'],
                    ];
                @endphp
                
                @foreach($posts as $post)
                    <article class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 hover:border-primary-300 transition-colors">
                        <span class="inline-block px-2 py-1 text-xs font-medium bg-accent-100 dark:bg-slate-700 text-accent-600 dark:text-accent-300 rounded mb-3">
                            {{ $post['category'] }}
                        </span>
                        <h3 class="text-xl font-semibold text-accent-800 dark:text-white mb-2">
                            <a href="#" class="hover:text-primary-600 transition-colors">{{ $post['title'] }}</a>
                        </h3>
                        <p class="text-accent-500 dark:text-accent-400 mb-4">{{ $post['excerpt'] }}</p>
                        <div class="flex items-center gap-3 text-sm text-accent-400">
                            <span>By {{ $post['author'] }}</span>
                            <span>•</span>
                            <span>{{ $post['date'] }}</span>
                            <span>•</span>
                            <span>{{ $post['readTime'] }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="flex justify-center mt-12">
                <nav class="flex items-center gap-2" aria-label="Blog pagination">
                    <button class="px-4 py-2 rounded-lg border border-accent-200 dark:border-slate-600 text-accent-500 hover:bg-accent-50 dark:hover:bg-slate-700 transition-colors" disabled>
                        ← Previous
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-primary-600 text-white font-medium">1</button>
                    <button class="px-4 py-2 rounded-lg border border-accent-200 dark:border-slate-600 text-accent-600 dark:text-accent-300 hover:bg-accent-50 dark:hover:bg-slate-700 transition-colors">2</button>
                    <button class="px-4 py-2 rounded-lg border border-accent-200 dark:border-slate-600 text-accent-600 dark:text-accent-300 hover:bg-accent-50 dark:hover:bg-slate-700 transition-colors">3</button>
                    <span class="px-2 text-accent-400">...</span>
                    <button class="px-4 py-2 rounded-lg border border-accent-200 dark:border-slate-600 text-accent-600 dark:text-accent-300 hover:bg-accent-50 dark:hover:bg-slate-700 transition-colors">
                        Next →
                    </button>
                </nav>
            </div>
        </div>
    </section>

    {{-- Newsletter Signup --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-2xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-4">
                Get Insights Delivered
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Join 15,000+ marketers receiving our weekly newsletter with tips, updates, and exclusive resources.
            </p>
            @livewire('marketing.newsletter-signup')
            <p class="mt-4 text-xs text-accent-400">
                No spam. Unsubscribe anytime. Read our <a href="#" class="underline">privacy policy</a>.
            </p>
        </div>
    </section>
@endsection