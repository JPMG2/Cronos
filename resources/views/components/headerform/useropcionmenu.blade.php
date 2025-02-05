@props([
    "formoption" => false,
    "showbutton" => false,
    "optioncolor" => false,
])
@php
    foreach ($optioncolor as $key => $value) {
        $option = ucfirst($key);
        if ($value) {
            $variableName = "color" . $option;
            $$variableName = "bg-blue-200";
        } else {
            $variableName = "color" . $option;
            $$variableName = "bg-white";
        }
    }
@endphp

<div>
    <div>
        <div
            class="absolute -top-2 right-2 flex divide-x overflow-hidden rounded-lg text-center font-mono text-sm font-bold leading-6 shadow-lg dark:divide-slate-700"
        >
            @if ($showbutton)
                <div
                    class="{{ $colorHistory }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                    wire:click="$parent.{{ $formoption . "History" }}()"
                    @click="$wire.changeColor('history')"
                >
                    <x-headerform.historyoption />
                </div>
            @endif

            @if ($showbutton)
                <div
                    class="{{ $colorExport }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                    wire:click="$parent.{{ $formoption . "Export" }}()"
                    @click="$wire.changeColor('export')"
                >
                    <x-headerform.exportoption />
                </div>
            @endif

            @if ($showbutton)
                <div
                    class="{{ $colorPrint }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                    wire:click="$parent.{{ $formoption . "Print" }}()"
                    @click="$wire.changeColor('print')"
                >
                    <x-headerform.printoption />
                </div>
            @endif

            @if ($showbutton)
                <div
                    class="{{ $colorEdit }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                    wire:click="$parent.{{ $formoption . "Edit" }}()"
                    @click="$wire.changeColor('edit')"
                >
                    <x-headerform.editoption />
                </div>
            @endif

            @if ($showbutton)
                <div
                    class="{{ $colorNew }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                    wire:click="$parent.{{ $formoption . "New" }}()"
                    @click="$wire.changeColor('new')"
                >
                    <x-headerform.newoption />
                </div>
            @endif

            <div
                class="{{ $colorNew }} transform p-2 hover:-translate-y-0.5 hover:scale-y-110 hover:bg-blue-200"
                wire:click="$parent.{{ $formoption . "Show" }}()"
                @click="$wire.changeColor('show')"
            >
                <x-headerform.showoption />
            </div>
        </div>
    </div>
</div>
