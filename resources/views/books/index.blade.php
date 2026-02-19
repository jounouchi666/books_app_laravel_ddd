<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            書籍一覧
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>

            <div class="flex flex-col justify-between items-start gap-4 md:flex-row-reverse md:items-end md:mt-4 mt-5">
                <div class="flex flex-col items-end gap-4 self-end">
                    <div class="flex flex-col gap-2 w-full md:w-aut">
                        <x-admin-filter-forms
                            route="books.index"
                            :query="$books->bookUIQuery"
                            :users="$books->users"
                        />
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            並べ替え
                        </div>
                        <x-sort-form
                            action="{{ route('books.index') }}"
                            :sorts="[
                                'created_at'  => '登録日',
                                'title'       => 'タイトル',
                                'user_id'     => '登録者',
                                'category_id' => 'カテゴリー'
                            ]"
                            :sortSelected="old('sort', $books->bookUIQuery->sort)"
                            :directionSelected="old('direction', $books->bookUIQuery->direction)"
                            :errors="$errors"
                            :params="$books->bookUIQuery->toQueryArray()"
                        />
                    </div>
                </div>

                <div>
                    @if ($books->canCreate)
                    <x-primary-link-button
                        class="rounded-md"
                        href="{{ route('books.create') }}"
                    >
                        ＋ 新規登録
                    </x-primary-link-button>
                    @endif
                </div>
            </div>

            <div
                x-data="{ deleteAction: '', title: '' }"
                x-on:open-book-delete-modal.window="
                    deleteAction = $event.detail.action
                    title = $event.detail.title
                "
            >
                <table class="mt-2 w-full table-auto border-collapse border border-neutral-200">
                    <thead>
                        <tr class="dark:border dark:border-neutral-200">
                            <th class="w-32 bg-neutral-600 p-2 text-white text-left">ID</th>
                            <th class="bg-neutral-600 p-2 text-white text-left">タイトル</th>
                            <th class="bg-neutral-600 p-2 text-white text-left">カテゴリー</th>
                            <th class="w-16 bg-neutral-600 p-2 text-white text-left">編集</th>
                            <th class="w-16 bg-neutral-600 p-2 text-white text-left">削除</th>
                        </tr>
                    </thead>
                    <tbody class="border border-neutral-200">
                        @if (!empty($books->bookViews))
                            @foreach($books->bookViews as $book)
                                <tr>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">{{ $book->id }}</td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        <a
                                            class="focus:underline{{ $book->trashed ? ' line-through text-red-600' : '' }}"
                                            href="{{ route('books.show', ['id' => $book->id]) }}"
                                        >
                                            {{ $book->title }}
                                        </a>
                                    </td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">{{ $book->categoryTitle }}</td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        @if ($book->canUpdate)
                                        <div class="flex justify-start">
                                            <x-edit-icon-link href="{{ route('books.edit', ['id' => $book->id]) }}" />
                                        </div>
                                        @endif
                                    </td>
                                    <td class="p-2 text-gray-800 dark:text-gray-200">
                                        @if ($book->canDelete)
                                        <div class="flex justify-start">
                                            <x-delete-icon-button
                                                :title="$book->title"
                                                :action="route('books.delete', ['id' => $book->id])"
                                                event="open-book-delete-modal"
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

            <x-pagination :paginate-view="$books->paginateView" />
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>