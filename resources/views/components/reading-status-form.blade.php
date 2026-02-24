<form
    action="{{ route($route) }}"
    method="get"
    x-data='@json(["checked" => $selectedReadingStatus])'
    class="flex items-center"
>
    <x-form-query-input :params="$currentQueries" />

    <div class="inline-flex h-10">

        <label for="reading_status_all" class="cursor-pointer">
            <input
                id="reading_status_all"
                type="radio"
                name="reading_status"
                value="all"
                class="sr-only peer"
                :checked="checked === 'all'"
                x-on:change="
                    checked = 'all';
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
                全て
            </span>
        </label>
        <label for="reading_status_unread" class="cursor-pointer">
            <input
                id="reading_status_unread"
                type="radio"
                name="reading_status"
                value="unread"
                class="sr-only peer"
                :checked="checked === 'unread'"
                x-on:change="
                    checked = 'unread';
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
                未読
            </span>
        </label>
        <label for="reading_status_reading" class="relative cursor-pointer -ml-px">
            <input
                id="reading_status_reading"
                type="radio"
                name="reading_status"
                value="reading"
                class="sr-only peer"
                :checked="checked === 'reading'"
                x-on:change="
                    checked = 'reading';
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
                読書中
            </span>
        </label>
        <label for="reading_status_completed" class="relative cursor-pointer -ml-px">
            <input
                id="reading_status_completed"
                type="radio"
                name="reading_status"
                value="completed"
                class="sr-only peer"
                :checked="checked === 'completed'"
                x-on:change="
                    checked = 'completed';
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
                読了
            </span>
        </label>

    </div>
</form>