@extends('layouts.app')

@section('title', 'Integrations - AutoSocial | Connect Your Tools')
@section('description', 'Connect AutoSocial with 50+ tools including Canva, Google Drive, Slack, Zapier, and more. Streamline your social media workflow.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Connect Your Entire Workflow
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400">
                AutoSocial integrates with the tools you already use. No more context switching.
            </p>
        </div>
    </section>

    {{-- Integration Categories --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-16">
                @php
                    $categories = [
                        ['icon' => 'design', 'name' => 'Design Tools', 'count' => 12, 'tools' => ['Canva', 'Figma', 'Adobe Express']],
                        ['icon' => 'storage', 'name' => 'Cloud Storage', 'count' => 8, 'tools' => ['Google Drive', 'Dropbox', 'OneDrive']],
                        ['icon' => 'communication', 'name' => 'Team Chat', 'count' => 6, 'tools' => ['Slack', 'Microsoft Teams', 'Discord']],
                        ['icon' => 'automation', 'name' => 'Automation', 'count' => 15, 'tools' => ['Zapier', 'Make', 'n8n']],
                    ];
                @endphp
                @foreach($categories as $cat)
                    <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 text-center hover:border-primary-300 transition-colors">
                        <div class="w-12 h-12 mx-auto bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                            @include("components.icons.{$cat['icon']}")
                        </div>
                        <h3 class="font-semibold text-accent-800 dark:text-white mb-1">{{ $cat['name'] }}</h3>
                        <p class="text-sm text-accent-500 mb-3">{{ $cat['count'] }} integrations</p>
                        <p class="text-xs text-accent-400">{{ implode(', ', $cat['tools']) }} + more</p>
                    </div>
                @endforeach
            </div>

            {{-- All Integrations Grid --}}
            <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-8 text-center">All Integrations</h2>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $integrations = [
                        'Canva', 'Figma', 'Adobe Express', 'Google Drive', 'Dropbox', 'OneDrive',
                        'Slack', 'Microsoft Teams', 'Discord', 'Zapier', 'Make', 'n8n',
                        'Google Analytics', 'Bitly', 'Linktree', 'Shopify', 'WooCommerce', 'Stripe',
                        'Mailchimp', 'ConvertKit', 'HubSpot', 'Salesforce', 'Notion', 'Airtable',
                        'Trello', 'Asana', 'Monday.com', 'ClickUp', 'Buffer', 'Hootsuite',
                    ];
                @endphp
                @foreach($integrations as $tool)
                    <div class="flex flex-col items-center p-4 rounded-xl bg-accent-50 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-slate-700 transition-colors group cursor-pointer">
                        <div class="w-12 h-12 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="text-lg font-bold text-accent-400 group-hover:text-primary-500 transition-colors">{{ substr($tool, 0, 2) }}</span>
                        </div>
                        <span class="text-sm font-medium text-accent-600 dark:text-accent-300 text-center">{{ $tool }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <p class="text-accent-500 dark:text-accent-400 mb-4">Don't see your tool?</p>
                <a href="{{ route('contact') }}" class="text-primary-600 hover:text-primary-700 font-medium inline-flex items-center gap-1">
                    Request an integration
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- API & Webhooks --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                        Build Custom Integrations
                    </h2>
                    <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                        AutoSocial provides a robust REST API and webhook system for developers. Automate workflows, sync data, and build custom solutions.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-accent-600 dark:text-accent-300">REST API with OAuth 2.0 authentication</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-accent-600 dark:text-accent-300">Webhooks for real-time post status updates</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-accent-600 dark:text-accent-300">Comprehensive documentation + Postman collection</span>
                        </li>
                    </ul>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-xl font-medium hover:border-primary-400 transition-colors">
                            View API Docs
                        </a>
                        <a href="{{ route('contact') }}" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-medium hover:from-primary-600 hover:to-primary-700 transition-all">
                            Talk to Sales
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-200 to-orange-200 dark:from-primary-900/30 dark:to-orange-900/30 rounded-3xl blur-2xl opacity-30"></div>
                    <div class="relative bg-slate-900 rounded-2xl p-6 font-mono text-sm text-green-400 overflow-x-auto">
                        <pre><code># Example: Create a scheduled post via API
curl -X POST https://api.autosocial.app/v1/posts \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "content": "Exciting product launch! 🚀",
    "platforms": ["instagram", "twitter"],
    "scheduled_for": "2024-06-15T14:00:00Z",
    "media": ["asset_uuid_1", "asset_uuid_2"]
  }'</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                Start Connecting Today
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                All integrations are included in Pro and Agency plans.
            </p>
            <a href="{{ route('pricing') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                View Pricing Plans
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </section>
@endsection