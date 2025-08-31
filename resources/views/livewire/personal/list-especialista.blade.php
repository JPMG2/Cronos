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
                        Especialistas.
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
                        class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
                    >

                        <table
                            class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <x-table.thead>

                                <tr class="h-2 p-0">
                                    @foreach($listForm->tableHeaders as $header)
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
                                <tr class="h-1 p-0 ">
                                    <td></td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-32"
                                            maxlength="10"
                                            x-mask="9999999999"
                                            wire:model.live.debounce="columnFilter.num_document"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-36"
                                            maxlength="10"
                                            x-mask="aaaaaaaaaa"
                                            wire:model.live.debounce="columnFilter.person_name"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            maxlength="10"
                                            x-mask="aaaaaaaaaa"
                                            wire:model.live.debounce="columnFilter.person_lastname"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-32"
                                            maxlength="10"
                                            x-mask="9999999999"
                                            wire:model.live.debounce="columnFilter.credential_number"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-32"
                                            maxlength="10"
                                            x-mask="aaaaaaaaaa"
                                            wire:model.live.debounce="columnFilter.specialty_name"/>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </x-table.thead>

                            <x-table.tablebody>
                                @if(count($listMedical) > 0)
                                    @foreach($listMedical as $medical)
                                        <tr
                                            class="hover:bg-blue-50 transition-colors duration-150 even:bg-gray-50 dark:even:bg-gray-700 dark:hover:bg-gray-600"
                                            wire:key="{{ $medical->id }}"
                                        >
                                            <x-table.tdtable
                                                typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $medical->person->documentInfo }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $medical->person->person_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $medical->person->person_lastname }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                @php
                                                    $firstCredential = $medical->credentials->first();
                                                      $credential = $firstCredential ? $firstCredential->credential_code : '-';
                                                      $numatricula = $medical->firstCredentialNumber;
                                                @endphp
                                                {{ $credential !== '-' && $numatricula !== '-' ? "$credential-$numatricula" : '-' }}
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
                                @else
                                    <tr>
                                        <td colspan="8" class="py-4">
                                            <x-alert windowtype="error">
                                                No existen especialistas registrados.
                                            </x-alert>
                                        </td>
                                    </tr>
                                @endif
                            </x-table.tablebody>
                        </table>
                        <div class="mt-2 mb-2 justify-end mx-2">
                            {{ $listMedical->links() }}
                        </div>

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
