<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('admin.index') }}">管理者メニュー</a>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
            </span>
            <span>{{ $title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-main-content-panel>
                <form
                    action="{{ $mode === 'create' ? route('admin.categories.store') : route('admin.categories.update', ['id' => $category->id]) }}"
                    method="POST"
                    class="mt-8 flex flex-col items-center"
                >
                    @csrf
                    @if ($mode === 'edit')
                        @method('patch')
                    @endif
                    <div class="mt-4 w-full flex flex-col gap-2">
                        <x-input-label for="category_title" value="タイトル" />
                        <x-text-input
                            id="category_title"
                            type="text"
                            name="title"
                            :value="old('title', $category->title)"
                            maxlength="100"
                            required
                        />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    
                    <x-primary-button class="mt-8 w-48">
                        登録
                    </x-primary-button>
                </form>
            </x-main-content-panel>
        </div>
    </div>
</x-app-layout>