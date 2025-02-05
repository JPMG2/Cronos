<div x-data="{ open: true }">
    @if ($show)
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
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                ID
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Empresa
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Sucursal
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Código
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Status
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Correo
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Teléfono
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                                            >
                                                Opción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900"
                                    >
                                        @foreach ($listCompanyBranch as $branch)
                                            @foreach ($branch->branches as $branches)
                                                <tr
                                                    class="even:bg-gray-100"
                                                    wire:key="{{ $branches->id }}"
                                                >
                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200"
                                                    >
                                                        <div
                                                            class="inline-flex items-center gap-x-3"
                                                        >
                                                            <span>
                                                                {{ $loop->iteration }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700"
                                                    >
                                                        {{ $branch->company_name }}
                                                    </td>
                                                    <td
                                                        class="break-words px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                                    >
                                                        {{ $branches->branch_name }}
                                                    </td>
                                                    <td
                                                        class="break-words px-3 py-2 text-sm font-medium text-gray-700"
                                                    >
                                                        {{ $branches->branch_code }}
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                                    >
                                                        <x-statescolor
                                                            idstatecolor="{{ $branches->state->id }}"
                                                        >
                                                            {{ $branches->state->state_name }}
                                                        </x-statescolor>
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                                    >
                                                        {{ $branches->branch_email }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                                    >
                                                        {{ $branches->branch_phone }}
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                                    >
                                                        <div
                                                            class="mr-2 w-4 transform hover:scale-110 hover:text-blue-700"
                                                        >
                                                            <x-headerform.eyeoption
                                                                wire:key="{{ $branches->id }}"
                                                                wire:click.prevent="dataBranch({{ $branches->id }})"
                                                                wire:target="idBranch"
                                                            ></x-headerform.eyeoption>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
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
    @endif
</div>
