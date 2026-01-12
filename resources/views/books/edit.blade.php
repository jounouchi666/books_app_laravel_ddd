<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form
                    action="{{ $mode === 'create' ? route('books.store') : route('books.update', ['id' => $book->id]) }}"
                    method="POST"
                    class="mt-8 flex flex-col items-center"
                >
                    @csrf
                    @if ($mode === 'edit')
                        @method('patch')
                    @endif
                    <div class="mt-4 w-full flex flex-col gap-2">
                        <label class="text-lg leading-none" for="book_title">タイトル</label>
                        <input id="book_title" class="px-3 outline h-10" type="text" name="title" value="{{ old('title', $book->title) }}" maxlength="100" required>
                    </div>

                    <div class="mt-4 w-full flex flex-col gap-2">
                        <label for="book_category">カテゴリー</label>
                        <select id="book_category" class="px-3 outline h-10" name="category_id">
                            <option value="">カテゴリーを選択してください</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $book->categoryId ?? '') === $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input class="mt-4 w-48 outline h-10 bg-neutral-600 text-white hover:bg-neutral-500 hover:cursor-pointer transition-colors" type="submit" value="登録">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>