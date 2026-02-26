<form action="{{ route($route, ['id' => $bookId]) }}" method="post">
    @csrf
    @method('patch')
    <select
        name="reading_status"
        class="focus:outline-teal-500 dark:focus:outline-teal-600"
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