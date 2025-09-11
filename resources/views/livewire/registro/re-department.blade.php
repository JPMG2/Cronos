@php use Carbon\Carbon; @endphp
<div>
    <x-breadcrum breadcrumbs="Departamentos"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Departamentos
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryDepa, openDepartment">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                @if (count($this->departments) > 0)
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200/50 shadow-lg ring-1 ring-gray-200/20 dark:border-gray-700/50 dark:ring-gray-700/20 dark:shadow-black/10"
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
                                        Departamento
                                    </x-table.th>
                                    <x-table.th class="hidden md:table-cell">
                                        Código
                                    </x-table.th>
                                    <x-table.th class="hidden md:table-cell">
                                        Creado
                                    </x-table.th>
                                    <x-table.th></x-table.th>


                                </tr>
                            </x-table.thead>
                            <x-table.tablebody>
                                @foreach ($this->departments as $depa)
                                    <tr
                                        class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-200 even:bg-gray-50/50 hover:shadow-sm dark:even:bg-gray-800/30 dark:hover:bg-gradient-to-r dark:hover:from-gray-700/30 dark:hover:to-gray-600/20"
                                        wire:key="{{ $depa->id }}"
                                    >
                                        <td
                                            class="whitespace-nowrap px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-200"
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
                                            class="whitespace-nowrap px-3 py-1.5 text-sm font-medium text-gray-700"
                                        >
                                            {{ $depa->department_name }}
                                        </td>
                                        <td
                                            class="hidden md:table-cell break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            {{ $depa->department_code }}
                                        </td>
                                        <td
                                            class="hidden md:table-cell break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            {{ Carbon::parse($depa->created_at)->format("d/m/Y") }}
                                        </td>
                                        <td
                                            class="flex items-center break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $depa->id }}"
                                                    wire:click.prevent="editDepartment({{ $depa }})"
                                                    wire:target="editDepartment"
                                                    iconname="edit"
                                                ></x-table.accionopcion>
                                            </div>
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $depa->id }}"
                                                    wire:click.prevent="deleteDepartment({{ $depa }})"
                                                    wire:target="deleteDepartment"
                                                    iconname="delete"
                                                    isDelete="isDelete"
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
                        No existen departamentos registrados.
                    </x-alert>
                @endif
            </div>
            @if(!session("isdisabled"))
                <x-butonbutton wire:click="$toggle('opendepartment')  "></x-butonbutton>
                <!-- Modal -->
                <div x-data="{ open: @entangle('opendepartment') }">
                    <x-rightmodal
                        style="display: none"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        closemodal="opendepartment"
                    >
                        <x-slot:title>Registro</x-slot>

                        <div class="mt-2 grid grid-cols-1 gap-4">
                            <div class="relative sm:col-span-1">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Departamento"
                                        for="depaname"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.datadeparment.department_name"
                                            id="depaname"
                                            autocomplete="off"
                                            maxlength="100"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('department_name')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("department_name")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                            <div class="relative sm:col-span-1">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Código"
                                        for="depacodi"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.datadeparment.department_code"
                                            id="depacodi"
                                            autocomplete="off"
                                            maxlength="10"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('department_code')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("department_code")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                        </div>
                        <x-slot:buttons>
                            <form id="departamento" wire:submit.prevent="submit">
                                @csrf

                                <x-headerform.button-group>
                                    <x-buttons.close wire:click="clearForm">
                                        {{ __("Cerrar") }}
                                    </x-buttons.close>
                                    <x-buttons.cancel
                                        wire:click="clearForm"
                                        label="Cancelar"
                                    ></x-buttons.cancel>
                                    <x-buttons.save
                                        wire:submit.prevent="queryDeparmente"
                                        wire:click.prevent="queryDeparmente"
                                        namefucion="queryDeparmente"
                                        label="Guardar"
                                        isdisabled="{{$isdisabled}}"
                                        :error="count($errors)"
                                    ></x-buttons.save>
                                </x-headerform.button-group>

                            </form>
                        </x-slot:buttons>
                    </x-rightmodal>
                </div>
            @endif
        </div>
    </div>
</div>
