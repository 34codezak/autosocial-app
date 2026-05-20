@props([
    'plan',
    'price',
    'annualPrice' => null,
    'features' => [],
    'highlight' => false,
    'ctaText' => 'Get Started',
    'ctaUrl' => route('register'),
])

<div class="relative p-8 rounded-2xl {{ $highlight ? 'bg-gradient-to-b from-primary-50 to-white dark:from-slate-800 dark:to-slate-900 border-2 border-primary-400 shadow-xl shadow-primary-500/10' : 'bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700' }} flex flex-col">
    
    @if($highlight)
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-primary-500 to-primary-600 text-white text-sm font-medium rounded-full shadow-lg">
            Most Popular
        </div>
    @endif

    <div class="mb-6">
        <h3 class="text-2xl font-bold text-accent-800 dark:text-white">{{ $plan }}</h3>
        <p class="text-accent-500 dark:text-accent-400 text-sm mt-1">Best for {{ $attributes->get('bestFor', 'growing brands') }}</p>
    </div>

    <div class="mb-6">
        <div class="flex items-baseline">
            <span class="text-4xl font-bold text-accent-800 dark:text-white" x-text="annualBilling ? '{{ $annualPrice ?? $price }}' : '{{ $price }}'">${{ $price }}</span>
            <span class="text-accent-500 dark:text-accent-400 ml-2" x-show="annualBilling">/month</span>
            <span class="text-accent-500 dark:text-accent-400 ml-2" x-show="!annualBilling">/month</span>
        </div>
        @if($annualPrice)
            <p class="text-sm text-primary-600 dark:text-primary-400 mt-1" x-show="annualBilling">Billed annually (save 20%)</p>
        @endif
    </div>

    {{-- Billing Toggle --}}
    <div class="flex items-center justify-center gap-3 mb-6 pb-6 border-b border-accent-200 dark:border-slate-700">
        <span class="text-sm text-accent-500" x-text="annualBilling ? 'Annual' : 'Monthly'"></span>
        <button @click="annualBilling = !annualBilling"
                class="relative w-14 h-7 bg-accent-200 dark:bg-slate-600 rounded-full transition-colors"
                role="switch"
                :aria-checked="annualBilling"
                aria-label="Toggle annual billing">
            <span class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full shadow transition-transform"
                  :class="annualBilling ? 'translate-x-7' : 'translate-x-0'"></span>
        </button>
    </div>

    {{-- Features List --}}
    <ul class="space-y-3 mb-8 flex-grow">
        @foreach($features as $feature)
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-accent-600 dark:text-accent-300">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>

    <a href="{{ $ctaUrl }}" 
       class="w-full py-3 px-4 text-center rounded-xl font-semibold transition-all {{ $highlight ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white hover:from-primary-600 hover:to-primary-700 shadow-lg shadow-primary-500/25' : 'bg-accent-100 dark:bg-slate-700 text-accent-800 dark:text-white hover:bg-accent-200 dark:hover:bg-slate-600' }}">
        {{ $ctaText }}
    </a>
</div>