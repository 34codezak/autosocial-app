@extends('layouts.app')

@section('title', 'Accessibility - AutoSocial')
@section('description', 'AutoSocial is committed to making social media management accessible for everyone. Learn about our accessibility features and commitments.')

@section('content')
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Hero --}}
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-accent-800 dark:text-white mb-6">
                    Accessibility at AutoSocial
                </h1>
                <p class="text-lg text-accent-500 dark:text-accent-400">
                    We believe social media management should be accessible to everyone, regardless of ability.
                </p>
            </div>

            {{-- Commitment Statement --}}
            <div class="prose prose-lg dark:prose-invert max-w-none mb-16">
                <p class="text-accent-600 dark:text-accent-300">
                    AutoSocial is committed to <strong>WCAG 2.1 Level AA</strong> compliance and ongoing accessibility improvements. 
                    We regularly audit our platform with screen readers, keyboard navigation tests, and user feedback from people with disabilities.
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                
                @include('components.feature-card', [
                    'icon' => 'keyboard',
                    'title' => 'Keyboard Navigation',
                    'description' => 'Full keyboard support with visible focus indicators, skip links, and logical tab order. All interactive elements are reachable without a mouse.',
                ])
                
                @include('components.feature-card', [
                    'icon' => 'screen-reader',
                    'title' => 'Screen Reader Compatible',
                    'description' => 'Semantic HTML, ARIA labels, and proper heading structure ensure compatibility with VoiceOver, NVDA, JAWS, and other screen readers.',
                ])
                
                @include('components.feature-card', [
                    'icon' => 'contrast',
                    'title' => 'Color & Contrast',
                    'description' => 'All text meets WCAG AA contrast ratios (4.5:1). Dark mode and high-contrast mode available for low-vision users.',
                ])
                
                @include('components.feature-card', [
                    'icon' => 'text',
                    'title' => 'Text Accessibility',
                    'description' => 'Resizable text without breaking layout. Dyslexia-friendly font option. Proper line height and spacing for readability.',
                ])
                
                @include('components.feature-card', [
                    'icon' => 'motion',
                    'title' => 'Motion Reduction',
                    'description' => 'Respects <code>prefers-reduced-motion</code> system preference. All animations can be disabled. No auto-playing media without controls.',
                ])
                
                @include('components.feature-card', [
                    'icon' => 'media',
                    'title' => 'Media Accessibility',
                    'description' => 'Video captions, audio transcripts, and alt text for all images. AI-generated alt text suggestions for uploaded media.',
                ])
            </div>

            {{-- Accessibility Settings Component --}}
            <div class="bg-accent-50 dark:bg-slate-800/50 rounded-2xl p-8 mb-16">
                <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-6">
                    Customize Your Experience
                </h2>
                <p class="text-accent-500 dark:text-accent-400 mb-6">
                    Adjust AutoSocial to your needs with our accessibility settings panel.
                </p>
                @livewire('marketing.accessibility-settings')
            </div>

            {{-- Forms Accessibility --}}
            <div class="mb-16">
                <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-6">
                    Accessible Forms
                </h2>
                <ul class="space-y-3 text-accent-600 dark:text-accent-300">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>All form fields have associated <code>&lt;label&gt;</code> elements</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Error messages are announced to screen readers via <code>aria-live</code></span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Required fields are clearly marked and announced</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Form validation provides clear, actionable feedback</span>
                    </li>
                </ul>
            </div>

            {{-- Feedback & Improvements --}}
            <div class="bg-gradient-to-r from-primary-50 to-orange-50 dark:from-slate-800 dark:to-slate-700 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-accent-800 dark:text-white mb-4">
                    Help Us Improve
                </h2>
                <p class="text-accent-600 dark:text-accent-300 mb-6">
                    Accessibility is an ongoing journey. If you encounter barriers or have suggestions, we want to hear from you.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="mailto:accessibility@autosocial.app" 
                       class="px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">
                        Email Accessibility Team
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="px-6 py-3 bg-white dark:bg-slate-800 text-accent-800 dark:text-white border border-accent-200 dark:border-slate-600 rounded-lg font-medium hover:border-primary-400 transition-colors">
                        Submit Feedback Form
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('structured-data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Accessibility - AutoSocial",
  "accessibilityFeature": [
    "alternativeText",
    "ARIA",
    "audioDescription",
    "captions",
    "highContrastDisplay",
    "keyboardNavigation",
    "reducedMotion",
    "screenReaderSupport",
    "textToSpeech"
  ],
  "accessibilityHazard": ["noFlashingHazard", "noMotionSimulationHazard"]
}
</script>
@endpush