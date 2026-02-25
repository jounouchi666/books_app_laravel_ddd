<?php use App\Application\Shared\Enum\SortDirection; ?>
@props([
    'id' => "sort-form",
    'action' => '',
    'sorts' => ['created_at' => '作成日'],
    'sortSelected' => 'created_at',
    'directionSelected' => SortDirection::Desc,
    'errors' => null,
    'params' => []
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
    <x-form-query-input :params="$params" :except="['sort', 'direction']" />

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
                <option
                    value="{{ SortDirection::Desc->value }}"
                    @selected($directionSelected === SortDirection::Desc)
                >
                    {{ SortDirection::Desc->label() }}
                </option>
                <option
                    value="{{ SortDirection::Asc->value }}"
                    @selected($directionSelected === SortDirection::Asc)
                >
                    {{ SortDirection::Asc->label() }}
                </option>
            </select>
        </div>
        
        <x-primary-button>
            並べ替える
        </x-primary-button>

    </div>

    <div>
        <x-input-error :messages="$errors->get('sort')" />
        <x-input-error :messages="$errors->get('direction')" />
    </div>
</form>