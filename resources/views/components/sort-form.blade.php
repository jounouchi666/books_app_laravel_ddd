@php use App\Application\Shared\Enum\SortDirection; @endphp
<form 
    id="{{ $id }}"
    action="{{ route($route) }}"
    method="get"
    {{ 
        $attributes->merge([
            'class' => 'w-full'
        ])
    }}
>
    @csrf
    <x-form-query-input :params="$currentQueries" />

    <div class="flex flex-nowrap gap-2 items-stretch">

        <div class="flex flex-nowrap items-stretch">
            <select
                id="{{ $id }}-sort"
                class="px-3 w-40 h-10 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 outline-none focus:border-teal-500 dark:focus:border-teal-600"
                name="sort"
            >
                @foreach($sorts as $key => $value)
                    <option value="{{ $key }}" @selected($sortSelected === $key)>{{ $value }}</option>
                @endforeach
            </select>

            <select
                id="{{ $id }}-direction"
                class="px-3 w-24 h-10 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 outline-none focus:border-teal-500 dark:focus:border-teal-600"
                name="direction"
            >
                @foreach (SortDirection::cases() as $direction)
                <option
                    value="{{ $direction->value }}"
                    @selected($directionSelected === $direction)
                >
                    {{ $direction->label() }}
                </option>
                @endforeach
            </select>
        </div>
        
        <x-primary-button>
            並べ替える
        </x-primary-button>

    </div>

    <x-input-error :messages="$errors->get('sort')" class="mt-1" />
    <x-input-error :messages="$errors->get('direction')" />
</form>