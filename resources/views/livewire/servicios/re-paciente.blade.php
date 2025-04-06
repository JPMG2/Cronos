<div>
    <x-breadcrum breadcrumbs="Pacientes"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        @if(!session("isdisabled"))
            @if ($this->numpatients > 0)
                @livewire("utility.opcion-menu", ["namecomponent" => "patient"])
            @endif
        @endif
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <x-formcomponent.titleform>Datos de paciente</x-formcomponent.titleform>
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:target="getPaciente"></x-formcomponent.titleindicator>
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
                                    wire:model.defer="pacienteForm.pesonData.document_id"
                                    x-ref="ini"
                                    id="paci_document"
                                    isdisabled=""
                                    :error="$errors->first('document_id')"
                                >
                                    @foreach ($listDocument as $document)
                                        <option value="{{ $document->id }}">
                                            {{ $document->document_name }}
                                        </option>
                                    @endforeach

                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        @error("document_id")
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
                                    wire:model="pacienteForm.pesonData.num_document"
                                    x-mask="99999999999999999999"
                                    id="pacient_numdocument"
                                    @blur="$wire.validateDocument()"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled=""
                                    :error="$errors->first('num_document')"

                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("num_document")
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
                                wire:model="pacienteForm.pesonData.person_name"
                                id="pacient_name"

                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('person_name')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("person_name")
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
                                wire:model="pacienteForm.pesonData.person_lastname"
                                id="pacient_lastname"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('person_lastname')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("person_lastname")
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
                                wire:model.defer="pacienteForm.pesonData.gender_id"
                                id="patien_gender"
                                isdisabled=""
                                :error="$errors->first('gender_id')"
                            >
                                @foreach ($listGender as $gender)
                                    <option value="{{ $gender->id }}">
                                        {{ $gender->gender_name }}
                                    </option>
                                @endforeach

                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("gender_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Fecha de nacimiento"
                            for="pacient_datebirth"
                            required="yes"
                        >
                            <x-inputs.textinput
                                x-data
                                x-init="flatpickr($el, { dateFormat: 'd-m-Y' })"
                                wire:model="pacienteForm.pesonData.person_datebirth"
                                id="pacient_datebirth"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('person_datebirth')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>

                    </div>
                    @error("person_datebirth")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Estado civil"
                            for="patien_estcivil"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="pacienteForm.pesonData.marital_status_id"
                                id="patien_estcivil"
                                isdisabled=""
                                :error="$errors->first('marital_status_id')"
                            >
                                <option label=" "></option>
                                @foreach ($listMaritalStatus as $maritalStatus)
                                    <option value="{{ $maritalStatus->id }}">
                                        {{ $maritalStatus->maritalstatus_name }}
                                    </option>
                                @endforeach
                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("marital_status_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>

                <div class="relative sm:col-span-3">
                    <x-inputs.dropdown.dropdownconfig
                        wireidvalue="pacienteForm.pesonData.occupation_id"
                        :jsonvalues="json_encode($this->ocupacion->map(fn($o) => ['id' => $o->id, 'name' => $o->occupation_name])->values())"
                    >
                        <x-inputs.dropdown.labelautocomplet
                            label="Ocupación"
                            for="pacient_ocupaccion"
                            required="yes"
                        >
                            <x-inputs.dropdown.buttondropdown/>
                        </x-inputs.dropdown.labelautocomplet>
                        <x-inputs.dropdown.uldropdown
                            ulname="ocupacion"
                        >
                            <li class="px-2 py-1">
                                <x-inputs.dropdown.inputtextfilter
                                    placeholder="Buscar ocupación..."
                                />
                            </li>

                            <template x-for="(ocupacion, index) in filteredOptions()" :key="ocupacion.id">
                                <x-inputs.dropdown.lidropdown
                                    optionname="ocupacion"
                                />
                            </template>
                        </x-inputs.dropdown.uldropdown>
                    </x-inputs.dropdown.dropdownconfig>
                    @error("occupation_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="flex gap-x-1 sm:col-span-4">
                    <div class="relative sm:col-span-2 w-4/5">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Teléfono"
                                for="patien_phone"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="pacienteForm.pesonData.person_phone"
                                    x-mask="99999999999999999999"
                                    id="patien_phone"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled=""
                                    :error="$errors->first('person_phone')"

                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("person_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                    <div class="relative sm:col-span-2 w-full">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Correo"
                                for="patien_email"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="pacienteForm.pesonData.person_email"
                                    id="patien_email"
                                    autocomplete="off"
                                    maxlength="150"
                                    placeholder=" "
                                    isdisabled=""
                                    :error="$errors->first('person_email')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("person_email")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <x-inputs.dropdown.dropdownconfig
                        wireidvalue="pacienteForm.pesonData.nationality_id"
                        :jsonvalues="json_encode($this->nationality->map(fn($o) => ['id' => $o->id, 'name' => $o->nationality_name])->values())"
                    >
                        <x-inputs.dropdown.labelautocomplet
                            label="Nacionalidad"
                            for="pacient_nacionalidad"
                            required="yes"
                        >
                            <x-inputs.dropdown.buttondropdown/>
                        </x-inputs.dropdown.labelautocomplet>
                        <x-inputs.dropdown.uldropdown
                            ulname="nationality"
                        >
                            <li class="px-2 py-1">
                                <x-inputs.dropdown.inputtextfilter
                                    placeholder="Buscar nacionalidad..."
                                />
                            </li>

                            <template x-for="(nationality, index) in filteredOptions()" :key="nationality.id">
                                <x-inputs.dropdown.lidropdown
                                    optionname="nationality"
                                />
                            </template>
                        </x-inputs.dropdown.uldropdown>
                    </x-inputs.dropdown.dropdownconfig>
                    @error("nationality_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>

                <div class="relative w-full sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Dirección"
                            for="patien_addres"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="pacienteForm.pesonData.person_address"
                                id="patien_addres"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('person_address')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("person_address")
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
                            wire:submit.prevent="getPaciente"
                            wire:click.prevent="getPaciente"
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
    @livewire("servicios.list-paciente", ["show" => false])
</div>
