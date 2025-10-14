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
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:loading wire:target="queryService, openservice, infoService">
                </x-formcomponent.titleindicator>
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
                                        Categoría
                                    </x-table.th>
                                    <x-table.th>
                                        Estatus
                                    </x-table.th>
                                    <x-table.th>
                                        Sub-servicios
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
                                            {{ $service->category->categori_name}}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            <x-statescolor
                                                idstatecolor="{{$service->state->id }}"
                                            >
                                                {{$service->state->state_name }}
                                            </x-statescolor>
                                        </x-table.tdtable>
                                        <x-table.tdtable class="text-center" typetext="txtnormal" whitespace-nowrap>
                                            <span
                                                class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-xs font-semibold text-white shadow-sm ring-2 ring-blue-100 transition-all duration-200 hover:shadow-md hover:ring-blue-200">
                                                {{ $service->childrenCount }}
                                            </span>
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
                                                    wire:click.prevent="infoService({{ $service->id  }})"
                                                    wire:target="infoService"
                                                    iconname="edit"
                                                ></x-table.accionopcion>
                                            </div>
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $service->id }}"
                                                    wire:click.prevent="deleteDepartment({{ $service->id }})"
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
                <div x-data="{
                    open: @entangle('openservice'),
                    currentStep: @entangle('currentStep')
                }"
                     @keydown.ctrl.enter.window="if (open && currentStep < 2) $wire.nextStep()"
                     @keydown.ctrl.shift.enter.window="if (open && currentStep > 1) $wire.previousStep()"
                     @keydown.escape.window="if (open) $wire.set('openservice', false)"
                >
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
                        withmodal="w-[56rem]"
                    >
                        <x-slot:title>Registro de Servicio</x-slot>

                        <!-- Keyboard Shortcuts Hint -->
                        <div class="mb-2 flex justify-end">
                            <div class="text-xs text-slate-500 bg-slate-50 rounded px-2 py-1 flex items-center gap-2">
                                <x-keyshorcut>Ctrl+Enter</x-keyshorcut>

                                Siguiente
                                <span class="mx-1">•</span>
                                <x-keyshorcut>Ctrl+Shift+Enter</x-keyshorcut>
                                Anterior
                                <span class="mx-1">•</span>
                                <x-keyshorcut>Esc</x-keyshorcut>
                                Cerrar
                            </div>
                        </div>

                        <!-- Step Indicator -->
                        <div class="mb-4 flex items-center justify-center space-x-2">
                            <div class="flex items-center">
                                <div @class([
                                    'flex h-8 w-8 items-center justify-center rounded-full text-xs font-semibold transition-all duration-300',
                                    'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300' => $currentStep >= 1,
                                    'bg-gradient-to-r from-slate-50 to-white text-slate-600' => $currentStep < 1,
                                ])>
                                    1
                                </div>
                                <span class="ml-2 text-xs font-medium text-slate-600">Básica</span>
                            </div>
                            <div class="h-0.5 w-12 bg-slate-200">
                                <div @class([
                                    'h-full transition-all duration-300',
                                    'bg-blue-400' => $currentStep >= 2,
                                    'w-0' => $currentStep < 2,
                                    'w-full' => $currentStep >= 2,
                                ])></div>
                            </div>
                            <div class="flex items-center">
                                <div @class([
                                    'flex h-8 w-8 items-center justify-center rounded-full text-xs font-semibold transition-all duration-300',
                                    'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300' => $currentStep >= 2,
                                    'bg-gradient-to-r from-slate-50 to-white text-slate-600' => $currentStep < 2,
                                ])>
                                    2
                                </div>
                                <span class="ml-2 text-xs font-medium text-slate-600">Configuración</span>
                            </div>
                        </div>

                        <!-- Side-by-Side Container -->
                        <div class="flex gap-3 transition-all duration-500">
                            <!-- Step 1: Basic Information (Left Panel) -->
                            <div
                                :class="currentStep === 2 ? 'w-1/2' : 'w-full'"
                                class="transition-all duration-500 ease-in-out"
                            >
                                <div
                                    class="rounded-lg bg-gradient-to-br from-blue-50/50 to-white p-3 shadow-sm ring-1 ring-blue-100">
                                    <h3 class="mb-3 text-sm font-semibold text-blue-900">
                                        <span
                                            class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 text-xs mr-2">1</span>
                                        Información Básica
                                    </h3>
                                    <div class="grid grid-cols-1 lg:grid-cols-8 gap-y-3 gap-x-2">
                                        <div :class="currentStep === 2 ? 'col-span-8' : 'col-span-3'"
                                             class="relative transition-all duration-300">
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
                                                        maxlength="15"
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
                                        <div :class="currentStep === 2 ? 'col-span-8' : 'col-span-5'"
                                             class="relative transition-all duration-300">
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

                                        <div class="relative col-span-6">
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
                                        <div class="relative w-full col-span-2">
                                            <div class="relative">
                                                <div class="relative">
                                                    <x-inputs.selectgroup
                                                        label="Estatus"
                                                        for="sericestate"
                                                        required="yes"
                                                    >
                                                        <x-inputs.selectinput
                                                            wire:model="form.dataservice.state_id"
                                                            id="sericestate"
                                                            isdisabled="{{$isdisabled}}"
                                                            :error="$errors->first('state_id')"
                                                        >
                                                            @foreach ($this->states as $state)
                                                                <option
                                                                    value="{{ $state->id }}"
                                                                >
                                                                    {{ $state->state_name }}
                                                                </option>
                                                            @endforeach
                                                        </x-inputs.selectinput>
                                                    </x-inputs.selectgroup>
                                                </div>
                                                @error("state_id")
                                                <x-inputs.error-validate>
                                                    {{ $message }}
                                                </x-inputs.error-validate>
                                                @enderror
                                            </div>
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
                                </div>
                            </div>

                            <!-- Step 2: Configuration (Right Panel - Slides in) -->
                            <div
                                x-show="currentStep === 2"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 transform translate-x-8"
                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="w-1/2"
                            >
                                <div
                                    class="rounded-lg bg-gradient-to-br from-indigo-50/50 to-white p-3 shadow-sm ring-1 ring-indigo-100">
                                    <h3 class="mb-3 text-sm font-semibold text-indigo-900">
                                        <span
                                            class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-xs mr-2">2</span>
                                        Configuración Avanzada
                                    </h3>
                                    <div class="grid grid-cols-1 lg:grid-cols-8 gap-y-3 gap-x-2">

                                        <div class="relative col-span-8">
                                            <x-inputs.textgroup label="Servicio Principal" for="fatherservic">
                                                <select
                                                    wire:model="form.dataservice.parent_service_id"
                                                    id="fatherservic"
                                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                >
                                                    <option label=" "></option>

                                                    @foreach($this->serviceGroup as $servicegroup)
                                                        <option value="{{ $servicegroup->id }}">
                                                            {{ $servicegroup->service_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </x-inputs.textgroup>
                                        </div>

                                        <div class="relative col-span-4">
                                            <x-inputs.textgroup label="Tipo" for="servtype">
                                                <select
                                                    wire:model="form.dataservice.type"
                                                    id="servtype"
                                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                >
                                                    @foreach(App\Enums\ServiceType::cases() as $type)
                                                        <option value="{{ $type->value }}">
                                                            {{ $type->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </x-inputs.textgroup>
                                        </div>

                                        <div class="relative col-span-4">
                                            <x-inputs.textgroup label="Duración Est. (minutos)" for="duration">
                                                <x-inputs.textinput
                                                    wire:model="form.dataservice.estimated_duration"
                                                    id="duration"
                                                    type="number"
                                                    min="0"
                                                    placeholder=""
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>

                                        <div class="relative col-span-4">
                                            <x-inputs.textgroup label="Máximo de ordenes por día" for="displayorder">
                                                <x-inputs.textinput
                                                    wire:model="form.dataservice.display_order"
                                                    id="displayorder"
                                                    type="number"
                                                    min="0"
                                                    placeholder=""
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>

                                        <div class="col-span-8 space-y-2">

                                            <div class="relative w-full col-span-2 ml-2 items-center">
                                                <div class="flex items-center space-x-10">
                                                    <div class="relative">
                                                        <input
                                                            wire:model="form.dataservice.requires_preparation"
                                                            id="reqpreparation"
                                                            type="checkbox"
                                                            value=""
                                                        ></div>
                                                    <x-simple-label for="reqpreparation"
                                                                    label="Requiere preparación previa">
                                                    </x-simple-label>
                                                </div>
                                            </div>


                                        </div>

                                        <div x-show="$wire.form.dataservice.requires_preparation"
                                             class="relative col-span-8">
                                            <x-inputs.labeltextarea label="Instrucciones de Preparación" for="prepinst">
                                                <x-inputs.textarea
                                                    wire:model="form.dataservice.preparation_instructions"
                                                    id="prepinst"
                                                    rows="3"
                                                    placeholder=""
                                                ></x-inputs.textarea>
                                            </x-inputs.labeltextarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-slot:buttons>
                            <form id="departamento" wire:submit.prevent="submit">
                                @csrf
                                <x-headerform.button-group>
                                    <x-buttons.close wire:click="$set('openservice', false)">
                                        {{ __("Cerrar") }}
                                    </x-buttons.close>

                                    @if($currentStep > 1)
                                        <button
                                            type="button"
                                            wire:click="previousStep"
                                            class="rounded-lg bg-gradient-to-r from-slate-50 to-white px-4 py-2 text-sm font-medium text-slate-600 transition-all duration-300 hover:from-slate-100 hover:to-slate-50"
                                        >
                                            Anterior
                                        </button>
                                    @endif

                                    @if($currentStep < 2)
                                        <button
                                            type="button"
                                            wire:click="nextStep"
                                            class="rounded-lg bg-gradient-to-r from-blue-100 to-blue-200 px-4 py-2 text-sm font-medium text-blue-700 transition-all duration-300 hover:from-blue-200 hover:to-blue-300"
                                        >
                                            Siguiente
                                        </button>
                                    @else
                                        <x-buttons.save
                                            wire:submit.prevent="queryService"
                                            wire:click.prevent="queryService"
                                            namefucion="queryService"
                                            label="Guardar"
                                            isdisabled="{{$isdisabled}}"
                                            :error="count($errors)"
                                        ></x-buttons.save>
                                    @endif
                                </x-headerform.button-group>
                            </form>
                        </x-slot:buttons>

                    </x-rightmodal>
                </div>
            @endif
        </div>
    </div>
</div>
