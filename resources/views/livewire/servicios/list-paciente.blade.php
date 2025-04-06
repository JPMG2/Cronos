<div wire:show="show">

    <div
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
                    <x-formcomponent.modaltitle>Pacientes.</x-formcomponent.modaltitle>
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
                    @if(count($listPatients) > 0)
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
                                            wire:click="orderColumBy('num_document')"
                                        >
                                            <x-table.sortcolumn currentColumn="num_document" :$columName
                                                                :$sortDirection>
                                                <div>Num documento</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('person_name')"
                                        >
                                            <x-table.sortcolumn currentColumn="person_name" :$columName
                                                                :$sortDirection>
                                                <div>Nombre</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('person_lastname')"
                                        >
                                            <x-table.sortcolumn currentColumn="person_lastname" :$columName
                                                                :$sortDirection>
                                                <div>Apellido</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>

                                        <x-table.th
                                            wire:click="orderColumBy('gender_id')"
                                        >
                                            Genero
                                        </x-table.th>
                                        <x-table.th>
                                            Fecha Nacimiento
                                        </x-table.th>
                                        <x-table.th
                                            wire:click="orderColumBy('person_phone')"
                                        >
                                            <x-table.sortcolumn currentColumn="person_phone" :$columName
                                                                :$sortDirection>
                                                <div>Teléfono</div>
                                            </x-table.sortcolumn>
                                        </x-table.th>
                                        <x-table.th>
                                            Correo
                                        </x-table.th>
                                        <x-table.th>

                                        </x-table.th>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($listPatients as $patiente)
                                        <tr
                                            class="even:bg-gray-100"
                                            wire:key="{{ $patiente->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                        </tr>
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                            @else
                                <x-alert windowtype="error">
                                    No existen especialistas registrados.
                                </x-alert>
                            @endif
                        </div>
                </div>
                <div
                    class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700"
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
