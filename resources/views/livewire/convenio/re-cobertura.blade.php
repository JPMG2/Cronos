<div class="space-y-4">
    {{-- TOP SECTION: Insurance Plan Information (Horizontal) --}}
    <livewire:convenio.plan-info-card :planId="$planId" wire:snapshot/>
    {{-- END SECTION: Insurance Plan Information (Horizontal) --}}

    {{-- BOTTOM SECTION: Two Columns --}}
    <div class="grid grid-cols-12 gap-4" x-data="{
        selectedService: null,
        editingService: null,
        expandedGroups: []
    }">

        {{-- LEFT COLUMN: Service Search & List (6 columns) --}}
        <div class="col-span-6 rounded-xl bg-white shadow-lg ring-1 ring-slate-200 overflow-hidden">
            {{-- Bulk Operations Toolbar --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 border-b border-blue-200">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-blue-700 bg-white border border-blue-300 rounded-lg hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 transition-all shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Bulk Add Services
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-indigo-700 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Clonar Plan
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all"
                            title="Export to Excel"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all"
                            title="Import from Excel"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Import
                        </button>
                    </div>
                </div>
            </div>

            {{-- Multi-Select Services Section --}}
            <div class="bg-gradient-to-r from-slate-50 to-white p-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Seleccione los servicios que desea configurar
                </h3>

                {{-- Multi-Select Component --}}
                <x-multi-select-checkbox
                    wire:model="selectedServices"
                    :options="$this->allServices"
                    placeholder="Seleccione servicios..."
                    searchPlaceholder="Buscar servicios..."
                    selectAllText="Seleccionar todos"
                    maxHeight="350px"
                />
            </div>

            {{-- Hierarchical Tree View --}}
            <div class="overflow-y-auto" style="max-height: 500px;">
                {{-- Empty State --}}
                @if(empty($selectedServices))
                    <div class="flex flex-col items-center justify-center h-64 text-slate-400">
                        <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <p class="text-lg font-medium">No hay servicios seleccionados</p>
                        <p class="text-sm mt-1">Seleccione los servicios para configurar la cobertura</p>
                    </div>
                @else
                    {{-- Hierarchical Tree View --}}
                    <div class="divide-y divide-slate-100">
                        @foreach($this->selectedServicesData as $service)
                            @if($service->type->value === 'group')
                                {{-- GROUP SERVICE --}}
                                <div class="bg-gradient-to-r from-indigo-50 to-white border-l-4 border-indigo-400">
                                    {{-- Group Header --}}
                                    <div
                                        class="flex items-center gap-1 px-4 py-3 cursor-pointer hover:bg-indigo-100 transition-all"
                                        @click="expandedGroups.includes({{ $service->id }}) ?
                                                 expandedGroups = expandedGroups.filter(id => id !== {{ $service->id }}) :
                                                 expandedGroups.push({{ $service->id }})"
                                    >
                                        {{-- Expand/Collapse Icon --}}
                                        <svg
                                            class="w-4 h-4 text-indigo-600 transform transition-transform duration-200 flex-shrink-0"
                                            :class="{ 'rotate-90': expandedGroups.includes({{ $service->id }}) }"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5l7 7-7 7"></path>
                                        </svg>

                                        {{-- Group Icon --}}
                                        <svg class="w-4 h-4 text-indigo-600 flex-shrink-0" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>

                                        {{-- Service Code --}}
                                        <div class="w-16 flex-shrink-0">
                                            <span
                                                class="text-xs font-semibold text-indigo-900">{{ $service->service_code }}</span>
                                        </div>

                                        {{-- Group Name & Badge --}}
                                        <div class="flex-1 min-w-0 flex items-center justify-between gap-2">
                                            <span
                                                class="text-sm font-semibold text-slate-800 break-words">{{ $service->service_name }}</span>
                                            <span
                                                class="px-2 py-0.5 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full whitespace-nowrap flex-shrink-0">
                                                ({{ $service->children_count }} servicios)
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Child Services (Nested) --}}
                                    <div x-show="expandedGroups.includes({{ $service->id }})"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                                         x-transition:enter-end="opacity-100 transform translate-y-0"
                                         class="bg-white">
                                        @foreach($service->children as $child)
                                            <div
                                                class="flex items-center gap-2 pl-6 pr-2 py-2 border-t border-slate-100 hover:bg-blue-50 transition-all cursor-pointer"
                                                :class="selectedService === {{ $child->id }} ? 'bg-blue-100 ring-2 ring-inset ring-blue-400' : ''"
                                                @click="selectedService = {{ $child->id }}"
                                            >
                                                {{-- Child Icon --}}
                                                <div class="flex-shrink-0">
                                                    <svg class="w-4 h-4 text-slate-400" fill="none"
                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>

                                                {{-- Service Code --}}
                                                <div class="w-20 flex-shrink-0">
                                                    <span
                                                        class="text-xs font-medium text-slate-900">{{ $child->service_code }}</span>
                                                </div>

                                                {{-- Service Name --}}
                                                <div class="flex-1 min-w-0">
                                                    <span
                                                        class="text-xs text-slate-700 block truncate"
                                                        title="{{ $child->service_name }}">{{ $child->service_name }}</span>
                                                </div>

                                                {{-- Price Input --}}
                                                <div class="w-24 flex-shrink-0">
                                                    <div class="relative">
                                                        <span
                                                            class="absolute left-1.5 top-1.5 text-xs text-slate-500">$</span>
                                                        <x-inputs.money-input disabled
                                                                              :value="moneyToInput($child->base_price)"/>
                                                    </div>
                                                </div>

                                                {{-- Config Button --}}
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 flex-shrink-0 flex justify-center">
                                                        <x-buttons.small-config
                                                            wire:click="configCoverageService({{ $child->id }})"
                                                            @click.stop="selectedService = {{ $child->id }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                {{-- FINAL SERVICE (no children) --}}
                                <div
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition-all cursor-pointer"
                                    :class="selectedService === {{ $service->id }} ? 'bg-blue-100 ring-2 ring-inset ring-blue-400' : ''"
                                    @click="selectedService = {{ $service->id }}"
                                >
                                    {{-- Service Icon --}}
                                    <div class="w-8 flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>

                                    {{-- Service Code --}}
                                    <div class="flex-shrink-0">
                                        <span
                                            class="text-xs font-medium text-slate-900">{{ $service->service_code }}</span>
                                    </div>

                                    {{-- Service Name --}}
                                    <div class="flex-1 min-w-0 pl-2 pr-3">
                                        <span
                                            class="text-xs text-slate-700 block truncate"
                                            title="{{ $service->service_name }}">{{ $service->service_name }}</span>
                                    </div>

                                    {{-- Price Input --}}
                                    <div class="w-24 flex-shrink-0">
                                        <div class="relative">
                                            <span class="absolute left-1.5 top-1.5 text-xs text-slate-500">$</span>
                                            <x-inputs.money-input disabled :value="moneyToInput($service->base_price)"/>
                                        </div>
                                    </div>

                                    {{-- Config Button --}}
                                    <div class="w-10 flex-shrink-0 flex justify-center">
                                        <x-buttons.small-config
                                            wire:click="configCoverageService({{ $service->id }})"
                                            @click.stop="selectedService = {{ $service->id }}"/>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT COLUMN: Service Coverage Details (6 columns) --}}
        <div class="col-span-6 rounded-xl bg-white shadow-lg ring-1 ring-slate-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-50 to-white p-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Coverage Details
                </h3>
            </div>

            {{-- Details Form --}}
            <livewire:convenio.plan-coverage-config/>
        </div>
    </div>
</div>
