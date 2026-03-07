@props(['messages'])

@if ($messages)
<div
    x-data="{ open: false }" 
    x-on:mouseenter="open = true"
    x-on:mouseleave="open = false"
    class="relative inline-block align-middle"
>
    <div class="text-red-600 dark:text-red-400 cursor-help">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x-icon lucide-circle-x">
            <circle cx="12" cy="12" r="10"/>
            <path d="m15 9-6 6"/><path d="m9 9 6 6"/>
        </svg>
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute z-50 min-w-[150px] p-2 mt-1 text-xs shadow-lg rounded-md border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-800 left-1/2 -translate-x-1/2"
        style="display: none;"
    >
        <x-input-error :messages="$messages" />
        <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white dark:bg-gray-800 border-t border-l border-gray-300 dark:border-gray-700 rotate-45"></div>
    </div>
</div>
@endif