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
                <div class="ml-2" wire:loading wire:target="queryService, openservice">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>


            <!-- End Modal -->
        </div>
    </div>
</div>
