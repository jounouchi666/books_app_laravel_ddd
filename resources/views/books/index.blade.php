<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            書籍一覧
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>

            <x-flush-messages class="md:mb-4 mb-5" />

            <div class="flex flex-col justify-between items-start gap-4 md:flex-row-reverse md:items-end">
                <div class="flex flex-col items-end gap-4 self-end">
                    <div class="flex flex-col gap-2 w-full md:w-aut">
                        <x-admin-filter-forms
                            route="books.index"
                            :query="$books->bookUIQuery"
                            :users="$books->users"
                        />
                    </div>

                    <div class="flex flex-col items-end gap-6 lg:flex-row lg:items-start">
                        <div class="flex flex-col gap-2">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                読書状況
                            </div>
                            <x-reading_status-form
                                route="books.index"
                                :query="$books->bookUIQuery"
                            />
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                並べ替え
                            </div>
                            <x-sort-form
                                route="books.index"
                                :query="$books->bookUIQuery"
                                :sorts="[
                                    'created_at'  => '登録日',
                                    'title'       => 'タイトル',
                                    'user_id'     => '登録者',
                                    'category_id' => 'カテゴリー'
                                ]"
                            />
                        </div>
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

            @php
                $modalState = [
                    'deleteAction' => '',
                    'title' => '',
                ];

                if ($isAdmin) {
                    $modalState['restoreAction'] = '';
                }
            @endphp
            <div
                x-data='@json($modalState)'
                x-on:open-book-delete-modal.window="
                    deleteAction = $event.detail.action
                    title = $event.detail.title
                "
                @if ($isAdmin)
                x-on:open-book-restore-modal.window="
                    restoreAction = $event.detail.action
                    title = $event.detail.title
                "
                @endif
            >
                <div class="mt-2 md:hidden space-y-4">
                    @foreach($books->bookViews as $book)
                    <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm p-4 space-y-3">

                        <div class="flex justify-between items-center text-xs text-neutral-500">
                            <span>#{{ $book->id }}</span>
                            <span class="px-2 py-0.5 rounded bg-neutral-100 dark:bg-neutral-700">
                                {{ $book->categoryTitle }}
                            </span>
                        </div>

                        <x-anker
                            :href="route('books.show', ['id' => $book->id])"
                            :disabled="$book->trashed"   
                        >
                            <span>{{ $book->title }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </x-anker>

                        <div class="text-sm">
                            @if($book->canUpdate)
                                <x-change-reading-status-form
                                    route="books.reading_status"
                                    :bookId="$book->id"
                                    :selected="$book->readingStatus"
                                />
                            @else
                                <span class="text-neutral-600 dark:text-neutral-400">
                                    {{ $book->readingStatus }}
                                </span>
                            @endif
                        </div>

                        @if($isAdmin)
                        <div class="text-xs text-neutral-500 space-y-1">
                            <div>登録者: {{ $book->userName }}</div>
                            <div class="{{ $book->trashed ? 'text-red-600' : '' }}">
                                {{ $book->trashedLabel() }}
                            </div>
                        </div>
                        @endif

                        <div class="pt-3 border-t border-neutral-200 dark:border-neutral-700 flex justify-end gap-4">

                            @if ($book->canUpdate)
                                <x-edit-icon-link href="{{ route('books.edit', ['id' => $book->id]) }}" />
                            @endif

                            @if ($book->actionType->isDelete())
                                <x-delete-icon-button
                                    :title="$book->title"
                                    :action="route('books.delete', [
                                        'id' => $book->id,
                                        ...$books->bookUIQuery->toQueryArray()
                                    ])"
                                    event="open-book-delete-modal"
                                />
                            @elseif ($book->actionType->isRestore())
                                <x-restore-icon-button
                                    :title="$book->title"
                                    :action="route('books.restore', [
                                        'id' => $book->id,
                                        ...$books->bookUIQuery->toQueryArray()
                                    ])"
                                    event="open-book-restore-modal"
                                />
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="hidden md:block overflow-x-auto">
                    <table class="mt-2 w-full table-auto border-collapse border border-neutral-200">
                        <thead>
                            <tr class="dark:border dark:border-neutral-200">
                                <th class="bg-neutral-600 p-2 text-white text-left">ID</th>
                                <th class="bg-neutral-600 p-2 text-white text-left">タイトル</th>
                                <th class="bg-neutral-600 p-2 text-white text-left">カテゴリー</th>
                                <th class="bg-neutral-600 p-2 text-white text-left">読書状況</th>
                                @if ($isAdmin)
                                <th class="bg-neutral-600 p-2 text-white text-left">登録者</th>
                                <th class="w-[6em] bg-neutral-600 p-2 text-white text-left">削除状態</th>
                                @endif
                                <th class="w-[4em] bg-neutral-600 p-2 text-white text-left">編集</th>
                                <th class="w-[4em] bg-neutral-600 p-2 text-white text-left">削除</th>
                            </tr>
                        </thead>
                        <tbody class="border border-neutral-200">
                            @if (!empty($books->bookViews))
                                @foreach($books->bookViews as $book)
                                    <tr>
                                        <td class="p-2 text-gray-800 dark:text-gray-200">{{ $book->id }}</td>
                                        <td class="p-2 text-gray-800 dark:text-gray-200">
                                            <x-anker
                                                :href="route('books.show', ['id' => $book->id])"
                                                :disabled="$book->trashed"   
                                            >
                                                <span>{{ $book->title }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                                    <path d="m9 18 6-6-6-6"/>
                                                </svg>
                                            </x-anker>
                                        </td>
                                        <td class="p-2 text-gray-800 dark:text-gray-200">{{ $book->categoryTitle }}</td>
                                        <td class="p-2 text-gray-800 dark:text-gray-200">
                                            @if($book->canUpdate)
                                            <x-change-reading-status-form
                                                route="books.reading_status"
                                                :bookId="$book->id"
                                                :selected="$book->readingStatus"
                                            />
                                            @endif
                                        </td>
                                        @if($isAdmin)
                                        <td class="p-2 text-gray-800 dark:text-gray-200">{{ $book->userName }}</td>
                                        <td class="p-2 text-gray-800 dark:text-gray-200 {{ $book->trashed ? 'text-red-600' : '' }}">
                                            {{ $book->trashedLabel() }}
                                        </td>
                                        @endif
                                        <td class="p-2 text-gray-800 dark:text-gray-200">
                                            @if ($book->canUpdate)
                                            <div class="flex justify-start">
                                                <x-edit-icon-link href="{{ route('books.edit', ['id' => $book->id]) }}" />
                                            </div>
                                            @endif
                                        </td>
                                        <td class="p-2 text-gray-800 dark:text-gray-200">
                                            @if ($book->actionType->isDelete())
                                            <div class="flex justify-start">
                                                <x-delete-icon-button
                                                    :title="$book->title"
                                                    :action="route('books.delete', [
                                                        'id' => $book->id,
                                                        ...$books->bookUIQuery->toQueryArray()
                                                    ])"
                                                    event="open-book-delete-modal"
                                                />
                                            </div>
                                            @elseif ($book->actionType->isRestore())
                                            <div class="flex justify-start">
                                                <x-restore-icon-button
                                                    :title="$book->title"
                                                    :action="route('books.restore', [
                                                        'id' => $book->id,
                                                        ...$books->bookUIQuery->toQueryArray()
                                                    ])"
                                                    event="open-book-restore-modal"
                                                />
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

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

                @if ($isAdmin)
                <x-modal name="confirm-restore" focusable>
                    <form
                        method="post"
                        class="p-6"
                        x-bind:action="restoreAction"
                    >
                        @csrf
                        @method('patch')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="`${title} を復元しますか？`"></h2>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-restore')">
                                キャンセル
                            </x-secondary-button>

                            <x-agree-button class="ms-3" x-bind:disabled="!restoreAction">
                                復元する
                            </x-agree-button>
                        </div>
                    </form>
                </x-modal>
                @endif
            </div>

            <x-pagination :paginate-view="$books->paginateView" />
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>