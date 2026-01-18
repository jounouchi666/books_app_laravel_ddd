@props([
    'disabled' => false,
    'options' => [],
    'selected' => null
])

<select
    @disabled($disabled)
    {{
        $attributes->merge([
            'class' => 'px-3 h-10 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 outline-none focus:border-teal-500 dark:focus:border-teal-600'
        ])
    }}
>
    {{ $slot }}
    @foreach ($options as $option)
    <option
        value="{{ $option->id }}"
        @selected((string)$option->id === (string)$selected)
    >
        {{ $option->title }}
    </option>
    @endforeach
</select>
