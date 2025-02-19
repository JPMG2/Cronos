<div
    x-data="{ show: @entangle("show") }"
    x-init="$watch('show', (value) => console.log(value))"
>
    <div
        x-show="show"
        class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center bg-black bg-opacity-70"
        x-transition.opacity
        x-transition.duration.300ms
        x-cloak
    >
        <div class="m-3 mx-auto mt-11 size-6/12">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70"
            >
                <div
                    class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700"
                >
                    <x-formcomponent.modaltitle>Tipos.</x-formcomponent.modaltitle>
                    <button
                        wire:click="$set('show', false)"
                        type="button"
                        class="flex size-7 items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <x-close-modal></x-close-modal>
                    </button>
                </div>
                <div class="overflow-y-auto p-4">
                    <div class="mt-2 grid grid-cols-1 gap-x-2">
                        <div class="relative sm:col-span-5">
                            <div class="relative">
                                <x-inputs.textgroup
                                    label="Nombre"
                                    for="insurancetypename"
                                    required="yes"
                                >
                                    <x-inputs.textinput
                                        wire:model="formtype.insuratypedata.insuratype_name"
                                        id="insurancetypename"
                                        autocomplete="off"
                                        maxlength="220"
                                        placeholder=" "
                                        isdisabled=""
                                        required="yes"
                                        :error="$errors->first('insuratype_name')"
                                    ></x-inputs.textinput>
                                </x-inputs.textgroup>
                            </div>
                            @error("insuratype_name")
                            <x-inputs.error-validate>
                                {{ $message }}
                            </x-inputs.error-validate>
                            @enderror
                        </div>
                    </div>

                    @if (count($this->types) > 0)
                        <div
                            class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700 mt-1"
                        >
                            <table
                                class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                            >
                                <x-table.thead>
                                    <tr>
                                        <x-table.th>ID</x-table.th>
                                        <x-table.th>Tipo</x-table.th>
                                        <x-table.th></x-table.th>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($this->types as $types)
                                        <tr
                                            class="even:bg-gray-100"
                                            wire:key="{{ $types->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>

                                            <x-table.tdtable typetext="txtnormal" break-words>
                                                {{ $types->insuratype_name }}
                                            </x-table.tdtable>

                                            <td
                                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700"
                                            >
                                                <div
                                                    class="flex items-center justify-center gap-x-1"
                                                >
                                                    <x-table.accionopcion
                                                        wire:click="insuranceInfo({{ $types->id }})"
                                                        iconname="edit"
                                                    ></x-table.accionopcion>
                                                    <x-table.accionopcion
                                                        wire:click="deleteType({{ $types->id }})"
                                                        iconname="delete"
                                                    ></x-table.accionopcion>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                        </div>
                    @else
                        <x-alert windowtype="error">
                            No existen registros.
                        </x-alert>
                    @endif

                </div>
                <div
                    class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700"
                >
                    <form wire:submit.prevent="queryInsuraceType">
                        @csrf
                        <x-headerform.button-group>
                            <x-buttons.close wire:click="$set('show', false)">
                                {{ __("Cerrar") }}
                            </x-buttons.close>
                            <x-buttons.cancel
                                wire:click="clearFormChild"
                                label="Cancelar"
                            ></x-buttons.cancel>

                            <x-buttons.save
                                wire:submit.prevent="queryInsuraceType"
                                wire:click.prevent="queryInsuraceType"
                                label="Guardar"
                                :error="count($errors)"
                            ></x-buttons.save>
                        </x-headerform.button-group>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
