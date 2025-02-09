<div x-data="{ open: $wire.entangle('show') }">

    <div
        x-show="open"
        x-transition.opacity
        x-transition:enter.duration.100ms
        x-transition:leave.duration.300ms
        x-cloak
        class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center bg-black bg-opacity-70"
    >
        <div class="m-3 mx-auto mt-11 size-4/5">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70"
            >
                <div
                    class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700"
                >
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Sucursales.
                    </h3>
                    <button
                        wire:click="$set('show', false);$dispatch('clearColorOpcionMenu')"
                        type="button"
                        class="flex size-7 items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <span class="sr-only">Close</span>
                        <svg
                            class="size-4 flex-shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="overflow-y-auto p-4">
                    @if (count($listCompanyBranch) > 0)
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
                                        <x-table.th>
                                            Empresa
                                        </x-table.th>
                                        <x-table.th>
                                            Sucursal
                                        </x-table.th>
                                        <x-table.th>
                                            Código
                                        </x-table.th>
                                        <x-table.th>
                                            Status
                                        </x-table.th>
                                        <x-table.th>
                                            Correo
                                        </x-table.th>
                                        <x-table.th>
                                            Teléfono
                                        </x-table.th>
                                        <x-table.th>

                                        </x-table.th>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($listCompanyBranch as $branch)
                                        @foreach ($branch->branches as $branches)
                                            <tr
                                                class="even:bg-gray-100"
                                                wire:key="{{ $branches->id }}"
                                            >
                                                <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                    {{ $loop->iteration }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                    {{ $branch->company_name }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtnormal" break-words>
                                                    {{ $branches->branch_name }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtimportant" break-words>
                                                    {{ $branches->branch_code }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                    <x-statescolor
                                                        idstatecolor="{{ $branches->state->id }}"
                                                    >
                                                        {{ $branches->state->state_name }}
                                                    </x-statescolor>
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtnormal" break-words>
                                                    {{ $branches->branch_email }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                    {{ $branches->branch_phone }}
                                                </x-table.tdtable>
                                                <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                    <div
                                                        class="mr-2 w-4 transform hover:scale-110 hover:text-blue-700"
                                                    >
                                                        <x-headerform.eyeoption
                                                            wire:key="{{ $branches->id }}"
                                                            wire:click.prevent="dataBranch({{ $branches->id }})"
                                                            wire:target="idBranch"
                                                        ></x-headerform.eyeoption>
                                                    </div>
                                                </x-table.tdtable>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                        </div>
                    @else
                        <x-alert windowtype="error">
                            No existen sucursales registradas.
                        </x-alert>
                    @endif
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
