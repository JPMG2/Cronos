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
        @teleport('#modal-personData')
        <x-Person.data-person :$name_person :$lastname_person :$documentType_person
                              :$document_person :$email_person
                              :$phone_person></x-Person.data-person>
        @endteleport
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <x-formcomponent.titleform>Datos de paciente</x-formcomponent.titleform>
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:target="submitPatient,patientHandleMenuAction">
                </x-formcomponent.titleindicator>
            </div>
            <div class="mt-3 grid grid-cols-1 gap-x-2  gap-y-2 sm:grid-cols-9">
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-3/5 sm:col-span-3">
                        <div class="relative">
                            <x-inputs.selectgroup
                                label="Documento"
                                for="paci_docutype"
                                required="yes"
                                isdisabled="{{$isdisabled}}"
                            >
                                <x-inputs.selectinput
                                    wire:model.defer="pacienteForm.personData.document_id"
                                    id="paci_docutype"
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('document_id')"
                                    required
                                >
                                    @foreach ($this->documentType as $document)
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
                                for="documentnumber"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    x-ref="ini"
                                    wire:model="pacienteForm.personData.num_document"
                                    x-mask="99999999999999999999"
                                    id="documentnumber"
                                    autocomplete="off"
                                    @blur="$wire.validatePersonExits()"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('num_document')"
                                    required
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
                            for="paci_name"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="pacienteForm.personData.person_name"
                                id="paci_name"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('person_name')"
                                required
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
                            for="paci_apellido"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="pacienteForm.personData.person_lastname"
                                id="paci_apellido"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('person_lastname')"
                                required
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
                            for="paci_gender"
                            required="yes"
                            isdisabled="{{$isdisabled}}"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="pacienteForm.personData.gender_id"
                                id="paci_gender"
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('gender_id')"
                            >
                                <option hidden selected></option>
                                @foreach ($this->gender as $gender)
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
                            for="doffbirth"
                            required="yes"
                        >
                            <x-inputs.textinput
                                x-data
                                autocomplete="off"
                                x-init="flatpickr($el, { dateFormat: 'd-m-Y' })"
                                wire:model="pacienteForm.personData.person_datebirth"
                                id="doffbirth"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('person_datebirth')"
                                required
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
                            for="paci_estcivil"
                            required="yes"
                            isdisabled="{{$isdisabled}}"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="pacienteForm.personData.marital_status_id"
                                id="paci_estcivil"
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('marital_status_id')"

                            >
                                <option hidden selected></option>
                                @foreach ($this->maritalStatus as $maritalStatus)
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
                        wireidvalue="pacienteForm.personData.occupation_id"
                        :jsonvalues="json_encode($this->occupation->map(fn($o) => ['id' => $o->id, 'name' => $o->occupation_name])->values())"
                    >
                        <x-inputs.dropdown.labelautocomplet
                            label="Ocupación"
                            for="pacient_ocupaccion"
                            required="yes"
                        >
                            <x-inputs.dropdown.buttondropdown
                                isdisabled="{{$isdisabled}}"
                            />
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
                                for="paci_phone"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="pacienteForm.personData.person_phone"
                                    x-mask="99999999999999999999"
                                    id="paci_phone"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
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
                                for="paci_mail"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="pacienteForm.personData.person_email"
                                    id="paci_mail"
                                    autocomplete="off"
                                    maxlength="150"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
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
                        wireidvalue="pacienteForm.personData.nationality_id"
                        :jsonvalues="json_encode($this->nationality->map(fn($o) => ['id' => $o->id, 'name' => $o->nationality_name])->values())"
                    >
                        <x-inputs.dropdown.labelautocomplet
                            label="Nacionalidad"
                            for="pacient_nacionalidad"
                            required="yes"
                        >
                            <x-inputs.dropdown.buttondropdown
                                isdisabled="{{$isdisabled}}"
                            />
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
                                wire:model="pacienteForm.personData.person_address"
                                id="patien_addres"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
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
                    id="paciente"
                    wire:submit.prevent="submit"
                >
                    @csrf
                    <x-headerform.button-group>
                        <x-buttons.cancel
                            wire:click="clearForm"
                            @click="window.dispatchEvent(new Event('clear-errors'));"
                            label="Cancelar"
                        ></x-buttons.cancel>

                        <x-buttons.save
                            wire:submit.prevent="submitPatient"
                            wire:click.prevent="submitPatient"
                            namefucion=""
                            label="Guardar"
                            isdisabled="{{$isdisabled}}"
                            :error="count($errors)"
                        ></x-buttons.save>

                    </x-headerform.button-group>
                </form>
            @endif
        </div>
    </div>
    @livewire("clinico.list-paciente", ["show" => false])
</div>
