@if ($isAdmin)
<div class="mt-6 p-5 border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 rounded-lg">

    <div class="flex items-center justify-between mb-4">
        <div class="text-xs font-semibold tracking-wider uppercase text-gray-500 dark:text-gray-400">
            管理フィルター
        </div>
    </div>

    <div class="flex flex-col items-end gap-6 lg:flex-row lg:items-start lg:justify-between">

        <div class="flex flex-col gap-2">
            <div class="text-xs text-gray-500 dark:text-gray-400">
                対象ユーザー
            </div>
            <x-user-category-form
                :route="$route"
                :query="$query"
                :users="$users"
            />
        </div>

        <div class="flex flex-col gap-2">
            <div class="text-xs text-gray-500 dark:text-gray-400">
                削除状態
            </div>
            <x-trash-type-form
                :route="$route"
                :query="$query"
            />
        </div>
    </div>
    
</div>
@endif