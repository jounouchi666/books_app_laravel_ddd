<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <x-main-content-area>
        <x-main-content-panel>
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-main-content-panel>

        <x-main-content-panel>
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-main-content-panel>

        <x-main-content-panel>
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-main-content-panel>
    </x-main-content-area>
</x-app-layout>
