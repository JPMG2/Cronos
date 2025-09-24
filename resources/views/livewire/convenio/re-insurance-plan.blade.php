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
                            wire:target="submitPlan,planHandleMenuAction">
                        </x-formcomponent.titleindicator>
                    </x-formcomponent.headerformtitla>
                </div>

                <!-- Tab Navigation -->
                <div class="mb-8">
                    <nav
                        class="flex space-x-1 bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 rounded-lg p-1"
                        aria-label="Tabs">
                        <!-- Planes Tab -->
                        <button
                            @click="switchTab('planes')"
                            :class="activeTab === 'planes'
                                ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300'
                                : 'bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50 text-slate-600'"
                            class="flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Planes
                        </button>
                        <!-- Coberturas Tab -->
                        <button
                            @click="switchTab('coberturas')"
                            :class="activeTab === 'coberturas'
                                ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300'
                                : 'bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50 text-slate-600'"
                            class="flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Coberturas
                        </button>
                        <!-- Asignaciones Tab -->
                        <button
                            @click="switchTab('asignaciones')"
                            :class="activeTab === 'asignaciones'
                                ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300'
                                : 'bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50 text-slate-600'"
                            class="flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Asignaciones
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="space-y-6">
                    <!-- Planes Tab Content -->
                    <div x-show="activeTab === 'planes'" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <x-formcomponent.formdivcontent
                            dstyle="from-slate-50 ring-slate-200 hover:from-slate-100 hover:to-slate-50 focus-within:from-slate-100 focus-within:to-slate-50">
                            <x-formcomponent.h3divtitle iconname="prestador">
                                Información del Plan
                            </x-formcomponent.h3divtitle>
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 xl:gap-4">
                                <div class="relative w-full col-span-6">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Nombre del Plan"
                                            for="plan_name"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.plan_name"
                                                id="plan_name"
                                                autocomplete="off"
                                                maxlength="200"
                                                placeholder=" "
                                                required
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Código del Plan"
                                            for="plan_code"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.plan_code"
                                                id="plan_code"
                                                autocomplete="off"
                                                maxlength="50"
                                                placeholder=" "
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.selectgroup
                                            label="Estado"
                                            for="plan_status"
                                            required="yes"
                                        >
                                            <x-inputs.selectinput
                                                wire:model="form.planData.status_id"
                                                id="plan_status"
                                            >
                                                <option value="">Seleccionar...</option>
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </x-inputs.selectinput>
                                        </x-inputs.selectgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-12">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Descripción"
                                            for="plan_description"
                                        >
                                            <textarea
                                                wire:model="form.planData.plan_description"
                                                id="plan_description"
                                                rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                placeholder="Descripción del plan..."
                                            ></textarea>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                            </div>
                        </x-formcomponent.formdivcontent>

                        <x-formcomponent.formdivcontent
                            dstyle="from-green-50 ring-green-200 hover:from-green-100 hover:to-green-50 focus-within:from-green-100 focus-within:to-green-50">
                            <x-formcomponent.h3divtitle iconname="prestador">
                                Información Financiera
                            </x-formcomponent.h3divtitle>
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 xl:gap-4">
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Costo Mensual"
                                            for="monthly_cost"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.monthly_cost"
                                                id="monthly_cost"
                                                type="number"
                                                step="0.01"
                                                placeholder="0.00"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Deducible"
                                            for="deductible"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.deductible"
                                                id="deductible"
                                                type="number"
                                                step="0.01"
                                                placeholder="0.00"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Copago"
                                            for="copay"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.copay"
                                                id="copay"
                                                type="number"
                                                step="0.01"
                                                placeholder="0.00"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Límite Cobertura"
                                            for="coverage_limit"
                                        >
                                            <x-inputs.textinput
                                                wire:model="form.planData.coverage_limit"
                                                id="coverage_limit"
                                                type="number"
                                                step="0.01"
                                                placeholder="0.00"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                </div>
                            </div>
                        </x-formcomponent.formdivcontent>
                    </div>

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

                <!-- Form Actions -->
                <div class="mt-8 border-t border-slate-200 pt-6">
                    <form wire:submit.prevent="submitPlan">
                        @csrf
                        <div class="flex flex-col items-center justify-center gap-2 sm:flex-row sm:gap-6">
                            <x-buttons.cancel
                                wire:click="clearForm"
                                label="Cancelar"
                            ></x-buttons.cancel>
                            <x-buttons.save
                                wire:click.prevent="submitPlan"
                                label="Guardar Plan"
                                isdisabled="false"
                                :error="0"
                            ></x-buttons.save>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
