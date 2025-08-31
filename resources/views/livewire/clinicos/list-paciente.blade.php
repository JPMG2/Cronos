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
                                @if(count($listPatients) > 0)
                                    @foreach ($listPatients as $patiente)
                                        <tr
                                            class="even:bg-gray-100 w-4"
                                            wire:key="{{ $patiente->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->documentInfo }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->person_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->person_lastname }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->gender?->gender_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->person_phone }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{$patiente->person->person_email }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                                <div
                                                    class="mr-2 w-4 transform hover:scale-110 hover:text-blue-700"
                                                >
                                                    <x-headerform.eyeoption
                                                        wire:key="{{ $patiente->id }}"
                                                        wire:click.prevent="patientId({{ $patiente->id }})"
                                                    ></x-headerform.eyeoption>
                                                </div>
                                            </x-table.tdtable>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="py-4">
                                            <x-alert windowtype="error">
                                                No existen pacientes registrados.
                                            </x-alert>
                                        </td>
                                    </tr>
                                @endif
                            </x-table.tablebody>

                        </table>
                        <div class="mt-2 mb-2 justify-end mx-2">
                            {{ $listPatients->links() }}
                        </div>
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
