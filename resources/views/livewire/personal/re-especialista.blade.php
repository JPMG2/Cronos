<div>
    <x-headerform.breadcrum-header>
        @foreach ($breadcrumbs as $breacdata)
            <x-headerform.breadcrum-li>
                {{ $breacdata }}
            </x-headerform.breadcrum-li>
        @endforeach
    </x-headerform.breadcrum-header>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Datos de especialista
                    </h4>
                </div>
                <div
                    class="ml-2"
                    wire:loading
                    wire:target=""
                >
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="mt-3 grid grid-cols-1 gap-x-2  gap-y-2 sm:grid-cols-9">
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-2/5 sm:col-span-3">
                        <div class="relative">
                            <x-inputs.selectgroup
                                label="Titulo"
                                for="esp_titulo"
                                required="yes"
                            >
                                <x-inputs.selectinput
                                    wire:model.defer="form.databranch.state_id"
                                    id="esp_titulo"
                                    isdisabled="{{$isdisabled}}"
                                >
                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        <x-inputs.error-validate></x-inputs.error-validate>
                    </div>
                    <div class="relative w-full sm:col-span-4">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Nombre"
                                for="esp_name"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="form.databranch.branch_name"
                                    id="esp_name"
                                    autocomplete="off"
                                    maxlength="200"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('branch_name')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("branch_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Apellido"
                            for="esp_apellido"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_name"
                                id="esp_apellido"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_name')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_name")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="DNI"
                            for="esp_dni"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_phone"
                                x-mask="99999999999999999999"
                                id="esp_dni"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_phone')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_name")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-2/5 sm:col-span-3">
                        <div class="relative">
                            <x-inputs.selectgroup
                                label="Matricula"
                                for="esp_matri"
                                required="yes"
                            >
                                <x-inputs.selectinput
                                    wire:model.defer="form.databranch.state_id"
                                    id="esp_matri"
                                    isdisabled="{{$isdisabled}}"
                                >
                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        <x-inputs.error-validate></x-inputs.error-validate>
                    </div>
                    <div class="relative w-3/5 sm:col-span-2">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Num. Matricula"
                                for="esp_nummatri"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="form.databranch.branch_phone"
                                    x-mask="99999999999999999999"
                                    id="esp_nummatri"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('branch_phone')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("branch_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Especialidad"
                            for="esp_medica"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="form.databranch.state_id"
                                id="esp_medica"
                                isdisabled="{{$isdisabled}}"
                            >
                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("branch_name")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Estatus"
                            for="esp_estatus"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="form.databranch.state_id"
                                id="esp_estatus"
                                isdisabled="{{$isdisabled}}"
                            >
                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("branch_name")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
            </div>


            <form
                id="sucursal"
                wire:submit.prevent="submit"
                x-init="$refs.ini.focus()"
            >
                @csrf
                <x-headerform.button-group>
                    <x-buttons.cancel
                        wire:click="clearForm"
                        label="Cancelar"
                    ></x-buttons.cancel>
                    @can("created", $this->actions)
                        <x-buttons.save
                            wire:submit.prevent=""
                            wire:click.prevent=""
                            namefucion=""
                            label="Guardar"
                            isdisabled="{{$isdisabled}}"
                            :error="count($errors)"
                        ></x-buttons.save>
                    @endcan
                </x-headerform.button-group>
            </form>
        </div>
    </div>
</div>
