<div class="space-y-4">
    <div class="grid grid-cols-3 gap-2">
        @foreach($presets as $key => $label)
            <button wire:click="selectPreset('{{ $key }}')"
                    class="px-3 py-2 text-sm rounded-lg border transition-all {{ $selectedPreset === $key ? 'border-orange-500 bg-orange-50 dark:bg-orange-900/20 text-orange-600' : 'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div class="flex gap-3 items-end">
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
            <input type="date" wire:model.live="date"
                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500">
        </div>
        <div class="w-32">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Time</label>
            <input type="time" wire:model.live="time"
                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-orange-500 focus:ring-orange-500">
        </div>
    </div>

    <div class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-gray-700">
        <span class="text-sm text-gray-500">Timezone:</span>
        <select wire:model.live="timezone"
                class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
            <option value="UTC">UTC</option>
            <option value="America/New_York">ET</option>
            <option value="America/Chicago">CT</option>
            <option value="America/Los_Angeles">PT</option>
        </select>
    </div>
</div>