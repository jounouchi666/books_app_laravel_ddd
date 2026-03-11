<span
    {{
        $attributes->merge([
            'class' => 'inline-block text-xs px-2 py-0.5 rounded bg-neutral-100 dark:bg-neutral-700 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-600'
        ])
    }}
>
    {{ $slot }}
</span>