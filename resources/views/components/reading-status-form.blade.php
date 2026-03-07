<form
    action="{{ route($route) }}"
    method="get"
    x-data='@json(["checked" => $selectedReadingStatus ?? "all"])'
>
    @csrf
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
        <label for="reading_status_{{ $unread->value }}" class="relative cursor-pointer -ml-px">
            <input
                id="reading_status_{{ $unread->value }}"
                type="radio"
                name="reading_status"
                value="{{ $unread->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $unread->value }}'"
                x-on:change="
                    checked = '{{ $unread->value }}';
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
                {{ $unread->label() }}
            </span>
        </label>
        <label for="reading_status_{{ $reading->value }}" class="relative cursor-pointer -ml-px">
            <input
                id="reading_status_{{ $reading->value }}"
                type="radio"
                name="reading_status"
                value="{{ $reading->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $reading->value }}'"
                x-on:change="
                    checked = '{{ $reading->value }}';
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
                {{ $reading->label() }}
            </span>
        </label>
        <label for="reading_status_{{ $completed->value }}" class="relative cursor-pointer -ml-px">
            <input
                id="reading_status_{{ $completed->value }}"
                type="radio"
                name="reading_status"
                value="{{ $completed->value }}"
                class="sr-only peer"
                :checked="checked === '{{ $completed->value }}'"
                x-on:change="
                    checked = '{{ $completed->value }}';
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
                {{ $completed->label() }}
            </span>
        </label>

    </div>

    <div class="mt-1">
        <x-input-error :messages="$errors->get('reading_status')" class="mt-1" />
    </div>

</form>