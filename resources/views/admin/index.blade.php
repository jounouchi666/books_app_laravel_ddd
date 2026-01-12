<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者メニュー
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <ul class="d-flex">
                    <li>
                        <a class="border rounded" href="">管理者一覧</a>
                    </li>
                    <li>
                        <a class="border rounded" href="{{ route('admin.categories.list') }}">カテゴリー一覧</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>