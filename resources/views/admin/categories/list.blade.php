<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('admin.index') }}">管理者メニュー</a>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
            </span>
            <span>カテゴリー一覧</span>
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>

            <div class="flex flex-col justify-between items-start gap-4 md:flex-row-reverse md:items-end md:mt-4 mt-5">
                <div class="flex flex-col items-end gap-4 self-end">
                    <div class="flex flex-col gap-2">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            削除状態
                        </div>
                        <x-trash-type-form
                            route="admin.categories.list"
                            :query="$categories->categoryUIQuery"
                        />
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            並べ替え
                        </div>
                        <x-sort-form
                            action="{{ route('admin.categories.list') }}"
                            :sorts="[
                                'created_at' => '作成日',
                                'title'      => 'タイトル'
                            ]"
                            :sortSelected="old('sort', $categories->categoryUIQuery->sort)"
                            :directionSelected="old('direction', $categories->categoryUIQuery->direction)"
                            :errors="$errors"
                        />
                    </div>
                </div>

                <div>
                    @if ($categories->canCreate)
                    <x-primary-link-button
                        class="h-10 rounded-md"
                        href="{{ route('admin.categories.create') }}"
                    >
                        ＋ 新規登録
                    </x-primary-link-button>
                    @endif
                </div>
            </div>

            <div
                x-data="{ deleteAction: '', title: '' }"
                x-on:open-category-delete-modal.window="
                    deleteAction = $event.detail.action
                    title = $event.detail.title
                "
            >
                <table class="mt-2 w-full table-auto border-collapse border border-neutral-200">
                    <thead>
                        <tr>
                            <th class="w-32 bg-neutral-600 p-2 text-white text-left">ID</th>
                            <th class="bg-neutral-600 p-2 text-white text-left">タイトル</th>
                            <th class="w-16 bg-neutral-600 p-2 text-white text-left">編集</th>
                            <th class="w-16 bg-neutral-600 p-2 text-white text-left">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories->categoryViews))
                            @foreach($categories->categoryViews as $category)
                                <tr class="border border-neutral-200">
                                    <td class="p-2 text-gray-800 dark:text-gray-200">{{ $category->id }}</td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        <span class="{{ $category->trashed ? 'line-through text-red-600' : '' }}">{{ $category->title }}</span>
                                    </td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        @if ($category->canUpdate)
                                        <div class="flex justify-start">
                                            <x-edit-icon-link href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" />
                                        </div>
                                        @endif
                                    </td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        @if ($category->canDelete)
                                        <div class="flex justify-start">
                                            <x-delete-icon-button
                                                :title="$category->title"
                                                :action="route('admin.categories.delete', ['id' => $category->id])"
                                                event="open-category-delete-modal"
                                            />
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <x-modal name="confirm-delete" focusable>
                    <form
                        method="post"
                        class="p-6"
                        x-bind:action="deleteAction"
                    >
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="`${title} を本当に削除しますか？`"></h2>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-delete')">
                                キャンセル
                            </x-secondary-button>

                            <x-danger-button class="ms-3" x-bind:disabled="!deleteAction">
                                削除する
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <x-simple-pagination :paginate-view="$categories->simplePaginateView" />
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>