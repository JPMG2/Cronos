<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50"
     x-data="{
        activeTab: 'planes',
        switchTab(tab) {
            this.activeTab = tab;
        }
     }">
    <x-breadcrum breadcrumbs="Planes"></x-breadcrum>
    <x-company-watcher></x-company-watcher>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 relative">

        <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 backdrop-blur-sm">
            <x-headerform.borderheader></x-headerform.borderheader>

            <div class="px-6 py-6">
                <!-- Enhanced Title Section -->
                <div class="mb-6">
                    <x-formcomponent.headerformtitla iconname="prestador">
                        <x-slot:title>Planes de Seguro</x-slot:title>
                        <x-slot:subtitle>Configure planes, coberturas y asignaciones del seguro médico.
                        </x-slot:subtitle>
                        <x-formcomponent.titleindicator
                            wire:loading
                            wire:target="submitPrestadorPlan, openModalPrestadorPlan, planHandleMenuAction">
                        </x-formcomponent.titleindicator>
                    </x-formcomponent.headerformtitla>
                </div>

                <!-- Tab Navigation -->
                <div class="mb-8">
                    <nav
                        class="flex space-x-1 bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 rounded-lg p-1"
                        aria-label="Tabs">
                        <!-- Planes Tab -->
                        <x-buttons.tabs.tab-button
                            icon="planes"
                            @click="switchTab('planes')"
                            buttoname='planes'
                        >
                            Planes
                        </x-buttons.tabs.tab-button>
                        <!-- Coberturas Tab -->
                        <x-buttons.tabs.tab-button
                            icon="cobertura"
                            @click="switchTab('coberturas')"
                            buttoname='coberturas'
                        >
                            Coberturas
                        </x-buttons.tabs.tab-button>
                        <!-- Asignaciones Tab -->
                        <x-buttons.tabs.tab-button
                            icon="asignacion"
                            @click="switchTab('asignaciones')"
                            buttoname='asignaciones'
                        >
                            Asignaciones
                        </x-buttons.tabs.tab-button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="space-y-6">
                    <!-- Planes Tab Content -->
                    <div x-show="activeTab === 'planes'" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <table
                            class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <x-table.thead>
                                <tr class="[&>th]:pb-1">
                                    <x-table.th>
                                        ID
                                    </x-table.th>
                                    <x-table.th
                                        wire:click="orderColumBy('insurance_plan_code')">
                                        <x-table.sortcolumn currentColumn="insurance_plan_code" :$sortField
                                                            :$sortDirection>
                                            <div> Código</div>
                                        </x-table.sortcolumn>
                                    </x-table.th>
                                    <x-table.th
                                        wire:click="orderColumBy('insurance_plan_name')">
                                        <x-table.sortcolumn currentColumn="insurance_plan_name" :$sortField
                                                            :$sortDirection>
                                            <div> Plan</div>
                                        </x-table.sortcolumn>
                                    </x-table.th>
                                    <x-table.th
                                        wire:click="orderColumBy('insurance_name')">
                                        <x-table.sortcolumn currentColumn="insurance_name" :$sortField
                                                            :$sortDirection>
                                            <div> Prestador</div>
                                        </x-table.sortcolumn>
                                    </x-table.th>
                                    <x-table.th>
                                        Estatus
                                    </x-table.th>
                                    <x-table.th>
                                        Coberturas
                                    </x-table.th>
                                    <x-table.th>

                                    </x-table.th>
                                    <x-table.th>
                                        <button
                                            type="button"
                                            wire:click="openModalPrestadorPlan"
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500 transition-all duration-200 shadow-sm whitespace-nowrap"
                                        >

                                            <span>Nuevo Plan</span>
                                        </button>
                                    </x-table.th>
                                </tr>
                                <tr class="-mt-3 [&>td]:pt-0">
                                    <td></td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-20"
                                            maxlength="5"
                                            x-mask=""
                                            wire:model.live.debounce="columnFilter.insurance_plan_code"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-32"
                                            maxlength="10"
                                            x-mask=""
                                            wire:model.live.debounce="columnFilter.insurance_plan_name"/>
                                    </td>
                                    <td>
                                        <x-table.input-table-search
                                            withd="w-36"
                                            maxlength="10"
                                            x-mask=""
                                            wire:model.live.debounce="columnFilter.insurance_name"/>
                                    </td>
                                </tr>
                            </x-table.thead>
                            <x-table.tablebody>
                                @if(count($listPlanesPrestador) > 0)
                                    @foreach($listPlanesPrestador as $listPrestador)
                                        <tr
                                            class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-200 even:bg-gray-50/50 hover:shadow-sm dark:even:bg-gray-800/30 dark:hover:bg-gradient-to-r dark:hover:from-gray-700/30 dark:hover:to-gray-600/20"
                                            wire:key="{{ $listPrestador->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $listPrestador->id  }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                                {{ $listPrestador->insurance_plan_code }}
                                            </x-table.tdtable>
                                            <x-table.tdtable whitespace-nowrap>
                                                {{ $listPrestador->insurance_plan_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable whitespace-nowrap>
                                                {{ $listPrestador->insurance->insurance_name }}
                                            </x-table.tdtable>
                                            <x-table.tdtable whitespace-nowrap>
                                                <x-statescolor
                                                    idstatecolor="{{ $listPrestador->state->id }}"
                                                >
                                                    {{ $listPrestador->state->state_name }}
                                                </x-statescolor>
                                            </x-table.tdtable>
                                            <x-table.tdtable whitespace-nowrap
                                                             class="text-center">
                                                {{'0'}}
                                            </x-table.tdtable>
                                            <td colspan="2"
                                                class="flex items-center text-center break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300">
                                                <div>
                                                    <x-table.accionopcion
                                                        wire:key="{{ $listPrestador->id }}"
                                                        wire:click.prevent="openModalPrestadorPlan({{ $listPrestador->id  }})"
                                                        wire:target="openModalPrestadorPlan"
                                                        iconname="edit"
                                                    ></x-table.accionopcion>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="py-4">
                                            <x-alert windowtype="error">
                                                No existen planes registrados.
                                            </x-alert>
                                        </td>
                                    </tr>
                                @endif
                            </x-table.tablebody>
                        </table>
                        <div class="mt-2 mb-2 justify-end mx-2">
                            {{ $listPlanesPrestador->links() }}
                        </div>
                    </div>
                    <!-- End Planes Tab Content -->

                    <!-- Coberturas Tab Content -->
                    <div x-show="activeTab === 'coberturas'" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <x-formcomponent.formdivcontent
                            dstyle="from-blue-50 ring-blue-200 hover:from-blue-100 hover:to-blue-50 focus-within:from-blue-100 focus-within:to-blue-50">
                            <x-formcomponent.h3divtitle iconname="prestador">
                                Configuración de Coberturas
                            </x-formcomponent.h3divtitle>
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <!-- Medical Services Coverage -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900">Servicios Médicos</h4>
                                    <div class="space-y-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.consultation"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Consultas Médicas</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.emergency"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Emergencias</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.hospitalization"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Hospitalización</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.surgery"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Cirugías</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Diagnostic Coverage -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900">Diagnósticos</h4>
                                    <div class="space-y-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.laboratory"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Laboratorio</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.radiology"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Radiología</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.imaging"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Imagenología</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="form.coverage.pharmacy"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">Farmacia</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Coverage Percentages -->
                            <div class="mt-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Porcentajes de Cobertura</h4>
                                <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Consulta General (%)"
                                            for="general_consultation_percent"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.coverage.general_consultation_percent"
                                                id="general_consultation_percent"
                                                type="number"
                                                min="0"
                                                max="100"
                                                placeholder="80"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Especialista (%)"
                                            for="specialist_percent"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.coverage.specialist_percent"
                                                id="specialist_percent"
                                                type="number"
                                                min="0"
                                                max="100"
                                                placeholder="70"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Hospitalización (%)"
                                            for="hospitalization_percent"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.coverage.hospitalization_percent"
                                                id="hospitalization_percent"
                                                type="number"
                                                min="0"
                                                max="100"
                                                placeholder="90"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Farmacia (%)"
                                            for="pharmacy_percent"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.coverage.pharmacy_percent"
                                                id="pharmacy_percent"
                                                type="number"
                                                min="0"
                                                max="100"
                                                placeholder="60"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                            </div>
                        </x-formcomponent.formdivcontent>
                    </div>

                    <!-- Asignaciones Tab Content -->
                    <div x-show="activeTab === 'asignaciones'" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <x-formcomponent.formdivcontent
                            dstyle="from-purple-50 ring-purple-200 hover:from-purple-100 hover:to-purple-50 focus-within:from-purple-100 focus-within:to-purple-50">
                            <x-formcomponent.h3divtitle iconname="prestador">
                                Asignaciones del Plan
                            </x-formcomponent.h3divtitle>
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <!-- Network Assignment -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900">Red de Prestadores</h4>
                                    <div class="space-y-3">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Prestador Principal"
                                                for="main_provider"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model="form.assignments.main_provider_id"
                                                    id="main_provider"
                                                >
                                                    <option value="">Seleccionar prestador...</option>
                                                    {{-- @foreach ($providers as $provider)
                                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                    @endforeach --}}
                                                </x-inputs.selectinput>
                                            </x-inputs.selectgroup>
                                        </div>
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Red de Hospitales"
                                                for="hospital_network"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model="form.assignments.hospital_network_id"
                                                    id="hospital_network"
                                                >
                                                    <option value="">Seleccionar red...</option>
                                                    {{-- @foreach ($hospitalNetworks as $network)
                                                        <option value="{{ $network->id }}">{{ $network->name }}</option>
                                                    @endforeach --}}
                                                </x-inputs.selectinput>
                                            </x-inputs.selectgroup>
                                        </div>
                                    </div>
                                </div>

                                <!-- Medical Team Assignment -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900">Equipo Médico</h4>
                                    <div class="space-y-3">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Médico de Cabecera"
                                                for="primary_doctor"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model="form.assignments.primary_doctor_id"
                                                    id="primary_doctor"
                                                >
                                                    <option value="">Seleccionar médico...</option>
                                                    {{-- @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->full_name }}</option>
                                                    @endforeach --}}
                                                </x-inputs.selectinput>
                                            </x-inputs.selectgroup>
                                        </div>
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Especialistas Asignados"
                                                for="assigned_specialists"
                                            >
                                                <select
                                                    wire:model="form.assignments.specialist_ids"
                                                    id="assigned_specialists"
                                                    multiple
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                >
                                                    {{-- @foreach ($specialists as $specialist)
                                                        <option value="{{ $specialist->id }}">Dr. {{ $specialist->full_name }} - {{ $specialist->specialty }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </x-inputs.selectgroup>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Assignment Rules -->
                            <div class="mt-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Reglas de Asignación</h4>
                                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                                    <div class="relative">
                                        <x-inputs.selectgroup
                                            label="Tipo de Autorización"
                                            for="authorization_type"
                                        >
                                            <x-inputs.selectinput
                                                wire:model="form.assignments.authorization_type"
                                                id="authorization_type"
                                            >
                                                <option value="">Seleccionar...</option>
                                                <option value="automatic">Automática</option>
                                                <option value="manual">Manual</option>
                                                <option value="pre_approval">Pre-aprobación</option>
                                            </x-inputs.selectinput>
                                        </x-inputs.selectgroup>
                                    </div>
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Límite de Referidos"
                                            for="referral_limit"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.assignments.referral_limit"
                                                id="referral_limit"
                                                type="number"
                                                min="1"
                                                placeholder="5"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Días Válidos"
                                            for="valid_days"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.assignments.valid_days"
                                                id="valid_days"
                                                type="number"
                                                min="1"
                                                placeholder="30"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                            </div>
                        </x-formcomponent.formdivcontent>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Component -->
    <livewire:convenio.modal-prestador-plan/>
</div>
