<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 h-10 bg-neutral-600 dark:bg-neutral-200 text-white dark:text-gray-800 uppercase tracking-widest hover:bg-neutral-500 dark:hover:bg-white focus:bg-neutral-700 dark:focus:bg-white active:bg-neutral-950 dark:active:bg-neutral-300 hover:cursor-pointer transition-colors'
]) }}>
    {{ $slot }}
</button>
