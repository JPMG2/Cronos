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
                    <x-formcomponent.modaltitle>Especialistas.</x-formcomponent.modaltitle>
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
                                    @foreach($listForm->tableHeaders as $header)
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
                                @if(count($listMedical) > 0)
                                    @foreach($listMedical as $medical)
                                        <tr
                                            class="even:bg-gray-100"
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
