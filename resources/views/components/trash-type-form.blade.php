<form
    action="{{ route($route) }}"
    method="get"
    x-data='@json(["checked" => $selectedTrashType])'
    class="flex items-center"
>
    <x-form-query-input :params="$currentQueries" />

    <div class="inline-flex h-10">

        <label for="trashed_type_active" class="cursor-pointer">
            <input
                id="trashed_type_active"
                type="radio"
                name="trash_type"
                value="active"
                class="sr-only peer"
                :checked="checked === 'active'"
                x-on:change="
                    checked = 'active';
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
                含まない
            </span>
        </label>
        <label for="trashed_type_with_trashed" class="relative cursor-pointer -ml-px">
            <input
                id="trashed_type_with_trashed"
                type="radio"
                name="trash_type"
                value="with_trashed"
                class="sr-only peer"
                :checked="checked === 'with_trashed'"
                x-on:change="
                    checked = 'with_trashed';
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
                含む
            </span>
        </label>
        <label for="trashed_type_only_trashed" class="relative cursor-pointer -ml-px">
            <input
                id="trashed_type_only_trashed"
                type="radio"
                name="trash_type"
                value="only_trashed"
                class="sr-only peer"
                :checked="checked === 'only_trashed'"
                x-on:change="
                    checked = 'only_trashed';
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
                削除済みのみ
            </span>
        </label>

    </div>
</form>