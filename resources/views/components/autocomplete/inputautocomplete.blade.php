@props([
    'label' => '',
    'placeholder' => 'buscar...',
    'wireModel' => '',
    'wireIdModel' => '',
    'items' => [],
    'displayField' => 'name',
    'valueField' => 'id',
    'required' => false,
])

<div class="relative"
     x-data="autocomplete()"
     @click.away="close()"
>
    <x-simple-label :label="$label" :required="$required">
        <div class="relative">
            <input
                x-ref="input"
                type="text"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
                wire:model.live.debounce.150ms="{{ $wireModel }}"
                @keydown="handleKeydown($event, {{ count($items) }})"
                @focus="if ({{ count($items) }} > 0) { isOpen = true; }"
                class="border-1 border-gray-300 peer block w-full appearance-none rounded-lg bg-transparent px-2.5 pb-1 pt-3.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            />
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg
                    type="button"
                    @click.stop="clear('{{ $wireModel }}', '{{ $wireIdModel }}'); isOpen = false;"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="mr-1 h-4 w-4 cursor-pointer hover:text-red-500 transition-colors"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
                <svg
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="pointer-events-none h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                    />
                </svg>
            </div>
        </div>
    </x-simple-label>

    @if(count($items) > 0)
        <div
            x-show="isOpen"
            x-cloak
            x-init="if (document.activeElement === $refs.input) { isOpen = true; }"
        >
            <x-autocomplete.ulautocomplete>
                @foreach ($items as $index => $item)
                    <x-autocomplete.liautocomplete
                        @click="selectItem('{{ data_get($item, $valueField) }}', '{{ data_get($item, $displayField) }}', '{{ $wireIdModel }}', '{{ $wireModel }}')"
                        @mouseenter="selectedIndex = {{ $index }}"
                        ::class="isSelected({{ $index }}) ? 'bg-indigo-600 text-white' : 'text-gray-900 hover:bg-indigo-100'"
                    >
                        {{ data_get($item, $displayField) }}
                    </x-autocomplete.liautocomplete>
                @endforeach
            </x-autocomplete.ulautocomplete>
        </div>
    @endif
</div>
