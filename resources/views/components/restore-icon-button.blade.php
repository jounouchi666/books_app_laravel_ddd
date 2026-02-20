@props([
    'title',
    'action',
    'event'
])

<button
    class="hover:cursor-pointer hover:text-neutral-500 transition-colors"
    type="button"
    x-on:click="
        $dispatch('{{ $event }}', {
            action: '{{ $action }}',
            title: '{{ $title }}'
        });
        $dispatch('open-modal', 'confirm-restore');
    "
>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive-restore-icon lucide-archive-restore">
        <rect width="20" height="5" x="2" y="3" rx="1"/>
        <path d="M4 8v11a2 2 0 0 0 2 2h2"/><path d="M20 8v11a2 2 0 0 1-2 2h-2"/>
        <path d="m9 15 3-3 3 3"/><path d="M12 12v9"/>
    </svg>
</button>