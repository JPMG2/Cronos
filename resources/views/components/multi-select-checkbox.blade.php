@props([
    'options' => [],           // Array of options: ['value' => 'label'] or collection
    'selected' => [],          // Array of selected values
    'placeholder' => 'Select options',
    'searchPlaceholder' => 'Search...',
    'selectAllText' => 'Select All',
    'maxHeight' => '300px',    // Max height of dropdown
])

@php
    $wireModel = $attributes->wire('model')->value();
    $allValuesArray = collect($options)->keys()->map(fn($id) => (int)$id)->toArray();
@endphp

<div
    x-data="{
        open: false,
        search: '',
        selectedValues: @entangle($wireModel).live,
        allValues: {{ json_encode($allValuesArray) }},
        allSelected: false,

        init() {
            this.updateAllSelected();
            // Watch for changes to selectedValues
            this.$watch('selectedValues', () => {
                this.updateAllSelected();
            });
        },

        get filteredOptions() {
            if (!this.search) return {{ collect($options)->toJson() }};

            const searchLower = this.search.toLowerCase();
            const filtered = {};

            @foreach($options as $value => $label)
                if ('{{ strtolower($label) }}'.includes(searchLower)) {
                    filtered['{{ $value }}'] = '{{ $label }}';
                }
            @endforeach

            return filtered;
        },

        toggleSelectAll() {
            if (this.allSelected) {
                this.selectedValues = [];
            } else {
                this.selectedValues = [...this.allValues];
            }
            this.updateAllSelected();
        },

        toggleOption(value) {
            // Convert to integer if needed
            const numValue = parseInt(value);
            const index = this.selectedValues.indexOf(numValue);
            if (index > -1) {
                this.selectedValues.splice(index, 1);
            } else {
                this.selectedValues.push(numValue);
            }
            this.updateAllSelected();
        },

        isSelected(value) {
            const numValue = parseInt(value);
            return this.selectedValues.includes(numValue);
        },

        updateAllSelected() {
            this.allSelected = this.allValues.length > 0 &&
                              this.selectedValues.length === this.allValues.length;
        },

        get selectedCount() {
            return this.selectedValues.length;
        }
    }"
    @click.away="open = false"
    class="relative w-full"
>
    {{-- Trigger Button --}}
    <button
        type="button"
        @click="open = !open"
        class="w-full flex items-center justify-between px-4 py-2.5 text-sm border border-slate-300 rounded-lg bg-white hover:bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
    >
        <span class="flex items-center gap-2">
            <span x-show="selectedCount === 0" class="text-slate-500">{{ $placeholder }}</span>
            <span x-show="selectedCount > 0" class="text-slate-700">
                <span x-text="selectedCount"></span> selected
            </span>
        </span>
        <svg
            class="w-5 h-5 text-slate-400 transition-transform duration-200"
            :class="{ 'rotate-180': open }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    {{-- Dropdown Panel --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute z-50 w-full mt-2 bg-white border border-slate-300 rounded-lg shadow-lg"
        @click.stop
    >
        {{-- Search Input --}}
        <div class="p-3 border-b border-slate-200">
            <input
                type="text"
                x-model="search"
                placeholder="{{ $searchPlaceholder }}"
                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                @click.stop
            />
        </div>

        {{-- Select All Option --}}
        <div class="border-b border-slate-200 bg-slate-50 ">
            <label
                class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50 cursor-pointer transition-colors"
                @click.prevent="toggleSelectAll()"
            >
                <input
                    type="checkbox"
                    :checked="allSelected"
                    class="checkbox-default w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500 pointer-events-none"
                />
                <span class="text-sm font-semibold text-slate-700">{{ $selectAllText }}</span>
            </label>
        </div>

        {{-- Options List --}}
        <div
            class="overflow-y-auto"
            style="max-height: {{ $maxHeight }}"
        >
            <template x-for="[value, label] in Object.entries(filteredOptions)" :key="value">
                <label
                    class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50 cursor-pointer transition-colors"
                    :class="{ 'bg-blue-50': isSelected(value) }"
                    @click.prevent="toggleOption(value)"
                >
                    <input
                        type="checkbox"
                        :checked="isSelected(value)"
                        :value="value"
                        class="checkbox-default w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500 pointer-events-none"
                    />
                    <span class="text-sm text-slate-700" x-text="label"></span>
                </label>
            </template>

            {{-- No results message --}}
            <div
                x-show="Object.keys(filteredOptions).length === 0"
                class="px-4 py-8 text-center text-slate-500"
            >
                <svg class="w-12 h-12 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-sm">No existe el servicio</p>
            </div>
        </div>

        {{-- Footer with selected count --}}
        <div class="px-4 py-2 bg-slate-50 border-t border-slate-200">
            <p class="text-xs text-slate-600">
                <span x-text="selectedCount"></span> de <span x-text="allValues.length"></span> seleccionado
            </p>
        </div>
    </div>
</div>
