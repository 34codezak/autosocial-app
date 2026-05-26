@extends('components.layouts.app')

@section('title', 'Pricing - AutoSocial')
@section('description', 'Simple, transparent pricing for every stage of growth. Start free, scale as you grow.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Simple Pricing, Powerful Results
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Start with a 14-day free trial. No credit card required. Cancel anytime.
            </p>
            
            {{-- Billing Toggle --}}
            <div class="inline-flex items-center gap-3 p-1 bg-accent-100 dark:bg-slate-800 rounded-full" 
                 x-data="{ annual: false }">
                <button @click="annual = false" 
                        :class="!annual ? 'bg-white dark:bg-slate-700 shadow' : ''"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all">
                    Monthly
                </button>
                <button @click="annual = true" 
                        :class="annual ? 'bg-white dark:bg-slate-700 shadow' : ''"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all">
                    Annual <span class="text-primary-600 text-xs">-20%</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Pricing Cards --}}
    <section class="pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                
                {{-- Starter Plan --}}
                @component('components.pricing-card', [
                    'plan' => 'Starter',
                    'price' => '19',
                    'annualPrice' => '15',
                    'bestFor' => 'individuals & freelancers',
                ])
                    <x-slot:features>
                        <li>3 social accounts</li>
                        <li>50 scheduled posts/month</li>
                        <li>AI caption suggestions</li>
                        <li>Basic analytics</li>
                        <li>1 team member</li>
                        <li>Email support</li>
                    </x-slot:features>
                @endcomponent

                {{-- Pro Plan (Highlighted) --}}
                @component('components.pricing-card', [
                    'plan' => 'Pro',
                    'price' => '49',
                    'annualPrice' => '39',
                    'bestFor' => 'growing brands',
                    'highlight' => true,
                ])
                    <x-slot:features>
                        <li>10 social accounts</li>
                        <li>Unlimited scheduled posts</li>
                        <li>Advanced AI content tools</li>
                        <li>Advanced analytics + reports</li>
                        <li>5 team members</li>
                        <li>Approval workflows</li>
                        <li>Priority support</li>
                        <li>API access</li>
                    </x-slot:features>
                @endcomponent

                {{-- Agency Plan --}}
                @component('components.pricing-card', [
                    'plan' => 'Agency',
                    'price' => '129',
                    'annualPrice' => '99',
                    'bestFor' => 'teams & agencies',
                ])
                    <x-slot:features>
                        <li>Unlimited social accounts</li>
                        <li>Unlimited everything</li>
                        <li>White-label reports</li>
                        <li>Client workspaces</li>
                        <li>Unlimited team members</li>
                        <li>Dedicated account manager</li>
                        <li>Custom integrations</li>
                        <li>SLA guarantee</li>
                    </x-slot:features>
                @endcomponent

            </div>
        </div>
    </section>

    {{-- Feature Comparison --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-accent-800 dark:text-white mb-12">
                Compare All Features
            </h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-accent-200 dark:border-slate-700">
                            <th class="pb-4 pr-4 font-semibold text-accent-800 dark:text-white">Feature</th>
                            <th class="pb-4 px-4 font-semibold text-center">Starter</th>
                            <th class="pb-4 px-4 font-semibold text-center bg-primary-50 dark:bg-primary-900/20">Pro</th>
                            <th class="pb-4 pl-4 font-semibold text-center">Agency</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-accent-200 dark:divide-slate-700">
                        @php
                            $features = [
                                ['Social Accounts', '3', '10', 'Unlimited'],
                                ['Scheduled Posts', '50/mo', 'Unlimited', 'Unlimited'],
                                ['AI Captions', '✓', '✓', '✓'],
                                ['Analytics', 'Basic', 'Advanced', 'Enterprise'],
                                ['Team Members', '1', '5', 'Unlimited'],
                                ['Approval Workflows', '✗', '✓', '✓'],
                                ['API Access', '✗', '✓', '✓'],
                                ['White-label Reports', '✗', '✗', '✓'],
                                ['Support', 'Email', 'Priority', 'Dedicated'],
                            ];
                        @endphp
                        @foreach($features as [$feature, $starter, $pro, $agency])
                            <tr>
                                <td class="py-4 pr-4 text-accent-600 dark:text-accent-300">{{ $feature }}</td>
                                <td class="py-4 px-4 text-center {{ $starter === '✓' ? 'text-primary-600' : '' }}">{{ $starter }}</td>
                                <td class="py-4 px-4 text-center bg-primary-50/50 dark:bg-primary-900/10 {{ $pro === '✓' ? 'text-primary-600 font-medium' : '' }}">{{ $pro }}</td>
                                <td class="py-4 pl-4 text-center {{ $agency === '✓' ? 'text-primary-600' : '' }}">{{ $agency }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- FAQ Accordion --}}
    <section class="py-20">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-accent-800 dark:text-white mb-12">
                Frequently Asked Questions
            </h2>
            @livewire('marketing.f-a-q-accordion')
        </div>
    </section>

    {{-- Enterprise CTA --}}
    <section class="py-16 text-center">
        <div class="max-w-2xl mx-auto px-4">
            <h3 class="text-2xl font-bold text-accent-800 dark:text-white mb-4">
                Need Custom Solutions?
            </h3>
            <p class="text-accent-500 dark:text-accent-400 mb-8">
                Enterprise plans with custom features, dedicated infrastructure, and SLA guarantees.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium">
                Contact Sales →
            </a>
        </div>
    </section>
@endsection

@push('structured-data')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Can I cancel anytime?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes, you can cancel your subscription at any time from your account settings. No questions asked." }
    },
    {
      "@type": "Question",
      "name": "Is there a free trial?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes! All plans include a 14-day free trial with full access to features. No credit card required." }
    }
  ]
}
</script>
@endverbatim
@endpush