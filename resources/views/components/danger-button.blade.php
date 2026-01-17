<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center px-4 h-10 bg-red-600 text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 hover:cursor-pointer transition-colors'
        ])
    }}
>
    {{ $slot }}
</button>
