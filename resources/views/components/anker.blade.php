@props([
    'disabled' => false,
    'href' => '#'
])

@if ($disabled)
<span
    {{ $attributes->merge([
        'class' => 'group inline-flex items-center gap-1 text-neutral-900 dark:text-neutral-100 line-through text-red-600'
    ]) }}
>
    {{ $slot }}
</span>
@else
<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'group inline-flex items-center gap-1 text-neutral-900 dark:text-neutral-100 hover:text-teal-600 transition'
    ]) }}
>
    {{ $slot }}
</a>
@endif