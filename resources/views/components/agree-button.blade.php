<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 h-10 bg-teal-600 text-white uppercase tracking-widest hover:bg-teal-500 active:bg-teal-700 hover:cursor-pointer select-none transition-colors'
        ])
    }}
>
    {{ $slot }}
</button>
