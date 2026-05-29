<div class="min-h-screen bg-slate-50 dark:bg-slate-900">
    
    {{-- Header --}}
    <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center">
                    <span class="text-xl font-bold text-orange-600">AutoSocial</span>
                </div>

                <div class="hidden sm:flex sm:space-x-8">
                    <a href="#" class="border-orange-500 text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Workspace
                    </a>

                    <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-300 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Dashboard
                    </a>
                </div>

            </div>
        </div>
    </header>

    {{-- Main Content (SINGLE ROOT CHILD WRAPPER) --}}
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            
            <div class="border-4 border-dashed border-gray-200 dark:border-slate-700 rounded-lg h-96 flex items-center justify-center">
                <p class="text-gray-400">
                    Workspace Content (Editor/Calendar Goes Here)
                </p>
            </div>

        </div>
    </main>

</div>