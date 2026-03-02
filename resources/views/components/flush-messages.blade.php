@php
    $success = session('success');
    $error = session('error') || 1;
@endphp

@if ($success || $error)
<ul
    {{
        $attributes->merge([
            'class' => 'flex flex-col gap-1 overflow-hidden'
        ])
    }}
    x-data='@json([
        "showSuccess" =>  $success ? true : false,
        "showError" => $error ? true : false,
        "showParent" => true
    ])'
    x-show="showParent"
    x-init="() => {
        if (showSuccess) {
            setTimeout(() => {
                if (showError) {
                    showSuccess = false;
                } else {
                    showParent = false;
                }
            }, 3000)
        }
    }"
    x-transition:leave="transition-all ease-in duration-[350ms]"
    x-transition:leave-start="opacity-100 max-h-[500px]"
    x-transition:leave-end="opacity-0 max-h-0"
>
    @if ($success)
    <li
        class="overflow-hidden"
        x-show="showSuccess"
        x-transition:leave="transition-all ease-in duration-[350ms]"
        x-transition:leave-start="opacity-100 max-h-[100px]"
        x-transition:leave-end="opacity-0 max-h-0"
    >
        <x-flush-success-message />
    </li>
    @endif
    @if ($error)
    <li>
        <x-flush-error-message />
    </li>
    @endif
</ul>
@endif