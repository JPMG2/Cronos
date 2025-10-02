@props([
    'label' => '',
    'placeholder' => 'buscar...',
    'items' => [],
    'idField' => '',
    'nameField' => '',
    'displayField' => 'name',
    'valueField' => 'id',
    'error' => false,
    'required' => false,
])

<div class="relative w-full">
    <div class="relative"
         x-data="autocomplete()"
         x-init="isOpen = {{ count($items) > 0 ? 'true' : 'false' }}"
         @click.away="close()"
    >
        <div class="relative">
            <x-simple-label :label="$label" :required="$required">
                <div class="relative">
                    <input
                        type="text"
                        :placeholder="placeholder"
                        autocomplete="off"
                        wire:model.live.debounce.300ms="{{ $nameField }}"
                        @keydown="handleKeydown($event, {{ count($items) }})"
                        @focus="isOpen = {{ count($items) > 0 ? 'true' : 'false' }}"
                        class="border-1 {{ $error ? 'border-red-300' : 'border-gray-300' }} peer block w-full appearance-none rounded-lg bg-transparent px-2.5 pb-1 pt-3.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                    />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg
                            type="button"
                            @click="clear('{{ $nameField }}', '{{ $idField }}')"
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
            <div x-show="isOpen && {{ count($items) }} > 0" x-cloak>
                <ul
                    class="absolute z-20 max-h-75 w-full divide-y overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-2 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    tabindex="-1"
                    role="listbox"
                    aria-labelledby="listbox-label"
                >
                    @foreach ($items as $index => $item)
                        <li
                            data-autocomplete-item
                            @click="selectItem('{{ data_get($item, $valueField) }}', '{{ data_get($item, $displayField) }}', '{{ $idField }}', '{{ $nameField }}')"
                            @mouseenter="selectedIndex = {{ $index }}"
                            :class="isSelected({{ $index }}) ? 'bg-indigo-600 text-white' : 'text-gray-900 hover:bg-indigo-100'"
                            class="relative cursor-pointer select-none py-2 pl-3 pr-9 transition-colors"
                            role="option"
                        >
                            <div class="flex items-center">
                                <span
                                    class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400"
                                    aria-hidden="true"
                                ></span>
                                <span class="ml-3 block truncate font-normal text-xs">{{ data_get($item, $displayField) }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($error)
            <x-inputs.error-validate>
                {{ $error }}
            </x-inputs.error-validate>
        @endif
    </div>
</div>
