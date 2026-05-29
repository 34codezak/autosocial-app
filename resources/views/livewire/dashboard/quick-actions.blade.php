<div x-data="{ open: false }" @click.outside="open = false" class="fixed bottom-6 right-6 z-40">
    <div class="flex flex-col items-end space-y-3 transition-all duration-300"
         :class="{ 'opacity-100 translate-y-0': open, 'opacity-0 translate-y-4 pointer-events-none': !open }">
        <a href="#" class="flex items-center gap-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-full shadow-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span>📅</span> Schedule Post
        </a>
        <a href="#" class="flex items-center gap-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-full shadow-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span>📊</span> View Reports
        </a>
        <a href="#" class="flex items-center gap-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-full shadow-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span>👥</span> Manage Accounts
        </a>
    </div>
    <button @click="open = !open"
            class="flex items-center justify-center w-14 h-14 bg-orange-500 hover:bg-orange-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-orange-300 dark:focus:ring-orange-800">
        <svg :class="{ 'rotate-45': open }" class="w-6 h-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
    </button>
</div>