<div>
    <x-breadcrum breadcrumbs="Especialistas"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        @if(!session("isdisabled"))
            @if ($this->medicals > 0)
                @livewire("utility.opcion-menu", ["namecomponent" => "especialist"])
            @endif
        @endif
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
                    wire:target="getEspecialis,especialistShow"
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
                                    wire:model.defer="formesp.dataespecialist.degree_id"
                                    x-ref="ini"
                                    id="esp_titulo"
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('degree_id')"
                                >
                                    <option label=" "></option>
                                    @foreach ($listDegree as $degree)
                                        <option value="{{ $degree->id }}">
                                            {{ $degree->degree_code }}
                                        </option>
                                    @endforeach
                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        @error("degree_id")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                    <div class="relative w-full sm:col-span-4">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Nombre"
                                for="esp_name"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="formesp.dataespecialist.medical_name"
                                    id="esp_name"
                                    autocomplete="off"
                                    maxlength="170"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('medical_name')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("medical_name")
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
                                wire:model="formesp.dataespecialist.medical_lastname"
                                id="esp_apellido"
                                autocomplete="off"
                                maxlength="170"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('medical_lastname')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("medical_lastname")
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
                                wire:model="formesp.dataespecialist.medical_dni"
                                x-mask="99999999999999999999"
                                id="esp_dni"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('medical_dni')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("medical_dni")
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
                                    wire:model.defer="formesp.dataespecialist.credential_id"
                                    id="esp_matri"
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('credential_id')"
                                >
                                    <option label=" "></option>
                                    @foreach ($listCredential as $credential)
                                        <option value="{{ $credential->id }}">
                                            {{ $credential->credential_code }}
                                        </option>
                                    @endforeach
                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        @error("credential_id")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                    <div class="relative w-3/5 sm:col-span-2">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Num. Matricula"
                                for="esp_nummatri"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="formesp.dataespecialist.medical_codenumber"
                                    id="esp_nummatri"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('medical_codenumber')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("medical_codenumber")
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
                            for="esp_especialis"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="formesp.dataespecialist.specialty_id"
                                id="esp_especialis"
                                isdisabled="{{$isdisabled}}"
                            >
                                <option label=" "></option>
                                @foreach ($listSpecialties as $specialist)
                                    <option value="{{ $specialist->id }}">
                                        {{ $specialist->specialty_name }}
                                    </option>
                                @endforeach
                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("specialty_id")
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
                                wire:model.defer="formesp.dataespecialist.state_id"
                                id="esp_estatus"
                                isdisabled="{{$isdisabled}}"
                            >
                                @foreach ($listState as $state)
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
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Correo"
                            for="esp_email"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_email"
                                id="esp_email"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('medical_email')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("medical_email")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative  sm:col-span-2">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Teléfono"
                            for="esp_phone"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_phone"
                                x-mask="99999999999999999999"
                                id="esp_phone"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('medical_phone')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("medical_phone")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative w-full sm:col-span-4">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Dirección"
                            for="esp_addres"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_address"
                                id="esp_addres"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('medical_address')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("medical_address")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
            </div>

            @if(!session("isdisabled"))
                <form
                    id="especialista"
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
                                wire:submit.prevent="getEspecialis"
                                wire:click.prevent="getEspecialis"
                                namefucion=""
                                label="Guardar"
                                isdisabled="{{$isdisabled}}"
                                :error="count($errors)"
                            ></x-buttons.save>
                        @endcan
                    </x-headerform.button-group>
                </form>
            @endif
        </div>
    </div>
    @livewire("personal.list-especialista", ["show" => false])
</div>
