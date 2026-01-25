<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            書籍一覧
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>
            <div class="flex justify-between mt-4">
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

                <div>
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
                    />
                </div>
            </div>

            <table class="mt-2 w-full table-auto border-collapse border border-neutral-200">
                <thead>
                    <tr>
                        <th class="w-32 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">ID</th>
                        <th class="border border-neutral-600 bg-neutral-600 p-2 text-white text-left">タイトル</th>
                        <th class="border border-neutral-600 bg-neutral-600 p-2 text-white text-left">カテゴリー</th>
                        <th class="w-16 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">編集</th>
                        <th class="w-16 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($books->bookViews))
                        @foreach($books->bookViews as $book)
                            <tr class="border border-neutral-200">
                                <td class="p-2">{{ $book->id }}</td>
                                <td class="p-2">
                                    <a
                                        class="focus:underline{{ $book->trashed ? ' line-through text-red-600' : '' }}"
                                        href="{{ route('books.show', ['id' => $book->id]) }}"
                                    >
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td class="p-2">{{ $book->categoryTitle }}</td>
                                <td class="p-2">
                                    @if ($book->canUpdate)
                                    <div>
                                        <a class="hover:text-neutral-500 transition-colors" href="{{ route('books.edit', ['id' => $book->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if ($book->canDelete)
                                    <form action="{{ route('books.delete', ['id' => $book->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="hover:text-neutral-500 transition-colors" type="submit" x-data x-on:click="$dispatch('open-modal', 'confirm-delete')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <x-pagination :paginate-view="$books->paginateView" />
        </x-main-content-panel>
    </x-main-content-area>

    <x-modal name="confirm-delete">
        <div class="p-6">削除？</div>
    </x-modal>
</x-app-layout>