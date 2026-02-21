<form
    action="{{ route($route) }}"
    method="get"
    x-data='@json(["allUsers" => $allUsers])'
    class="flex items-center gap-2"
>
    <x-form-query-input :params="$currentQueries" />

    <div class="flex flex-col items-end gap-4 md:flex-row md:gap-2">

        <div class="inline-flex h-10">
            <label for="specific_users" class="relative cursor-pointer">
                <input
                    id="specific_users"
                    type="radio"
                    name="all_users"
                    value="0"
                    class="sr-only peer"
                    :checked="!allUsers"
                    x-on:change="
                        allUsers = false;
                        $nextTick(() => $el.form.submit());
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
                    個別ユーザー
                </span>
            </label>
            <label for="all_users" class="relative cursor-pointer -ml-px">
                <input
                    id="all_users"
                    type="radio"
                    name="all_users"
                    value="1"
                    class="sr-only peer"
                    :checked="allUsers"
                    x-on:change="
                        allUsers = true;
                        $nextTick(() => $el.form.submit());
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
                    全ユーザー
                </span>
            </label>
        </div>

        <div>
            <select
                name="user_id"
                :disabled="allUsers"
                x-on:change="if(!allUsers) $el.form.submit()"
                class="
                    px-3 h-10 w-48
                    border border-gray-300 dark:border-gray-700
                    bg-white dark:bg-gray-900
                    text-gray-800 dark:text-gray-200
                    disabled:bg-gray-100 dark:disabled:bg-gray-800
                    disabled:text-gray-400
                    outline-none
                    focus:border-teal-500 dark:focus:border-teal-600
                "
            >
                @foreach ($users as $user)
                <option value="{{ $user->id }}" :selected="@json($selectedUserId === $user->id)">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

    </div>
</form>