<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            読書中の本
        </h2>
    </header>

    <ul class="mt-4 divide-y divite-neutral-200 dark:divide-neutral-700">
        @forelse ($dashboard->readingBooks as $book)
        <li class="py-3 flex justify-between items-center">
            <span class="text-sm text-gray-800 dark:text-gray-200">
                {{ $book->title }}
            </span>
            <x-anker
                href="{{ route('books.show', ['id' => $book->id]) }}"
                class="text-xs text-teal-600 dark:text-teal-500"
            >
                詳細
            </x-anker>
        </li>
        @empty
        <p class="text-sm text-gray-800 dark:text-gray-200">読書中の本はありません</p>
        @endforelse
    </ul>
</section>