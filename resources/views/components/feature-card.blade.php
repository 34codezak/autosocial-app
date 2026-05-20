@props([
    'icon' => 'star',
    'title',
    'description',
])

<div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-accent-200 dark:border-slate-700 hover:border-primary-300 dark:hover:border-primary-600 transition-colors group">
    <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-200 dark:group-hover:bg-primary-900/50 transition-colors">
        @include("components.icons.{$icon}")
    </div>
    <h3 class="text-xl font-semibold text-accent-800 dark:text-white mb-2">{{ $title }}</h3>
    <p class="text-accent-500 dark:text-accent-400">{{ $description }}</p>
</div>