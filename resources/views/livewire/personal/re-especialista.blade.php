<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <x-breadcrum breadcrumbs="Especialistas"></x-breadcrum>
    <x-company-watcher></x-company-watcher>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 relative">
        @if(!session("isdisabled"))
            @if ($this->medicals > 0)
                <div class="absolute top-2 right-10 z-20">
                    @livewire("utility.opcion-menu", ["namecomponent" => "especialist"])
                </div>
            @endif
        @endif

        <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 backdrop-blur-sm">
            <!-- Decorative header accent -->
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-teal-500 to-blue-600"></div>

            @teleport('#modal-personData')
            <x-Person.data-person :$name_person :$lastname_person :$documentType_person
                                  :$document_person :$email_person
                                  :$phone_person></x-Person.data-person>
            @endteleport

            <div class="px-6 py-6">
                <x-headerform.borderheader></x-headerform.borderheader>

                <!-- Enhanced Title Section -->
                <div class="mb-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 ring-4 ring-blue-50">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-formcomponent.titleform>Datos de especialista</x-formcomponent.titleform>
                            <p class="mt-1 text-sm text-slate-600">Complete la información del especialista.</p>
                        </div>
                        <x-formcomponent.titleindicator
                            wire:loading
                            wire:target="submitSpecialist,especialistHandleMenuAction,validatePersonExis"></x-formcomponent.titleindicator>
                    </div>
                </div>

                <!-- Enhanced Form Grid with better spacing -->
                <div class="space-y-3 ">
                    <!-- Personal Information Section -->
                    <div
                        class="rounded-xl bg-gradient-to-r from-slate-50 to-white p-4 ring-1 ring-slate-200 transition-all duration-300 hover:from-slate-100 hover:to-slate-50 hover:shadow-md focus-within:from-slate-100 focus-within:to-slate-50 focus-within:shadow-md">
                        <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-slate-800">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0h4"></path>
                            </svg>
                            Información Personal
                        </h3>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 xl:gap-8">

                            <!-- Document Information -->
                            <div class="lg:col-span-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="relative">
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

                                    <div class="relative w-full col-span-2">
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
                    </div>

                    <!-- Professional Information Section -->
                    <div
                        class="rounded-xl bg-gradient-to-r from-blue-50 to-white p-4 ring-1 ring-blue-200 transition-all duration-300 hover:from-blue-75 hover:to-blue-25 hover:shadow-md focus-within:from-blue-75 focus-within:to-blue-25 focus-within:shadow-md">
                        <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-slate-800">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Información Profesional
                        </h3>
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
                    </div>

                    <!-- Contact Information Section -->
                    <div
                        class="rounded-xl bg-gradient-to-r from-teal-50 to-white p-4 ring-1 ring-teal-200 transition-all duration-300 hover:from-teal-75 hover:to-teal-25 hover:shadow-md focus-within:from-teal-75 focus-within:to-teal-25 focus-within:shadow-md">
                        <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-slate-800">
                            <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Información de Contacto
                        </h3>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 xl:gap-8">
                            <!-- Phone -->
                            <div class="lg:col-span-4">
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
                            <div class="lg:col-span-8">
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
                            <div class="lg:col-span-12">
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
                    </div>
                </div>

                <!-- Enhanced Button Section -->
                @if(!session("isdisabled"))
                    <div class="mt-8 border-t border-slate-200 pt-8">
                        <form
                            id="especialista"
                            wire:submit.prevent="submit"
                        >
                            @csrf
                            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-6">
                                <x-buttons.cancel
                                    wire:click="clearForm"
                                    @click="window.dispatchEvent(new Event('clear-errors'));"
                                    label="Cancelar"
                                    class="transform transition-all duration-200 hover:scale-105"
                                ></x-buttons.cancel>
                                @can("created", $this->actions)
                                    <x-buttons.save
                                        wire:submit.prevent="submitSpecialist"
                                        wire:click.prevent="submitSpecialist"
                                        namefucion=""
                                        label="Guardar Especialista"
                                        isdisabled="{{$isdisabled}}"
                                        :error="count($errors)"
                                        class="transform bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-3 font-semibold text-white transition-all duration-200 hover:scale-105 hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-200"
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
        @livewire("personal.list-especialista", ["show" => false])
    </div>
</div>
