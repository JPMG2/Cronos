@if($plan)
    <div class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-2">
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
    <div class="rounded-xl bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 p-2">
        <div class="grid grid-cols-3 gap-2 lg:grid-cols-12">
            <div class="col-span-12 text-center text-slate-600 py-4">
                Select a plan to configure coverage
            </div>
        </div>
    </div>
@endif
