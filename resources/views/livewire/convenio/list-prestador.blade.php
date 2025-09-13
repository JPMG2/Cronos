<div wire:show="show">

    <div
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm overflow-auto p-4"
    >
        <div class="m-3 mx-auto mt-11 size-4/5">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-2xl dark:border-gray-600 dark:bg-gray-800 dark:shadow-2xl "
            >
                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-2 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl dark:border-gray-600 dark:from-gray-700 dark:to-gray-600"
                >
                    <x-formcomponent.modaltitle>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                  clip-rule="evenodd"/>
                        </svg>
                        Prestadores.
                    </x-formcomponent.modaltitle>
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
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200/50 shadow-lg ring-1 ring-gray-200/20 dark:border-gray-700/50 dark:ring-gray-700/20 dark:shadow-black/10"
                    >
                        <table
                            class="table-xs min-w-full divide-y divide-gray-200/80 dark:divide-gray-700/80"
                        >
                            <x-table.thead>
                                <tr class="sticky top-0 z-10 bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/70 dark:bg-gray-800/90 dark:supports-[backdrop-filter]:bg-gray-800/70">
                                    @foreach($form->tableHeaders as $header)
                                        @if( (bool) $header['isClickable'] !== false)
                                            <x-table.th
                                                wire:click="orderColumBy('{{$header['clickName']}}')">
                                                <x-table.sortcolumn currentColumn="{{$header['clickName']}}" :$sortField
                                                                    :$sortDirection>
                                                    <div> {{ $header['name'] }}</div>
                                                </x-table.sortcolumn>
                                            </x-table.th>
                                        @else
                                            <x-table.th>
                                                {{ $header['name'] }}
                                            </x-table.th>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr class="h-1 p-0 ">
                                    @foreach($form->tableHeaders as $header)
                                        @if( (bool) $header['isClickable'] !== false)
                                            <td>
                                                <x-table.input-table-search
                                                    withd="{{$header['with']}}"
                                                    maxlength="{{$header['max']}}"
                                                    x-mask="{{$header['mask']}}"
                                                    wire:model.live.debounce="columnFilter.{{$header['clickName']}}"/>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            </x-table.thead>
                            <x-table.tablebody>
                                @if(count($listPestador) > 0)
                                    @foreach ($listPestador as $prestador)
                                        <tr
                                            class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-200 even:bg-gray-50/50 hover:shadow-sm dark:even:bg-gray-800/30 dark:hover:bg-gradient-to-r dark:hover:from-gray-700/30 dark:hover:to-gray-600/20"
                                            wire:key="{{ $prestador->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$prestador->insurance_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$prestador->insurance_acronym }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$prestador->insuranceType->insuratype_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$prestador->insurance_code }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                <x-statescolor
                                                    idstatecolor="{{$prestador->state->id }}"
                                                >
                                                    {{$prestador->state->state_name }}
                                                </x-statescolor>
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                <div
                                                    class="mr-2 w-4 transform hover:scale-110 hover:text-blue-700"
                                                >
                                                    <x-headerform.eyeoption
                                                        wire:key="{{ $prestador->id }}"
                                                        wire:click.prevent="patientId({{ $prestador->id }})"
                                                    ></x-headerform.eyeoption>
                                                </div>
                                            </x-table.tdtable>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="py-4">
                                            <x-alert windowtype="error">
                                                No existen prestadores registrados.
                                            </x-alert>
                                        </td>
                                    </tr>
                                @endif
                            </x-table.tablebody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
