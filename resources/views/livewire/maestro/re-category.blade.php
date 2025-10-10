@php use Carbon\Carbon; @endphp
<div>
    <x-breadcrum breadcrumbs="Categorías"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>

        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Categorías
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryCategory, opencategory, infoCategory">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                @if (count($this->categories) > 0)
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200/50 shadow-lg ring-1 ring-gray-200/20 dark:border-gray-700/50 dark:ring-gray-700/20 dark:shadow-black/10"
                    >
                        <table
                            class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <x-table.thead>
                                <tr>
                                    <x-table.th>
                                        ID
                                    </x-table.th>
                                    <x-table.th>
                                        Categoría
                                    </x-table.th>
                                    <x-table.th>
                                        Código
                                    </x-table.th>
                                    <x-table.th>
                                        Estatus
                                    </x-table.th>
                                    <x-table.th>
                                        Creado
                                    </x-table.th>
                                    <x-table.th></x-table.th>
                                </tr>
                            </x-table.thead>
                            <x-table.tablebody>
                                @foreach ($this->categories as $category)
                                    <tr
                                        class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-200 even:bg-gray-50/50 hover:shadow-sm dark:even:bg-gray-800/30 dark:hover:bg-gradient-to-r dark:hover:from-gray-700/30 dark:hover:to-gray-600/20"
                                        wire:key="{{ $category->id }}"
                                    >
                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            {{ $category->id }}
                                        </x-table.tdtable>

                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            {{ $category->categori_code }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            {{ $category->categori_name }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            <x-statescolor
                                                idstatecolor="{{$category->state->id }}"
                                            >
                                                {{$category->state->state_name }}
                                            </x-statescolor>
                                        </x-table.tdtable>

                                        <x-table.tdtable typetext="txtnormal" whitespace-nowrap>
                                            {{ Carbon::parse($category->created_at)->format("d/m/Y") }}
                                        </x-table.tdtable>
                                        <td
                                            class="flex items-center break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $category->id }}"
                                                    wire:click.prevent="infoCategory({{ $category }})"
                                                    wire:target="infoCategory"
                                                    iconname="edit"
                                                ></x-table.accionopcion>
                                            </div>
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $category->id }}"
                                                    wire:click.prevent="deleteCategory({{ $category }})"
                                                    wire:target="deleteCategory"
                                                    iconname="delete"
                                                    isDelete="isDelete"
                                                ></x-table.accionopcion>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table.tablebody>
                        </table>
                    </div>
                @else
                    <x-alert windowtype="error">
                        No existen categorías registradas.
                    </x-alert>
                @endif
            </div>
            @if(!session("isdisabled"))
                <x-butonbutton wire:click="$toggle('opencategory')  "></x-butonbutton>
                <!-- Modal -->
                <div x-data="{ open: @entangle('opencategory') }">
                    <x-rightmodal
                        style="display: none"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        closemodal="opencategory"
                    >
                        <x-slot:title>Registro</x-slot>

                        <div class="mt-2 grid grid-cols-1 gap-4">

                            <div class="relative sm:col-span-1">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Código"
                                        for="catecode"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.datacategory.categori_code"
                                            id="catecode"
                                            autocomplete="off"
                                            maxlength="10"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('categori_code')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("categori_code")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                            <div class="relative sm:col-span-1">
                                <div class="relative">
                                    <x-inputs.textgroup
                                        label="Categoría"
                                        for="catename"
                                        required="yes"
                                    >
                                        <x-inputs.textinput
                                            wire:model="form.datacategory.categori_name"
                                            id="catename"
                                            autocomplete="off"
                                            maxlength="100"
                                            placeholder=" "
                                            isdisabled="{{$isdisabled}}"
                                            :error="$errors->first('categori_name')"
                                        ></x-inputs.textinput>
                                    </x-inputs.textgroup>
                                </div>
                                @error("categori_name")
                                <x-inputs.error-validate>
                                    {{ $message }}
                                </x-inputs.error-validate>
                                @enderror
                            </div>
                            <div class="relative w-full col-span-1">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.selectgroup
                                            label="Estatus"
                                            for="categoristatus"
                                            required="yes"
                                        >
                                            <x-inputs.selectinput
                                                wire:model.defer="form.datacategory.state_id"
                                                id="categoristatus"
                                                isdisabled="{{$isdisabled}}"
                                            >
                                                @foreach ($this->states as $state)
                                                    <option value="{{ $state->id }}">
                                                        {{ $state->state_name }}
                                                    </option>
                                                @endforeach
                                            </x-inputs.selectinput>
                                        </x-inputs.selectgroup>
                                    </div>
                                    @error("state_id")
                                    <x-inputs.error-validate>
                                        {{ $message }}
                                    </x-inputs.error-validate>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <x-slot:buttons>
                            <form id="categoria" wire:submit.prevent="submit">
                                @csrf
                                <x-headerform.button-group>
                                    <x-buttons.close wire:click="clearForm">
                                        {{ __("Cerrar") }}
                                    </x-buttons.close>
                                    <x-buttons.cancel
                                        wire:click="clearForm"
                                        label="Cancelar"
                                    ></x-buttons.cancel>
                                    <x-buttons.save
                                        wire:submit.prevent="queryCategory"
                                        wire:click.prevent="queryCategory"
                                        namefucion="queryCategory"
                                        label="Guardar"
                                        isdisabled="{{$isdisabled}}"
                                        :error="count($errors)"
                                    ></x-buttons.save>
                                </x-headerform.button-group>
                            </form>
                        </x-slot:buttons>

                    </x-rightmodal>
                </div>
            @endif
        </div>
    </div>
</div>
