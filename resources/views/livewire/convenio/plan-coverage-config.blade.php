<div class="p-6 overflow-y-auto" style="max-height: 500px;">
    <div x-show="selectedService === null" class="flex items-center justify-center h-64 text-slate-400">
        <div class="text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
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
                    <select
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
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
