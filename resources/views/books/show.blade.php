<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>
    
    <x-main-content-area>
        <x-main-content-panel>

            <x-flush-messages class="md:mb-4 mb-5" />
            
            <x-back-link class="mb-6" href="{{ route('books.index') }}">一覧に戻る</x-back-link>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <dl class="text-lg text-gray-800 dark:text-gray-200 grid grid-cols-4 gap-y-4">
                        <dt class="font-medium col-span-1 text-gray-500 dark:text-gray-400 text-sm flex items-center">タイトル</dt>
                        <dd class="col-span-3 font-semibold">{{ $book->title }}</dd>

                        <dt class="font-medium col-span-1 text-gray-500 dark:text-gray-400 text-sm flex items-center">カテゴリ</dt>
                        <dd class="col-span-3">{{ $book->categoryLabel() }}</dd>

                        <dt class="font-medium col-span-1 text-gray-500 dark:text-gray-400 text-sm flex items-center">読書状況</dt>
                        <dd class="col-span-3">
                            @if($book->canUpdate)
                                <x-change-reading-status-form
                                    route="books.reading_status"
                                    :bookId="$book->id"
                                    :selected="$book->readingStatus"
                                />
                                <x-input-error :messages="$errors->{'update_status_' . $book->id}->get('reading_status')" class="mt-1" />
                            @else
                                <span class="text-neutral-600 dark:text-neutral-400">
                                    {{ $book->readingStatus->label() }}
                                </span>
                            @endif
                        </dd>
                    </dl>
                </div>

                <div class="lg:col-span-1 space-y-4 border-t lg:border-t-0 lg:border-l border-gray-200 dark:border-gray-700 pt-6 lg:pt-0 lg:pl-8">
                    @if ($isAdmin)
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">登録者</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $book->userName }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">作成日時</p>
                        <p class="text-gray-800 dark:text-gray-200 text-sm">{{ $book->created_at() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">最終更新</p>
                        <p class="text-gray-800 dark:text-gray-200 text-sm">{{ $book->updated_at() }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700 flex gap-2">
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