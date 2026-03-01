@if (session('success'))
<div
    class="p-4 flex items-center gap-2 text-green-800 dark:text-green-400 border-green-200 dark:border-green-900/30 bg-green-50 dark:bg-green-950/20 rounded-lg transition-[height] transition-opacity duration-350 ease"
    x-data
    x-init="() => {
        setTimeout(() => {
            $el.classList.add('height-[0]', 'opacity-[0]');
            $el.addEventListener('transitionend', () => $el.remove(), {once: true});
        }, 3000)
    }"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check">
        <circle cx="12" cy="12" r="10"/>
        <path d="m9 12 2 2 4-4"/>
    </svg>
    <p class="font-medium">
        {{ session('success') }}
    </p>
</div>
@endif