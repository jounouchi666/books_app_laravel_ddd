@props(['value'])

<label
    {{ $attributes->merge([
        'class' => 'block text-lg text-neutral-700 dark:text-neutral-300'
        ])
    }}
>
    {{ $value ?? $slot }}
</label>
