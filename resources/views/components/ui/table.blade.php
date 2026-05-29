@props(['striped' => false, 'hoverable' => true, 'responsive' => true])

<div {{ $attributes->merge(['class' => $responsive ? 'overflow-x-auto' : '']) }}>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        @if(isset($header))
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    {{ $header }}
                </tr>
            </thead>
        @endif

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
            {{ $slot }}
        </tbody>

        @if(isset($footer))
            <tfoot class="bg-gray-50 dark:bg-gray-800/50">
                <tr>{{ $footer }}</tr>
            </tfoot>
        @endif
    </table>
</div>