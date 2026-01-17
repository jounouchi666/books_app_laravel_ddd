@props(['disabled' => false])

<input
    @disabled($disabled)
    {{
        $attributes->merge([
            'class' => 'px-3 h-10 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 outline-none'
        ])
    }}
>
