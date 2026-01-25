<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>
    
    <x-main-content-area>
        <x-main-content-panel>
            <h1 class="text-3xl font-medium">{{ $book->title }}</h1>

            <div class="mt-4 w-full flex flex-col gap-2">
                <p>{{ $book->categoryTitle }}</p>
            </div>
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>