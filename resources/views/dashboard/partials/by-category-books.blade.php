<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            カテゴリー別冊数
        </h2>
    </header>

    <dl class="mt-4 space-y-3">
        @forelse ($dashboard->byCategoryBooks as $category)
        <div class="flex justify-between items-center">
            <dt class="text-sm text-gray-800 dark:text-gray-200">{{ $category->label() }}</dt>
            <dd class="text-base font-semibold text-neutral-900 dark:text-neutral-100">{{ $category->count }}</dd>
        </div>
        @empty
        <p class="text-sm text-gray-800 dark:text-gray-200">該当するカテゴリーはありません</p>
        @endforelse
    </dl>
</section>