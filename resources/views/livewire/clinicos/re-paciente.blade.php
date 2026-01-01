<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <x-breadcrum breadcrumbs="Pacientes"></x-breadcrum>
    <x-company-watcher></x-company-watcher>

    <div class="relative mx-1.5 mt-4 py-6">

        @if(!session("isdisabled"))
            @if ($this->numpatients > 0)
                <x-formcomponent.optionheaderform>
                    @livewire("utility.opcion-menu", ["namecomponent" => "patient"])
                </x-formcomponent.optionheaderform>
            @endif
        @endif
        <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 backdrop-blur-sm">
            <x-headerform.borderheader></x-headerform.borderheader>
            <div class="px-6 py-6 ">
        @teleport('#modal-personData')
            <x-Person.data-person :$name_person :$lastname_person :$documentType_person
                                  :$document_person :$email_person
                                  :$phone_person></x-Person.data-person>
            @endteleport
                <div class="mb-4">
                    <x-formcomponent.headerformtitla iconname="person">
                        <x-slot:title>
                            <div class="flex items-center gap-2">
                                <span>Datos de paciente</span>
                                <x-formcomponent.titleindicator
                                    wire:loading
                                    wire:target="submitPatient,patientHandleMenuAction">
                                </x-formcomponent.titleindicator>
                            </div>
                        </x-slot:title>
                        <x-slot:subtitle>Complete información del paciente.</x-slot:subtitle>
                    </x-formcomponent.headerformtitla>
                </div>
                <div class="space-y-3">
                    <!-- Personal Information Section -->
                    <x-formcomponent.formdivcontent
                        dstyle="from-slate-50  ring-slate-200  hover:from-slate-100 hover:to-slate-50 focus-within:from-slate-100 focus-within:to-slate-50">
                        <x-formcomponent.h3divtitle iconname="personinfo">
                            Información Personal
                        </x-formcomponent.h3divtitle>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 xl:gap-4">
                            <!-- Document Information -->
                            <div class="lg:col-span-4">
                                <div class="grid grid-cols-5 gap-3">
                                    <div class="relative col-span-2">
                                        <div class="relative">
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
                                    </div>

                                    <div class="relative w-full col-span-3">
                                        <div class="relative">
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
                                </div>
                            </div>
                            <!-- Full Name -->
                            <div class="lg:col-span-8">
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="relative">
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

                                    <div class="relative">
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
                                </div>
                            </div>
                            <div class="lg:col-span-3">
                                <div class="relative ">
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
                            </div>
                            <div class="lg:col-span-3">
                                <div class="relative ">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Fecha de nacimiento"
                                            for="doffbirth"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                x-data
                                                autocomplete="off"
                                                x-init="flatpickr($el, { dateFormat: 'd-m-Y',  maxDate: new Date().fp_incr(0) })"
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
                            </div>
                            <div class="lg:col-span-3">
                                <div class="relative ">
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
                            </div>
                            <div class="lg:col-span-3">
                                <div class="relative ">
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

                                            <template x-for="(ocupacion, index) in filteredOptions()"
                                                      :key="ocupacion.id">
                                                <x-inputs.dropdown.lidropdown
                                                    optionname="ocupacion"
                                                />
                                            </template>
                                        </x-inputs.dropdown.uldropdown>
                                    </x-inputs.dropdown.dropdownconfig>
                                    <div class="relative">
                                        @error("occupation_id")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-formcomponent.formdivcontent>
                    <!-- Contact Information Section -->
                    <x-formcomponent.formdivcontent
                        dstyle="from-teal-50 ring-teal-200 hover:from-teal-75 hover:to-teal-25 focus-within:from-teal-75 focus-within:to-teal-25">
                        <x-formcomponent.h3divtitle iconname="email">
                            Información de Contacto
                        </x-formcomponent.h3divtitle>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 xl:gap-4">
                            <div class="lg:col-span-3">
                                <div class="relative ">
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
                            </div>
                            <div class="lg:col-span-4">
                                <div class="relative ">
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
                            <div class="lg:col-span-5">
                                <div class="relative ">
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
                            <div class="lg:col-span-5">
                                <div class="relative ">
                                    <div class="relative">
                                        <x-inputs.containautocomplete
                                            modelString="stringProvince"
                                            showModel="showProvince"
                                            modelId="id_province"
                                        >
                                            <div class="relative">
                                                <x-inputs.searchinput
                                                    :error="$errors->first('province_id')"
                                                    x-on:keyup="findProinvence()"
                                                    wire:model="stringProvince"
                                                    @keydown.escape.prevent.stop="closeList()"
                                                    @click.away="closeAway()"
                                                    @click="seeValues()"
                                                    isdisabled="{{$isdisabled}}"
                                                    placeholder="buscar..."
                                                    resetValues="$wire.resetValuesCity()"
                                                ></x-inputs.searchinput>
                                                <x-inputs.labelsearch required="yes">
                                                    Provincia
                                                </x-inputs.labelsearch>
                                                @if (count($listProvince) > 0)
                                                    <x-inputs.ligroup>
                                                        @foreach ($listProvince as $province)
                                                            <x-inputs.lioption
                                                                x-on:click="setValuesProvince('{{$province->id}}','{{$province->province_name}}')"
                                                            >
                                                                {{ $province->province_name }}
                                                            </x-inputs.lioption>
                                                        @endforeach
                                                    </x-inputs.ligroup>
                                                @endif
                                            </div>
                                        </x-inputs.containautocomplete>
                                    </div>
                                    @error("province_id")
                                    <x-inputs.error-validate>
                                        {{ $message }}
                                    </x-inputs.error-validate>
                                    @enderror
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <div class="relative ">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="CP"
                                            for="patien_cpcode"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="pacienteForm.personData.person_cpcode"
                                                id="patien_cpcode"
                                                autocomplete="off"
                                                maxlength="7"
                                                placeholder=" "
                                                isdisabled="{{$isdisabled}}"
                                                :error="$errors->first('person_cpcode')"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    @error("person_cpcode")
                                    <x-inputs.error-validate>
                                        {{ $message }}
                                    </x-inputs.error-validate>
                                    @enderror
                                </div>
                            </div>
                            <div class="lg:col-span-5">
                                <div class="relative ">
                                    <div class="relative">
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

                                                <template x-for="(nationality, index) in filteredOptions()"
                                                          :key="nationality.id">
                                                    <x-inputs.dropdown.lidropdown
                                                        optionname="nationality"
                                                    />
                                                </template>
                                            </x-inputs.dropdown.uldropdown>
                                        </x-inputs.dropdown.dropdownconfig>
                                    </div>
                                    @error("nationality_id")
                                    <x-inputs.error-validate>
                                        {{ $message }}
                                    </x-inputs.error-validate>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </x-formcomponent.formdivcontent>
                </div>

                @if(!session("isdisabled"))
                    <div class="mt-8 border-t border-slate-200 pt-4">
                        <form
                            id="paciente"
                            wire:submit.prevent="submit"
                        >
                            @csrf
                            <div class="flex flex-col items-center justify-center gap-2 sm:flex-row sm:gap-6">
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

                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Enhanced List Component -->
    <div class="relative mx-1.5 mt-4">
        <div class="rounded-lg bg-white p-4 shadow-xl">
            @livewire("clinico.list-paciente", ["show" => false])
        </div>
    </div>
</div>
