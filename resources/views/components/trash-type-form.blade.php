<form
    action="{{ route($route) }}"
    method="get"
    x-data='@json(["checked" => $selectedTrashType])'
>
    <x-form-query-input :params="$currentQueries" />

    <div class="inline-flex h-10">

        <label for="trashed_type_{{ $without->value }}" class="cursor-pointer">
            <input
                id="trashed_type_{{ $without->value }}"
                type="radio"
                name="trash_type"
                value="{{ $without->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $without->value }}'"
                x-on:change="
                    checked = '{{ $without->value }}';
                    $el.form.submit();
                "
            >
            <span class="
                inline-flex items-center px-4 h-10
                border border-gray-300 dark:border-gray-700
                bg-white dark:bg-gray-900
                text-gray-700 dark:text-gray-300
                peer-checked:bg-neutral-600
                peer-checked:text-white
                dark:peer-checked:bg-neutral-200
                dark:peer-checked:text-gray-800
                transition-colors
            ">
                {{ $without->label() }}
            </span>
        </label>
        <label for="trashed_type_{{ $all->value }}" class="relative cursor-pointer -ml-px">
            <input
                id="trashed_type_{{ $all->value }}"
                type="radio"
                name="trash_type"
                value="{{ $all->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $all->value }}'"
                x-on:change="
                    checked = '{{ $all->value }}';
                    $el.form.submit();
                "
            >
            <span class="
                inline-flex items-center px-4 h-10
                border border-gray-300 dark:border-gray-700
                bg-white dark:bg-gray-900
                text-gray-700 dark:text-gray-300
                peer-checked:bg-neutral-600
                peer-checked:text-white
                dark:peer-checked:bg-neutral-200
                dark:peer-checked:text-gray-800
                transition-colors
            ">
                {{ $all->label() }}
            </span>
        </label>
        <label for="trashed_type_{{ $only->value }}" class="relative cursor-pointer -ml-px">
            <input
                id="trashed_type_{{ $only->value }}"
                type="radio"
                name="trash_type"
                value="{{ $only->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $only->value }}'"
                x-on:change="
                    checked = '{{ $only->value }}';
                    $el.form.submit();
                "
            >
            <span class="
                inline-flex items-center px-4 h-10
                border border-gray-300 dark:border-gray-700
                bg-white dark:bg-gray-900
                text-gray-700 dark:text-gray-300
                peer-checked:bg-neutral-600
                peer-checked:text-white
                dark:peer-checked:bg-neutral-200
                dark:peer-checked:text-gray-800
                transition-colors
            ">
                {{ $only->label() }}
            </span>
        </label>

    </div>

    <x-input-error :messages="$errors->get('trash_type')" class="mt-1" />

</form>