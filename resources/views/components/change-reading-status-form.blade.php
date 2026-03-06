<form
    action="{{ route($route, ['id' => $bookId]) }}"
    method="post"
    x-data
>
    @csrf
    @method('patch')
    <select
        name="reading_status"
        class="{{ $width }} min-h-[44px] px-3 rounded-md border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-800 dark:text-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 transition"
        x-on:change="$el.form.submit()"
    >
        @foreach ($statuses as $status)
        <option
            value="{{ $status->value }}"
            @selected($status === $selected)
        >
            {{ $status->label() }}
        </option>
        @endforeach
    </select>
</form>