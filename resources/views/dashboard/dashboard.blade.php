<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-main-content-area>
        <div class="grid gap-6">

            <x-dashboard-panel>
                @include('dashboard.partials.reading-status-summary')
            </x-dashboard-panel>

            <div class="grid gap-6 md:grid-cols-2">
                <x-dashboard-panel>
                    @include('dashboard.partials.reading-books')
                </x-dashboard-panel>

                <x-dashboard-panel>
                    @include('dashboard.partials.by-category-books')
                </x-dashboard-panel>
            </div>

            @if ($isAdmin)
            <div class="grid gap-6 md:grid-cols-2">
                <x-dashboard-panel>
                    @include('dashboard.partials.admin.deleted')
                </x-dashboard-panel>
            </div>
            @endif
            
        </div>
    </x-main-content-area>
</x-app-layout>
