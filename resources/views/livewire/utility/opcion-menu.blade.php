<div
    x-data="{ tooltip: false }"
    class="flex items-center justify-center divide-x rounded-lg bg-gradient-to-r from-primary-50 to-white backdrop-blur-sm shadow-lg ring-1 ring-primary-200/50 p-2"
>
    @if ($showbutton)
        @can("history", $this->actions)
            <div
                x-data="{ tooltip: false }"
                class="relative flex items-center justify-center"
            >
                <button
                    @mouseenter="tooltip = true"
                    @mouseleave="tooltip = false"
                    wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('history')"
                    @click="$wire.changeColor('history')"
                    class="{{ ! $optioncolor["history"] ? "bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50 text-slate-600" : "bg-gradient-to-r from-primary-100 to-primary-200 text-primary-700 ring-1 ring-primary-300" }} rounded-lg p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
                >
                    <x-headerform.historyoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
                >
                    Historial
                </div>
            </div>
        @endcan

        @can("export", $this->actions)
            <div
                x-data="{ tooltip: false }"
                class="relative flex items-center justify-center"
            >
                <button
                    @mouseenter="tooltip = true"
                    @mouseleave="tooltip = false"
                    wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('export')"
                    @click="$wire.changeColor('export')"
                    class="{{ ! $optioncolor["export"] ? "bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50:from-slate-600:to-slate-500 text-slate-600" : "bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300" }} rounded p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
                >
                    <x-headerform.exportoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
                >
                    Exportar
                </div>
            </div>
        @endcan

        @can("print", $this->actions)
            <div
                x-data="{ tooltip: false }"
                class="relative flex items-center justify-center"
            >
                <button
                    @mouseenter="tooltip = true"
                    @mouseleave="tooltip = false"
                    wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('print')"
                    @click="$wire.changeColor('print')"
                    class="{{ ! $optioncolor["print"] ? "bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50:from-slate-600:to-slate-500 text-slate-600" : "bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300" }} rounded p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
                >
                    <x-headerform.printoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
                >
                    Imprimir
                </div>
            </div>
        @endcan

        @can("updated", $this->actions)
            <div
                x-data="{ tooltip: false }"
                class="relative flex items-center justify-center"
            >
                <button
                    @mouseenter="tooltip = true"
                    @mouseleave="tooltip = false"
                    wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('edit')"
                    @click="$wire.changeColor('edit')"
                    class="{{ ! $optioncolor["edit"] ? "bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50:from-slate-600:to-slate-500 text-slate-600" : "bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300" }} rounded p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
                >
                    <x-headerform.editoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
                >
                    Editar
                </div>
            </div>
        @endcan

        @can("refresh", $this->actions)
            <div
                x-data="{ tooltip: false }"
                class="relative flex items-center justify-center"
            >
                <button
                    @mouseenter="tooltip = true"
                    @mouseleave="tooltip = false"
                    wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('new')"
                    class="bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50:from-slate-600:to-slate-500 text-slate-600 rounded p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
                >
                    <x-headerform.newoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
                >
                    Nuevo
                </div>
            </div>
        @endcan
    @endif

    <div
        x-data="{ tooltip: false }"
        class="relative flex items-center justify-center"
    >
        <button
            @mouseenter="tooltip = true"
            @mouseleave="tooltip = false"
            wire:click="$parent.{{ $namecomponent . "HandleMenuAction" }}('show')"
            @click="$wire.changeColor('show')"
            class="{{ ! $optioncolor["show"] ? "bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50:from-slate-600:to-slate-500 text-slate-600" : "bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300" }} rounded p-1.5 py-1.5 text-center transition-all duration-300 hover:shadow-md"
        >
            <x-headerform.showoption/>
        </button>
        <div
            x-show="tooltip"
            x-cloak
            class="absolute right-full z-10 mr-1 rounded bg-slate-800/90 backdrop-blur-sm px-2 py-1 text-center text-xs text-white shadow-lg"
        >
            Buscar
        </div>
    </div>
</div>

<script>
    window.addEventListener('openWindow', (event) => {
        const value = event.detail[0];
        window.open(value.url, '_blank');
    });
</script>
