<div>
    <x-breadcrum breadcrumbs="Roles"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Roles
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryDepa">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                @if ($this->countRoles > 0)
                    <div
                        class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
                    >
                        <table
                            class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                        </table>
                    </div>

                @else
                    <x-alert windowtype="error">
                        No existen roles registrados.
                    </x-alert>
                @endif
            </div>
        </div>
    </div>
</div>
