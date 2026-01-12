<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight d-flex">
            <a href="{{ route('admin.index') }}">管理者メニュー</a>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
            </span>
            <span>カテゴリー一覧</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mt-4 flex justify-end">
                    @if ($categories->canCreate)
                    <a
                        class="px-4 py-2 h-10 rounded-md bg-neutral-600 text-white hover:bg-neutral-500 hover:cursor-pointer transition-colors"
                        href="{{ route('admin.categories.create') }}"
                    >
                        ＋ 新規登録
                    </a>
                    @endif
                </div>

                <table class="mt-2 w-full table-auto border-collapse border border-neutral-200">
                    <thead>
                        <tr>
                            <th class="w-32 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">ID</th>
                            <th class="border border-neutral-600 bg-neutral-600 p-2 text-white text-left">タイトル</th>
                            <th class="w-16 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">編集</th>
                            <th class="w-16 border border-neutral-600 bg-neutral-600 p-2 text-white text-left">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories->categoryViews))
                            @foreach($categories->categoryViews as $category)
                                <tr class="border border-neutral-200">
                                    <td class="p-2">{{ $category->id }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('books.show', ['id' => $book->id]) }}">{{ $category->title }}</a>
                                    </td>
                                    <td class="p-2">
                                        @if ($category->canUpdate)
                                        <div>
                                            <a class="hover:text-neutral-500 transition-colors" href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            </a>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        @if ($category->canDelete)
                                        <form action="{{ route('admin.categories.delete', ['id' => $categoriy->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="hover:text-neutral-500 transition-colors" type="submit" onclick="return confirm('削除しますか')">
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
            </div>
        </div>
    </div>
</x-app-layout>