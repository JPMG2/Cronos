@php use Carbon\Carbon; @endphp
<div>
    <x-breadcrum breadcrumbs="Servicios"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>

        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Servicios
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryService, openservice, infoService">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                @if (count($this->services) > 0)
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
                                        Código
                                    </x-table.th>
                                    <x-table.th>
                                        Servicio
                                    </x-table.th>
                                    <x-table.th>
                                        Descripción
                                    </x-table.th>
                                    <x-table.th>
                                        Creado
                                    </x-table.th>
                                    <x-table.th></x-table.th>
                                </tr>
                            </x-table.thead>
                            <x-table.tablebody>
                                @foreach ($this->services as $service)
                                    <tr
                                        class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-200 even:bg-gray-50/50 hover:shadow-sm dark:even:bg-gray-800/30 dark:hover:bg-gradient-to-r dark:hover:from-gray-700/30 dark:hover:to-gray-600/20"
                                        wire:key="{{ $service->id }}"
                                    >
                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            <div
                                                class="inline-flex items-center gap-x-3"
                                            >
                                                <span>
                                                    {{ $service->id }}
                                                </span>
                                            </div>
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            {{ $service->service_code }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            {{ $service->service_name }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>

                                            {{ $service->service_description}}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            {{ Carbon::parse($service->created_at)->format("d/m/Y") }}
                                        </x-table.tdtable>
                                        <td
                                            class="flex items-center break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $service->id }}"
                                                    wire:click.prevent="infoService({{ $service }})"
                                                    wire:target="infoService"
                                                    iconname="edit"
                                                ></x-table.accionopcion>
                                            </div>
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $service->id }}"
                                                    wire:click.prevent="deleteDepartment({{ $service }})"
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
                        No existen servicios registrados.
                    </x-alert>
                @endif
            </div>
            @if(!session("isdisabled"))
                <x-butonbutton wire:click="$toggle('openservice')  "></x-butonbutton>
                <!-- Modal -->
                <div x-data="{ open: @entangle('openservice') }">
                    <x-rightmodal
                        style="display: none"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        closemodal="openservice"
                        withmodal="w-[32rem]"
                    >
                        <x-slot:title>Registro</x-slot>

                        <div class="mt-2 grid grid-cols-1 lg:grid-cols-8 gap-y-3 gap-x-2">
                            <div class="relative col-span-3">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Código"
                                        for="depacodi"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.dataservice.service_code"
                                            id="depacodi"
                                            autocomplete="off"
                                            maxlength="6"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('service_code')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("service_code")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                            <div class="relative col-span-5">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Servicio"
                                        for="servname"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.dataservice.service_name"
                                            id="servname"
                                            autocomplete="off"
                                            maxlength="100"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('service_name')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("service_name")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>

                            <div class="relative col-span-8">
                                <x-autocomplete.inputautocomplete
                                    label="Categoría"
                                    placeholder="buscar..."
                                    wire-model="form.dataservice.categori_name"
                                    wire-id-model="form.dataservice.category_id"
                                    :items="$listCategory"
                                    display-field="categori_name"
                                    value-field="id"
                                    :required="true"
                                />
                                @error("category_id")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                            <div class="relative col-span-8 ">
                                <x-inputs.labeltextarea
                                    label="Descripción"
                                    for="descriprole"
                                    required="yes"
                                >
                                    <x-inputs.textarea
                                        wire:model="form.dataservice.service_description"
                                        id="descriprole"
                                        rows="3"
                                    ></x-inputs.textarea>
                                </x-inputs.labeltextarea>

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
                                        wire:submit.prevent="queryService"
                                        wire:click.prevent="queryService"
                                        namefucion="queryService"
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
