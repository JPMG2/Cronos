<div
    x-data="{ tooltip: false }"
    class="absolute -top-2 right-2 flex items-center justify-center divide-x"
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
                    class="{{ ! $optioncolor["history"] ? "bg-blue-300" : "bg-yellow-50" }} rounded p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
                >
                    <x-headerform.historyoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
                    @click="$wire.changeColor('export')"
                    class="{{ ! $optioncolor["export"] ? "bg-blue-300" : "bg-yellow-50" }} rounded p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
                >
                    <x-headerform.exportoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
                    class="{{ ! $optioncolor["print"] ? "bg-blue-300" : "bg-yellow-50" }} rounded p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
                >
                    <x-headerform.printoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
                    class="{{ ! $optioncolor["edit"] ? "bg-blue-300" : "bg-yellow-50" }} rounded p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
                >
                    <x-headerform.editoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
                    class="rounded bg-blue-300 p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
                >
                    <x-headerform.newoption/>
                </button>
                <div
                    x-show="tooltip"
                    x-cloak
                    class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
            class="{{ ! $optioncolor["show"] ? "bg-blue-300" : "bg-yellow-50" }} rounded p-1.5 py-1.5 text-center text-gray-100 shadow-xl"
        >
            <x-headerform.showoption/>
        </button>
        <div
            x-show="tooltip"
            x-cloak
            class="absolute right-full z-10 mr-1 rounded bg-black px-2 py-1 text-center text-xs text-white"
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
