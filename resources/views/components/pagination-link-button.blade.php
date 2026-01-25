@props([
    'disabled' => false,
    'currentPage' => false
])

@if ($disabled)
<span
    {{
        $attributes->merge([
            'class' => 'inline-flex items-center px-2 h-10 bg-slate-300 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 text-neutral-700 dark:text-neutral-300 tracking-widest shadow-sm select-none opacity-25'
        ])
    }}
>
    {{ $slot }}
</span>

@elseif ($currentPage)
<span
    {{
        $attributes->merge([
            'class' => 'inline-flex items-center px-2 h-10 justify-center bg-neutral-600 dark:bg-neutral-200 text-white dark:text-gray-800 tracking-widest select-none'
        ])
    }}
>
    {{ $slot }}
</span>

@else
<a
    {{
        $attributes->merge([
            'class' => 'inline-flex items-center px-2 h-10 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 text-neutral-700 dark:text-neutral-300 uppercase tracking-widest shadow-sm hover:bg-neutral-50 dark:hover:bg-neutral-700 disabled:opacity-25 hover:cursor-pointer transition-colors'
        ])
    }}
>
    {{ $slot }}
</a>
@endif