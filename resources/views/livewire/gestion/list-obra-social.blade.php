<div x-data="{ open: $wire.entangle('show') }">

    <div
        x-show="open"
        x-transition.opacity
        x-transition:enter.duration.100ms
        x-transition:leave.duration.300ms
        x-cloak
        class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center bg-black bg-opacity-70 overflow-auto"
    >
        <div class="m-3 mx-auto mt-11 size-4/5">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70"
            >
                <div
                    class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700"
                >
                    <x-formcomponent.modaltitle>Obra Sociales.</x-formcomponent.modaltitle>
                    <button
                        wire:click="$set('show', false);$dispatch('clearColorOpcionMenu')"
                        type="button"
                        class="flex size-7 items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <x-close-modal></x-close-modal>
                    </button>
                </div>
                <div class="overflow-y-auto p-4">
                    <x-table.boxsearch :listFilterValues="$listFilterValues"></x-table.boxsearch>
                    @if(count($listInsurances) > 0)

                        <div
                            class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
                        >

                            <table
                                class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                            >
                                <x-table.thead>
                                    <tr>
                                        <x-table.th>
                                            ID
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('insurance_name')"
                                        >
                                            <x-table.sortcolumn currentColumn="insurance_name" :$columName
                                                                :$sortDirection>
                                                <div>Nombre</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('insurance_acronym')"
                                        >
                                            <x-table.sortcolumn currentColumn="insurance_acronym" :$columName
                                                                :$sortDirection>
                                                <div>Siglas</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('insurance_type_id')"
                                        >
                                            <x-table.sortcolumn currentColumn="insurance_type_id" :$columName
                                                                :$sortDirection>
                                                <div>Tipo</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('insurance_cuit')"
                                        >
                                            <x-table.sortcolumn currentColumn="insurance_cuit" :$columName
                                                                :$sortDirection>
                                                <div>Cuit</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('insurance_code')"
                                        >
                                            <x-table.sortcolumn currentColumn="insurance_code" :$columName
                                                                :$sortDirection>
                                                <div>Código</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('state_id')"
                                        >
                                            <x-table.sortcolumn currentColumn="state_id" :$columName
                                                                :$sortDirection>
                                                <div>Estatus</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th></x-table.th>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($listInsurances as $insurance)

                                        <tr
                                            class="even:bg-gray-100"
                                            wire:key="{{ $insurance->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $insurance->insurance_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $insurance->insurance_acronym }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                {{ $insurance->insuranceType->insuratype_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                {{ $insurance->insurance_cuit }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                {{ $insurance->insurance_code }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                <x-statescolor
                                                    idstatecolor="{{ $insurance->state->id }}"
                                                >
                                                    {{ $insurance->state->state_name }}
                                                </x-statescolor>
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap></x-table.tdtable>
                                        </tr>
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                            @else
                                <x-alert windowtype="error">
                                    No existen obras sociales.
                                </x-alert>
                            @endif
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-2 border-t px-4 py-2 dark:border-neutral-700"
                        >
                            <x-buttons.close
                                wire:click="$set('show', false);$dispatch('clearColorOpcionMenu')"
                            >
                                {{ __("Cerrar") }}
                            </x-buttons.close>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
