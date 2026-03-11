@props([
    'disabled' => false,
    'href' => '#'
])

@if ($disabled)
<span
    {{ $attributes->merge([
        'class' => 'group inline-flex items-center gap-1 text-red-600 line-through'
    ]) }}
>
    {{ $slot }}
</span>
@else
<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'group inline-flex items-center gap-1 text-neutral-900 dark:text-neutral-100 hover:text-teal-600 hover:underline transition'
    ]) }}
>
    {{ $slot }}
</a>
@endif