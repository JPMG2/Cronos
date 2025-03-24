<div>
    <x-breadcrum breadcrumbs="Pacientes"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <x-formcomponent.titleform>Datos de paciente</x-formcomponent.titleform>
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:target="getEspecialis,especialistShow"></x-formcomponent.titleindicator>
            </div>
            <div class="mt-3 grid grid-cols-1 gap-x-2  gap-y-2 sm:grid-cols-9">
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-3/5 sm:col-span-3">
                        <div class="relative">
                            <x-inputs.selectgroup
                                label="Documento"
                                for="paci_document"
                                required="yes"
                            >
                                <x-inputs.selectinput
                                    wire:model.defer="formesp.dataespecialist.degree_id"
                                    x-ref="ini"
                                    id="paci_document"
                                    isdisabled=""
                                    :error="$errors->first('degree_id')"
                                >
                                    @foreach ($listDocument as $document)
                                        <option value="{{ $document->id }}">
                                            {{ $document->document_name }}
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
                                label="Número"
                                for="pacient_numdocument"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="formesp.dataespecialist.medical_name"
                                    x-mask="99999999999999999999"
                                    id="pacient_numdocument"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled=""
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
                <div class="relative w-full sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Nombre"
                            for="pacient_name"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_name"
                                id="pacient_name"
                                autocomplete="off"
                                maxlength="170"
                                placeholder=" "
                                isdisabled=""
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
                <div class="relative w-full sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Apellido"
                            for="pacient_lastname"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_name"
                                id="pacient_lastname"
                                autocomplete="off"
                                maxlength="170"
                                placeholder=" "
                                isdisabled=""
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
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Genero"
                            for="patien_gender"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="formesp.dataespecialist.specialty_id"
                                id="patien_gender"
                                isdisabled=""
                            >
                                @foreach ($listGender as $gender)
                                    <option value="{{ $gender->id }}">
                                        {{ $gender->gender_name }}
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
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Fecha de nacimiento"
                            for="patien_datebirth"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="formesp.dataespecialist.specialty_id"
                                id="patien_datebirth"
                                isdisabled=""
                            >
                                <option label=" "></option>

                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("specialty_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Teléfono"
                            for="patien_phone"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="formesp.dataespecialist.specialty_id"
                                id="patien_phone"
                                isdisabled=""
                            >
                                <option label=" "></option>

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
                            label="Correo"
                            for="patien_email"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="formesp.dataespecialist.specialty_id"
                                id="patien_email"
                                isdisabled=""
                            >
                                <option label=" "></option>

                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("specialty_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative w-full sm:col-span-9">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Dirección"
                            for="patien_addres"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="formesp.dataespecialist.medical_address"
                                id="patien_addres"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled=""
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

                        <x-buttons.save
                            wire:submit.prevent="getEspecialis"
                            wire:click.prevent="getEspecialis"
                            namefucion=""
                            label="Guardar"
                            isdisabled=""
                            :error="count($errors)"
                        ></x-buttons.save>

                    </x-headerform.button-group>
                </form>
            @endif
        </div>
    </div>
</div>
