@if (session('error'))
<div class="p-4 flex items-center gap-2 text-red-800 dark:text-red-400 border border-red-200 dark:border-red-900/30 bg-red-50 dark:bg-red-950/20 rounded-lg">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x-icon lucide-circle-x">
        <circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/>
        <path d="m9 9 6 6"/>
    </svg>
    <p class="font-medium">
        {{ session('error') }}
    </p>
</div>
@endif