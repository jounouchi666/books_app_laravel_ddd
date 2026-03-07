<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>

            <x-back-link
                class="mb-6"
                href="{{ $mode === 'create' ? route('books.index') : route('books.show', ['id' => $book->id]) }}"
            >
                {{ $mode === 'create' ? '一覧' : '詳細画面' }}に戻る
            </x-back-link>

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
                    <x-input-label for="book_title" value="タイトル"/>
                    <x-text-input
                        id="book_title"
                        type="text"
                        name="title"
                        :value="old('title', $book->title)"
                        minlength="2"
                        maxlength="100"
                        required
                    />
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

                <div class="mt-4 w-full flex flex-col gap-2">
                    <x-input-label for="book_category" value="カテゴリー" />
                    <x-select-input
                        id="book_category"
                        name="category_id"
                        :options="$categories"
                        :selected="old('category_id', $book->categoryId)"
                    >
                        <option value="">カテゴリーを選択してください</option>
                    </x-select-input>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                </div>
                
                <x-primary-button class="mt-8 w-48">
                    登録
                </x-primary-button>
            </form>
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>