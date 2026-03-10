@if ($paginateView->hasPagination())
<div class="flex-col items-center mt-4">
    <nav class="flex justify-center">
        <ul class="inline-flex items-center space-x-1 text-sm">
            <li>
                <x-pagination-link-button
                    href="{{ $paginateView->firstPageUrl() }}"
                    :disabled="$paginateView->onFirstPage"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left-icon lucide-chevrons-left">
                        <path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/>
                    </svg>
                </x-pagination-link-button>
            </li>
            <li>
                <x-pagination-link-button
                    href="{{ $paginateView->previousPageUrl() }}"
                    :disabled="$paginateView->onFirstPage"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </x-pagination-link-button>
            </li>

            @foreach ($pages() as $page)
            <li>
                <x-pagination-link-button
                    href="{{ $paginateView->pageUrl($page['page']) }}"
                    :current-page="$page['isCurrent']"
                >
                    {{ $page['page'] }}
                </x-pagination-link-button>
            </li>
            @endforeach

            <li>
                <x-pagination-link-button
                    href="{{ $paginateView->nextPageUrl() }}"
                    :disabled="$paginateView->onLastPage"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </x-pagination-link-button>
            </li>
            <li>
                <x-pagination-link-button
                    href="{{ $paginateView->lastPageUrl() }}"
                    :disabled="$paginateView->onLastPage"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
                        <path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/>
                    </svg>
                </x-pagination-link-button>
            </li>
        </ul>
    </nav>

    <div class="text-center text-sm mt-2 dark:text-gray-300">
        {{ $paginateView->total }}件中 {{ $displayPerTotalStart }} - {{ $displayPerTotalEnd }} 件を表示
    </div>
</div>
@endif