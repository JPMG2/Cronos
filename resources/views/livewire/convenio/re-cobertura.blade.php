<div class="space-y-4">
    {{-- TOP SECTION: Insurance Plan Information (Horizontal) --}}
    <div class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-6">
        <div class="grid grid-cols-4 gap-6">
            <div>
                <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">Plan Code</p>
                <p class="mt-1 text-lg font-semibold text-blue-900">{{ $idPlan->insurance_plan_code ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">Plan Name</p>
                <p class="mt-1 text-lg font-semibold text-blue-900">{{ $idPlan->insurance_plan_name ?? 'Select a plan' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">Insurance</p>
                <p class="mt-1 text-lg font-semibold text-blue-900">{{ $idPlan->insurance->insurance_name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">Coverage Count</p>
                <div class="mt-1 flex items-center gap-2">
                    <p class="text-lg font-semibold text-blue-900">24</p>
                    <span class="text-xs text-blue-600">services covered</span>
                </div>
            </div>
        </div>
    </div>

    {{-- BOTTOM SECTION: Two Columns --}}
    <div class="grid grid-cols-12 gap-4" x-data="{ selectedService: null, editingService: null }">

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Bulk Add Services
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-indigo-700 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Copy from Plan
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all"
                            title="Export to Excel"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all"
                            title="Import from Excel"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Import
                        </button>
                    </div>
                </div>
            </div>

            {{-- Search/Filter Section --}}
            <div class="bg-gradient-to-r from-slate-50 to-white p-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search Services
                </h3>

                {{-- Search Input --}}
                <div class="relative mb-3">
                    <input
                        type="text"
                        placeholder="Search by service name or code..."
                        class="w-full px-4 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    />
                    <div class="absolute right-3 top-2.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Filter by Category --}}
                <div class="grid grid-cols-2 gap-3">
                    <select class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">All Categories</option>
                        <option value="1">Laboratory</option>
                        <option value="2">Imaging</option>
                        <option value="3">Surgery</option>
                        <option value="4">Consultation</option>
                    </select>
                    <select class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">All Services</option>
                        <option value="covered">Only Covered</option>
                        <option value="not_covered">Only Not Covered</option>
                    </select>
                </div>
            </div>

            {{-- Services Table --}}
            <div class="overflow-y-auto" style="max-height: 500px;">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 sticky top-0 z-10">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Code</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Service</th>
                            <th class="px-3 py-2 text-center text-xs font-medium text-slate-600 uppercase tracking-wider w-24">Price</th>
                            <th class="px-3 py-2 text-center text-xs font-medium text-slate-600 uppercase tracking-wider w-20">Cov %</th>
                            <th class="px-3 py-2 text-center text-xs font-medium text-slate-600 uppercase tracking-wider w-24">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        {{-- Example row 1 - With Inline Editing --}}
                        <tr
                            :class="selectedService === 1 ? 'bg-blue-100 ring-2 ring-blue-400' : 'hover:bg-slate-50'"
                            class="transition-all duration-200"
                        >
                            <td class="px-3 py-2 text-xs font-medium text-slate-900">LAB-001</td>
                            <td class="px-3 py-2 text-xs text-slate-700">Complete Blood Count (CBC)</td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    value="150.00"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    max="100"
                                    value="80"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button
                                        type="button"
                                        @click.stop="selectedService = 1"
                                        class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition-all"
                                        title="Configure Details"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click.stop
                                        class="p-1 text-green-600 hover:text-green-800 hover:bg-green-100 rounded transition-all"
                                        title="Save"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Example row 2 - Not Covered --}}
                        <tr
                            :class="selectedService === 2 ? 'bg-blue-100 ring-2 ring-blue-400' : 'hover:bg-slate-50'"
                            class="transition-all duration-200"
                        >
                            <td class="px-3 py-2 text-xs font-medium text-slate-900">IMG-015</td>
                            <td class="px-3 py-2 text-xs text-slate-700">X-Ray - Chest</td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    placeholder="0.00"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent bg-gray-50"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    max="100"
                                    placeholder="0"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent bg-gray-50"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button
                                        type="button"
                                        @click.stop="selectedService = 2"
                                        class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition-all"
                                        title="Configure Details"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click.stop
                                        class="p-1 text-green-600 hover:text-green-800 hover:bg-green-100 rounded transition-all"
                                        title="Save"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Example row 3 --}}
                        <tr
                            :class="selectedService === 3 ? 'bg-blue-100 ring-2 ring-blue-400' : 'hover:bg-slate-50'"
                            class="transition-all duration-200"
                        >
                            <td class="px-3 py-2 text-xs font-medium text-slate-900">SUR-102</td>
                            <td class="px-3 py-2 text-xs text-slate-700">Appendectomy</td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    value="2500.00"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    max="100"
                                    value="90"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button
                                        type="button"
                                        @click.stop="selectedService = 3"
                                        class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition-all"
                                        title="Configure Details"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click.stop
                                        class="p-1 text-green-600 hover:text-green-800 hover:bg-green-100 rounded transition-all"
                                        title="Save"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Example row 4 --}}
                        <tr
                            :class="selectedService === 4 ? 'bg-blue-100 ring-2 ring-blue-400' : 'hover:bg-slate-50'"
                            class="transition-all duration-200"
                        >
                            <td class="px-3 py-2 text-xs font-medium text-slate-900">CON-201</td>
                            <td class="px-3 py-2 text-xs text-slate-700">General Practitioner Consultation</td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    value="75.00"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    max="100"
                                    value="100"
                                    @click.stop
                                    class="w-full px-2 py-1 text-xs text-center border border-slate-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                />
                            </td>
                            <td class="px-3 py-2 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button
                                        type="button"
                                        @click.stop="selectedService = 4"
                                        class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition-all"
                                        title="Configure Details"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click.stop
                                        class="p-1 text-green-600 hover:text-green-800 hover:bg-green-100 rounded transition-all"
                                        title="Save"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- RIGHT COLUMN: Service Coverage Details (6 columns) --}}
        <div class="col-span-6 rounded-xl bg-white shadow-lg ring-1 ring-slate-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-50 to-white p-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Coverage Details
                </h3>
            </div>

            {{-- Details Form --}}
            <div class="p-6 overflow-y-auto" style="max-height: 500px;">
                <div x-show="selectedService === null" class="flex items-center justify-center h-64 text-slate-400">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                        </svg>
                        <p class="text-lg font-medium">Select a service to configure coverage</p>
                    </div>
                </div>

                <div x-show="selectedService !== null" x-transition class="space-y-6">
                    {{-- Service Info Badge --}}
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                        <p class="text-xs text-blue-600 font-medium mb-1">SELECTED SERVICE</p>
                        <p class="text-lg font-semibold text-blue-900">Complete Blood Count (CBC)</p>
                        <p class="text-sm text-blue-700">Code: LAB-001 | Category: Laboratory</p>
                    </div>

                    {{-- Pricing Section --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Plan Price</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-slate-500">$</span>
                                <input
                                    type="number"
                                    step="0.01"
                                    value="150.00"
                                    class="w-full pl-8 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="0.00"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Coverage %</label>
                            <div class="relative">
                                <input
                                    type="number"
                                    step="0.01"
                                    max="100"
                                    value="80.00"
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="0.00"
                                />
                                <span class="absolute right-3 top-2.5 text-slate-500">%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Cost Sharing Section --}}
                    <div class="border-t border-slate-200 pt-4">
                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Cost Sharing</h4>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Deductible</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-slate-500">$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        value="50.00"
                                        class="w-full pl-8 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="0.00"
                                    />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Coinsurance %</label>
                                <div class="relative">
                                    <input
                                        type="number"
                                        step="0.01"
                                        max="100"
                                        value="20.00"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="0.00"
                                    />
                                    <span class="absolute right-3 top-2.5 text-slate-500">%</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Max per Event</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-slate-500">$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        value="500.00"
                                        class="w-full pl-8 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="0.00"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Limits & Restrictions --}}
                    <div class="border-t border-slate-200 pt-4">
                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Limits & Restrictions</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Annual Max Uses</label>
                                <input
                                    type="number"
                                    value="12"
                                    min="0"
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Unlimited"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Requires Referral</label>
                                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Notes Section --}}
                    <div class="border-t border-slate-200 pt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Coverage Notes</label>
                        <textarea
                            rows="3"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                            placeholder="Add any special notes or restrictions for this coverage..."
                        >Only available at network facilities. Pre-authorization required for non-emergency cases.</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                        <button
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:ring-2 focus:ring-blue-500 transition-all"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 shadow-md transition-all"
                        >
                            Save Coverage
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
