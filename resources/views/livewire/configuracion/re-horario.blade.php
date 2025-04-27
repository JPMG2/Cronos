<div>
    <x-breadcrum breadcrumbs="Horario"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Horario
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="openRoles;roleQuery">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                <div
                    class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
                >
                    <table
                        class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <x-table.thead>
                            <tr>
                                <x-table.th>
                                    Día
                                </x-table.th>
                                <x-table.th>
                                    Atiende
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Inicio
                                        <span class="block">Mañana</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Fin
                                        <span class="block">Mañana</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Inicio
                                        <span class="block">Tarde</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Fin
                                        <span class="block">Tarde</span>
                                    </div>
                                </x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tablebody>
                            @foreach ($this->days as $day)
                                <tr
                                    class="even:bg-gray-100"
                                    wire:key="{{ $loop->iteration }}"
                                >
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        {{ $day->getName() }}
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant">

                                        <label for="{{'horaio'.$loop->iteration}}">
                                            <input
                                                wire:model="accesoForm.dataacceso.menu_options"
                                                id="{{'horaio'.$loop->iteration}}" type="checkbox"
                                                @change="valueCheck"
                                                value="{{ 1 }}"/>
                                        </label>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <input
                                                type="text"
                                                name="password_horizontal"
                                                id="password_horizontal"
                                                class="flex-1 py-1 pr-2 w-1 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300"
                                                placeholder="00:00"
                                            >
                                            <button type="button"
                                                    class="absolute right-1 bg-transparent flex items-center justify-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <input
                                                type="text"
                                                name="password_horizontal"
                                                id="password_horizontal"
                                                class="flex-1 py-1 pr-2 w-1 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300"
                                                placeholder="00:00"
                                            >
                                            <button type="button"
                                                    class="absolute right-1 bg-transparent flex items-center justify-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <input
                                                type="text"
                                                name="password_horizontal"
                                                id="password_horizontal"
                                                class="flex-1 py-1 pr-2 w-1 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300"
                                                placeholder="00:00"
                                            >
                                            <button type="button"
                                                    class="absolute right-1 bg-transparent flex items-center justify-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <input
                                                type="text"
                                                name="password_horizontal"
                                                id="password_horizontal"
                                                class="flex-1 py-1 pr-2 w-1 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300"
                                                placeholder="00:00"
                                            >
                                            <button type="button"
                                                    class="absolute right-1 bg-transparent flex items-center justify-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>

                                            </button>
                                        </div>

                                    </x-table.tdtable>
                                </tr>
                            @endforeach
                        </x-table.tablebody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
