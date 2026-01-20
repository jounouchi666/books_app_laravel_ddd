@props([
    'id' => "sort-form",
    'action' => '',
    'sorts' => ['id' => 'ID', 'created_at' => '作成日'],
    'sortSelected' => 'created_at',
    'directionSelected' => 'desc',
    'errors' => null
])

<form 
    id="{{ $id }}"
    action="{{ $action }}"
    method="get"
    {{ 
        $attributes->merge([
            'class' => 'w-full'
        ])
    }}
>
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
                <option value="desc" @selected($directionSelected === 'desc')>降順</option>
                <option value="asc" @selected($directionSelected === 'asc')>昇順</option>
            </select>
        </div>
        
        <x-primary-button>
            並べ替える
        </x-primary-button>

    </div>

    <div class="mt-2">
        <x-input-error :messages="$errors->get('sort')" />
        <x-input-error :messages="$errors->get('direction')" />
    </div>
</form>