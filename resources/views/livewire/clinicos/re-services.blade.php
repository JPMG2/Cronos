@php use Carbon\Carbon; @endphp
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
            <x-butonbutton wire:click="$toggle('openservice')  "></x-butonbutton>
            <!-- Modal -->
            <div x-data="{ open: @entangle('openservice') }">
                <x-rightmodal
                    style="display: none"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    closemodal="openservice"
                >
                    <x-slot:title>Registro</x-slot>

                    <div class="mt-2 grid grid-cols-1 gap-4">
                        <div class="relative sm:col-span-1">
                            <div class="relative">
                                <x-inputs.textgroup
                                    label="Departamento"
                                    for="depaname"
                                    required="yes"
                                >
                                    <x-inputs.textinput
                                        wire:model="form.datadeparment.department_name"
                                        id="depaname"
                                        autocomplete="off"
                                        maxlength="100"
                                        placeholder=" "
                                        isdisabled="{{$isdisabled}}"
                                        :error="$errors->first('department_name')"
                                    ></x-inputs.textinput>
                                </x-inputs.textgroup>
                            </div>
                            @error("department_name")
                            <x-inputs.error-validate>
                                {{ $message }}
                            </x-inputs.error-validate>
                            @enderror
                        </div>
                        <div class="relative sm:col-span-1">
                            <div class="relative">
                                <x-inputs.textgroup
                                    label="Código"
                                    for="depacodi"
                                    required="yes"
                                >
                                    <x-inputs.textinput
                                        wire:model="form.datadeparment.department_code"
                                        id="depacodi"
                                        autocomplete="off"
                                        maxlength="10"
                                        placeholder=" "
                                        isdisabled="{{$isdisabled}}"
                                        :error="$errors->first('department_code')"
                                    ></x-inputs.textinput>
                                </x-inputs.textgroup>
                            </div>
                            @error("department_code")
                            <x-inputs.error-validate>
                                {{ $message }}
                            </x-inputs.error-validate>
                            @enderror
                        </div>
                    </div>

                    <form id="departamento" wire:submit.prevent="submit">
                        @csrf
                        <div class="absolute bottom-6 right-4">
                            <x-headerform.button-group>
                                <x-buttons.close wire:click="clearForm">
                                    {{ __("Cerrar") }}
                                </x-buttons.close>
                                <x-buttons.cancel
                                    wire:click="clearForm"
                                    label="Cancelar"
                                ></x-buttons.cancel>
                                <x-buttons.save
                                    wire:submit.prevent="queryDeparmente"
                                    wire:click.prevent="queryDeparmente"
                                    namefucion="queryDeparmente"
                                    label="Guardar"
                                    isdisabled="{{$isdisabled}}"
                                    :error="count($errors)"
                                ></x-buttons.save>
                            </x-headerform.button-group>
                        </div>
                    </form>

                </x-rightmodal>
            </div>
        </div>
    </div>
</div>
