<button
    {{
        $attributes->merge([
            'type' => 'button',
            'class' => 'inline-flex items-center px-4 h-10 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 text-neutral-700 dark:text-neutral-300 uppercase tracking-widest shadow-sm hover:bg-neutral-50 dark:hover:bg-neutral-700 disabled:opacity-25 hover:cursor-pointer transition-colors'
        ])
    }}
>
    {{ $slot }}
</button>
