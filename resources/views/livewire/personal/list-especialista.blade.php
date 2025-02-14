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
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Especialistas.
                    </h3>
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
                    @if(count($listMedical) > 0)

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
                                            wire:click="orderColumBy('medical_name')"
                                        >
                                            <x-table.sortcolumn currentColumn="medical_name" :$columName
                                                                :$sortDirection>
                                                <div>Nombre</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('medical_lastname')"
                                        >
                                            <x-table.sortcolumn currentColumn="medical_lastname" :$columName
                                                                :$sortDirection>
                                                <div>Apellido</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th>
                                            Matrícula
                                        </x-table.th>
                                        <x-table.th>
                                            Especialidad
                                        </x-table.th>
                                        <x-table.th>
                                            Estatus
                                        </x-table.th>
                                        <x-table.th>

                                        </x-table.th>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($listMedical as $medical)

                                        <tr
                                            class="even:bg-gray-100"
                                            wire:key="{{ $medical->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $medical->medical_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $medical->medical_lastname }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                {{ $medical->credentials->first()->credential_code.'-'.$medical->first_credential_number }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ optional($medical->specialty)->specialty_name ?? '-'}}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                <x-statescolor
                                                    idstatecolor="{{ $medical->state->id }}"
                                                >
                                                    {{ $medical->state->state_name }}
                                                </x-statescolor>
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                <div
                                                    class="mr-2 w-4 transform hover:scale-110 hover:text-blue-700"
                                                >
                                                    <x-headerform.eyeoption
                                                        wire:key="{{ $medical->id }}"
                                                        wire:click.prevent="dataMedic({{ $medical->id }})"
                                                    ></x-headerform.eyeoption>
                                                </div>
                                            </x-table.tdtable>
                                        </tr>
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                            <div class="mt-2 mb-2 justify-end mx-2">
                                {{ $listMedical->links() }}
                            </div>
                            @else
                                <x-alert windowtype="error">
                                    No existen especialistas registrados.
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
