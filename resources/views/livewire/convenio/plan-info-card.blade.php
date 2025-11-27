<div>
    <div wire:loading
         class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-2">
        <div class="grid grid-cols-3 gap-2 lg:grid-cols-12">
            <div class="col-span-12 text-center text-slate-600 py-4">
                <div class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Un momento por favor...</span>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.remove>
        @if($plan)
            <div
                class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-2">
                <div class="grid grid-cols-3 gap-2 lg:grid-cols-12">
                    <div class="col-span-3">
                        <x-title.title-xs>Plan Code</x-title.title-xs>
                        <x-title.p-title>{{ $plan->insurance_plan_code }}</x-title.p-title>
                    </div>
                    <div class="col-span-4">
                        <x-title.title-xs>Plan Name</x-title.title-xs>
                        <x-title.p-title>{{ $plan->insurance_plan_name }}</x-title.p-title>
                    </div>
                    <div class="col-span-5">
                        <x-title.title-xs>Insurance</x-title.title-xs>
                        <x-title.p-title>{{ $plan->insurance->insurance_name }}</x-title.p-title>
                    </div>
                </div>
            </div>
        @else
            <div
                class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-2">
                <div class="grid grid-cols-3 gap-2 lg:grid-cols-12">
                    <div class="col-span-12 text-center text-slate-600 py-4">
                        Select a plan to configure coverage
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
