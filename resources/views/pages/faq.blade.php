@extends('components.layouts.app')

@section('title', 'FAQ - AutoSocial | Frequently Asked Questions')
@section('description', 'Find answers to common questions about AutoSocial: pricing, features, security, billing, and getting started.')

@section('content')
    {{-- Hero --}}
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-accent-800 dark:text-white mb-6">
                Frequently Asked Questions
            </h1>
            <p class="text-lg text-accent-500 dark:text-accent-400">
                Can't find what you're looking for? <a href="{{ route('contact') }}" class="text-primary-600 hover:underline">Contact support</a>.
            </p>
        </div>
    </section>

    {{-- FAQ Accordion --}}
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            @livewire('marketing.faq-accordion')
        </div>
    </section>

    {{-- Still Need Help? --}}
    <section class="py-20 bg-accent-50 dark:bg-slate-800/50">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-accent-800 dark:text-white mb-6">
                Still Have Questions?
            </h2>
            <p class="text-lg text-accent-500 dark:text-accent-400 mb-8">
                Our support team is here to help. Average response time: under 4 hours.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                @livewire('marketing.contact-page')
            </div>
            <div class="mt-8 flex flex-wrap justify-center gap-6 text-sm text-accent-500">
                <a href="mailto:support@autosocial.app" class="hover:text-primary-600 transition-colors">📧 support@autosocial.app</a>
                <span>•</span>
                <a href="https://wa.me/1234567890" class="hover:text-primary-600 transition-colors">💬 WhatsApp Support</a>
                <span>•</span>
                <span>🕐 Mon-Fri, 8AM-6PM {{ config('app.timezone') }}</span>
            </div>
        </div>
    </section>
@endsection

@push('structured-data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Is there a free trial?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes! All plans include a 14-day free trial with full access to features. No credit card required." }
    },
    {
      "@type": "Question",
      "name": "Can I cancel anytime?",
      "acceptedAnswer": { "@type": "Answer", "text": "Absolutely. Cancel your subscription anytime from your account settings. No questions asked, no penalties." }
    },
    {
      "@type": "Question",
      "name": "Which social platforms are supported?",
      "acceptedAnswer": { "@type": "Answer", "text": "AutoSocial supports Facebook, Instagram, X (Twitter), LinkedIn, TikTok, Pinterest, and YouTube. More platforms are added regularly based on user requests." }
    },
    {
      "@type": "Question",
      "name": "Is my data secure?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes. We use end-to-end encryption for social tokens, SOC 2 compliant infrastructure, and never sell your data. You own your content and analytics." }
    }
  ]
}
</script>
@endpush