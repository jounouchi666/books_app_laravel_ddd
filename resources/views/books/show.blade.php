<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>
    
    <x-main-content-area>
        <x-main-content-panel>

            <x-flush-success-message />
            <x-flush-error-message />
            
            <dl class="text-lg text-gray-800 dark:text-gray-200 flex flex-wrap max-w-xl">
                <dd class="font-medium w-1/4">タイトル</dd>
                <dt class="w-3/4">{{ $book->title }}</dt>

                <dd class="font-medium w-1/4">カテゴリ</dd>
                <dt class="w-3/4">{{ $book->categoryTitle }}</dt>

                <dd class="font-medium w-1/4">登録者</dd>
                <dt class="w-3/4">{{ $book->userName }}</dt>
            </dl>

            <div class="mt-6 flex gap-2">
                @if ($book->canUpdate)
                <div>
                    <x-primary-link-button class="w-32" href="{{ route('books.edit', ['id' => $book->id]) }}">編集</x-primary-link-button>
                </div>
                @endif
            
                @if ($book->canDelete)
                <div>
                    <x-danger-button class="w-32" x-data x-on:click="$dispatch('open-modal', 'confirm-delete')">削除</x-danger-button>
                </div>

                <x-modal name="confirm-delete" focusable>
                    <form method="post" action="{{ route('books.delete', ['id' => $book->id]) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">本当に削除しますか？</h2>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                キャンセル
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                削除する
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
                @endif
            </div>

        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>