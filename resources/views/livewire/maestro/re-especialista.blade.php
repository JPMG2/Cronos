<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <x-breadcrum breadcrumbs="Especialistas"></x-breadcrum>
    <x-company-watcher></x-company-watcher>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 relative">
        @if(!session("isdisabled"))
            @if ($this->medicals > 0)
                <x-formcomponent.optionheaderform>
                    @livewire("utility.opcion-menu", ["namecomponent" => "especialist"])
                </x-formcomponent.optionheaderform>
            @endif
        @endif

        <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 backdrop-blur-sm">
            <!-- Decorative header accent -->
            <x-headerform.borderheader></x-headerform.borderheader>

            @teleport('#modal-personData')
            <x-Person.data-person :$name_person :$lastname_person :$documentType_person
                                  :$document_person :$email_person
                                  :$phone_person></x-Person.data-person>
            @endteleport

            <div class="px-6 py-6">
                <!-- Enhanced Title Section -->
                <div class="mb-4">
                    <x-formcomponent.headerformtitla iconname="person">
                        <x-slot:title>Datos Especialista</x-slot:title>
                        <x-slot:subtitle>Complete información del especialista.</x-slot:subtitle>
                        <x-formcomponent.titleindicator
                            wire:loading
                            wire:target="submitSpecialist,especialistHandleMenuAction,validatePersonExis"></x-formcomponent.titleindicator>
                    </x-formcomponent.headerformtitla>
                </div>
                <div class="space-y-3 ">
                    <!-- Personal Information Section -->
                    <x-formcomponent.formdivcontent
                        dstyle="from-slate-50  ring-slate-200  hover:from-slate-100 hover:to-slate-50 focus-within:from-slate-100 focus-within:to-slate-50">
                        <x-formcomponent.h3divtitle iconname="personinfo">
                            Información Personal
                        </x-formcomponent.h3divtitle>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 xl:gap-8">
                            <!-- Document Information -->
                            <div class="lg:col-span-4">
                                <div class="grid grid-cols-5 gap-3">
                                    <div class="relative col-span-2">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Documento"
                                                for="esp_document"
                                                required="yes"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model.defer="formHandler.personData.document_id"
                                                    id="esp_document"
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('document_id')"
                                                >
                                                    <option label=" "></option>
                                                    @foreach ($this->listDocument as $document)
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

                                    <div class="relative w-full col-span-3">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Número"
                                                for="esp_numdocument"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    x-ref="ini"
                                                    wire:model="formHandler.personData.num_document"
                                                    x-mask="99999999999999999999"
                                                    id="esp_numdocument"
                                                    @blur="$wire.validatePersonExits()"
                                                    autocomplete="off"
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

                            <!-- Title -->
                            <div class="lg:col-span-2 w-full">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.selectgroup
                                            label="Titulo"
                                            for="esp_titulo"
                                            required="yes"
                                        >
                                            <x-inputs.selectinput
                                                wire:model.defer="formHandler.dataespecialist.degree_id"
                                                id="esp_titulo"
                                                isdisabled="{{$isdisabled}}"
                                                :error="$errors->first('degree_id')"
                                                required
                                            >
                                                <option label=" "></option>
                                                @foreach ($this->listDegree as $degree)
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
                            </div>
                            <!-- Full Name -->
                            <div class="lg:col-span-6">
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Nombre"
                                                for="esp_name"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="formHandler.personData.person_name"
                                                    id="esp_name"
                                                    autocomplete="off"
                                                    maxlength="170"
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
                                                for="esp_apellido"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    required
                                                    wire:model="formHandler.personData.person_lastname"
                                                    id="esp_apellido"
                                                    autocomplete="off"
                                                    maxlength="170"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
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
                                </div>
                            </div>
                        </div>
                    </x-formcomponent.formdivcontent>
                    <!-- Professional Information Section -->
                    <x-formcomponent.formdivcontent
                        dstyle="from-blue-50 ring-blue-200 hover:from-blue-75 hover:to-blue-25 focus-within:from-blue-75 focus-within:to-blue-25">
                        <x-formcomponent.h3divtitle iconname="professioninfo">
                            Información Profesional
                        </x-formcomponent.h3divtitle>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 xl:gap-8">
                            <!-- License Information -->
                            <div class="lg:col-span-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Matricula"
                                                for="esp_matri"
                                                required="yes"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model.defer="formHandler.dataespecialist.credential_id"
                                                    id="esp_matri"
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('credential_id')"
                                                    required
                                                >
                                                    <option label=" "></option>
                                                    @foreach ($this->listCredential as $credential)
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

                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Num. Matricula"
                                                for="esp_nummatri"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    required
                                                    wire:model="formHandler.dataespecialist.medical_codenumber"
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
                            </div>

                            <!-- Specialty -->
                            <div class="lg:col-span-6">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.selectgroup
                                            label="Especialidad"
                                            for="esp_especialis"
                                            required="yes"
                                        >
                                            <x-inputs.selectinput
                                                wire:model.defer="formHandler.dataespecialist.specialty_id"
                                                id="esp_especialis"
                                                isdisabled="{{$isdisabled}}"
                                            >
                                                <option label=" "></option>
                                                @foreach ($this->listSpecialties as $specialist)
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
                            </div>
                        </div>
                    </x-formcomponent.formdivcontent>
                    <!-- Contact Information Section -->
                    <x-formcomponent.formdivcontent
                        dstyle="from-teal-50 ring-teal-200 hover:from-teal-75 hover:to-teal-25 focus-within:from-teal-75 focus-within:to-teal-25">
                        <x-formcomponent.h3divtitle iconname="email">
                            Información de Contacto
                        </x-formcomponent.h3divtitle>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 xl:gap-8">
                            <!-- Phone -->
                            <div class="lg:col-span-3">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Teléfono"
                                            for="esp_phone"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="formHandler.personData.person_phone"
                                                x-mask="99999999999999999999"
                                                id="esp_phone"
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

                            <!-- Email -->
                            <div class="lg:col-span-4">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Correo"
                                            for="esp_email"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="formHandler.personData.person_email"
                                                id="esp_email"
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

                            <!-- Address -->
                            <div class="lg:col-span-5">
                                <div class="relative">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Dirección"
                                            for="esp_addres"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="formHandler.personData.person_address"
                                                id="esp_addres"
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
                        </div>
                    </x-formcomponent.formdivcontent>
                </div>

                <!-- Enhanced Button Section -->
                @if(!session("isdisabled"))
                    <div class="mt-8 border-t border-slate-200 pt-4">
                        <form
                            id="especialista"
                            wire:submit.prevent="submit"
                        >
                            @csrf
                            <div class="flex flex-col items-center justify-center gap-2 sm:flex-row sm:gap-6">
                                <x-buttons.cancel
                                    wire:click="clearForm"
                                    @click="window.dispatchEvent(new Event('clear-errors'));"
                                    label="Cancelar"
                                ></x-buttons.cancel>
                                @can("created", $this->actions)
                                    <x-buttons.save
                                        wire:submit.prevent="submitSpecialist"
                                        wire:click.prevent="submitSpecialist"
                                        namefucion=""
                                        label="Guardar"
                                        isdisabled="{{$isdisabled}}"
                                        :error="count($errors)"

                                    ></x-buttons.save>
                                @endcan
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Enhanced List Component -->
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        @livewire("maestro.list-especialista", ["show" => false])
    </div>
</div>
