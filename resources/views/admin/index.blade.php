<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者メニュー
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a
                    href=""
                    class="group bg-white dark:bg-neutral-600 rounded hover:shadow-sm transition p-6 border border-gray-200 pointer-events-none opacity-75"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-700 dark:text-white group-hover:text-teal-600">
                            管理者一覧
                        </h2>
                        <span class="text-gray-700 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">
                        管理者権限の付与
                    </p>
                </a>
                <a
                    href="{{ route('admin.categories.list') }}"
                    class="group bg-white dark:bg-neutral-600 rounded hover:shadow-sm transition p-6 border border-gray-200"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-700 dark:text-white group-hover:text-teal-600">
                            カテゴリー一覧
                        </h2>
                        <span class="text-gray-700 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tags-icon lucide-tags">
                                <path d="M13.172 2a2 2 0 0 1 1.414.586l6.71 6.71a2.4 2.4 0 0 1 0 3.408l-4.592 4.592a2.4 2.4 0 0 1-3.408 0l-6.71-6.71A2 2 0 0 1 6 9.172V3a1 1 0 0 1 1-1z"/>
                                <path d="M2 7v6.172a2 2 0 0 0 .586 1.414l6.71 6.71a2.4 2.4 0 0 0 3.191.193"/>
                                <circle cx="10.5" cy="6.5" r=".5" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">
                        カテゴリーの編集
                    </p>
                </a>
            </div>
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>