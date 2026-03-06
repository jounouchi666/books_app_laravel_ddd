@props([
    'href' => ''    
])

<div
    {{
        $attributes->merge([
            'class' => ''
        ])
    }}
>
    <x-anker class="text-sm" href="{{ $href }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left">
            <path d="m15 18-6-6 6-6"/>
        </svg>
        {{ $slot }}
    </x-anker>
</div>