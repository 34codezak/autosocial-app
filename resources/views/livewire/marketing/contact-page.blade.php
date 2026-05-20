<div class="max-w-2xl mx-auto" 
     x-data="{ showSuccess: @entangle('success') }"
     @scroll-to-top.window="window.scrollTo({ top: 0, behavior: 'smooth' })">

    {{-- Success Message --}}
    <div x-show="showSuccess" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-start gap-3">
        <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <h4 class="font-semibold text-green-800 dark:text-green-200">Message Sent!</h4>
            <p class="text-green-700 dark:text-green-300 text-sm">Thanks for reaching out. We'll respond within 24 hours.</p>
        </div>
        <button @click="showSuccess = false; $wire.success = false" 
                class="ml-auto text-green-600 hover:text-green-800"
                aria-label="Dismiss">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Contact Form --}}
    <form wire:submit.prevent="submit" class="space-y-6" novalidate>
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-medium text-accent-700 dark:text-accent-300 mb-2">
                Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="name" 
                   wire:model.defer="name"
                   wire:blur="$validate('name')"
                   class="w-full px-4 py-3 rounded-lg border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                   placeholder="Your name"
                   required
                   aria-describedby="name-error">
            @error('name')
                <p id="name-error" class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-accent-700 dark:text-accent-300 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input type="email" 
                   id="email" 
                   wire:model.defer="email"
                   wire:blur="$validate('email')"
                   class="w-full px-4 py-3 rounded-lg border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                   placeholder="you@company.com"
                   required
                   aria-describedby="email-error">
            @error('email')
                <p id="email-error" class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="company" class="block text-sm font-medium text-accent-700 dark:text-accent-300 mb-2">
                Company (Optional)
            </label>
            <input type="text" 
                   id="company" 
                   wire:model.defer="company"
                   class="w-full px-4 py-3 rounded-lg border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                   placeholder="Your company name">
        </div>

        <div>
            <label for="subject" class="block text-sm font-medium text-accent-700 dark:text-accent-300 mb-2">
                Subject <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="subject" 
                   wire:model.defer="subject"
                   wire:blur="$validate('subject')"
                   class="w-full px-4 py-3 rounded-lg border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('subject') border-red-500 @enderror"
                   placeholder="How can we help?"
                   required
                   aria-describedby="subject-error">
            @error('subject')
                <p id="subject-error" class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-accent-700 dark:text-accent-300 mb-2">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message" 
                      wire:model.defer="message"
                      wire:blur="$validate('message')"
                      rows="6"
                      class="w-full px-4 py-3 rounded-lg border border-accent-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-accent-800 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-y @error('message') border-red-500 @enderror"
                      placeholder="Tell us about your project or question..."
                      required
                      aria-describedby="message-error"></textarea>
            @error('message')
                <p id="message-error" class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-accent-500">{{ strlen($message) }}/2000 characters</p>
        </div>

        {{-- Honeypot Spam Protection --}}
        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden">

        <button type="submit" 
                wire:loading.attr="disabled"
                class="w-full py-4 px-6 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25 disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center gap-2">
            <span wire:loading.remove>Send Message</span>
            <span wire:loading>
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
            <span wire:loading>Sending...</span>
        </button>
    </form>

    {{-- Additional Contact Options --}}
    <div class="mt-12 pt-8 border-t border-accent-200 dark:border-slate-700">
        <h3 class="text-lg font-semibold text-accent-800 dark:text-white mb-4">Other Ways to Reach Us</h3>
        <div class="grid sm:grid-cols-2 gap-4">
            <a href="mailto:support@autosocial.app" 
               class="flex items-center gap-3 p-4 rounded-xl bg-accent-50 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-slate-700 transition-colors group">
                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <div>
                    <p class="font-medium text-accent-800 dark:text-white group-hover:text-primary-600">Email Support</p>
                    <p class="text-sm text-accent-500">support@autosocial.app</p>
                </div>
            </a>
            <a href="https://wa.me/1234567890" target="_blank" rel="noopener"
               class="flex items-center gap-3 p-4 rounded-xl bg-accent-50 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-slate-700 transition-colors group">
                <svg class="w-6 h-6 text-primary-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <div>
                    <p class="font-medium text-accent-800 dark:text-white group-hover:text-primary-600">WhatsApp</p>
                    <p class="text-sm text-accent-500">Chat with support</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Business Hours --}}
    <div class="mt-8 text-center text-sm text-accent-500">
        <p>🕐 Support Hours: Mon-Fri, 8AM-6PM {{ config('app.timezone') }}</p>
        <p class="mt-1">Average response time: &lt; 4 hours</p>
    </div>
</div>