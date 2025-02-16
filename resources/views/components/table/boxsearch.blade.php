@props(['listFilterValues'=>[] ])
<div class="mt-0.5 mb-0.5">
    <div class="flex gap-x-1 sm:col-span-3"
         x-data=""
    >
        <div class="relative w-2/5 sm:col-span-3">
            <div class="relative">
                <x-inputs.selectgroup
                    label="Filtro"
                    for="filteropcion"
                    required="yes"
                >
                    <x-inputs.selectinput
                        wire:model.defer="filtervalue"
                        id="filteropcion"
                        x-on:change="$refs.sortfield.value = ''"
                    >
                        @foreach ($listFilterValues as $key=>$filterValues)
                            <option value="{{ $key }}">
                                {{ $filterValues}}
                            </option>
                        @endforeach
                    </x-inputs.selectinput>
                </x-inputs.selectgroup>
            </div>

        </div>
        <div class="relative w-full sm:col-span-4">
            <div class="relative">
                <x-inputs.textgroup
                    label="Buscar.."
                    for="sortfield"
                    required="yes"
                >
                    <x-inputs.textinput
                        wire:model.live.debounce.300ms="sortField"
                        id="sortfield"
                        autocomplete="off"
                        maxlength="170"
                        placeholder=" "
                        x-ref="sortfield"
                    ></x-inputs.textinput>
                </x-inputs.textgroup>
            </div>

        </div>
    </div>
</div>
