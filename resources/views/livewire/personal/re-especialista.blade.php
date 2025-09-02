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
        @teleport('#modal-personData')
        <x-Person.data-person :$name_person :$lastname_person :$documentType_person
                              :$document_person :$email_person
                              :$phone_person></x-Person.data-person>
        @endteleport
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <x-formcomponent.titleform>Datos de especialista</x-formcomponent.titleform>
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:target="submitSpecialist,especialistHandleMenuAction,validatePersonExis"></x-formcomponent.titleindicator>
            </div>

            <div class="mt-3 grid grid-cols-1 gap-x-2  gap-y-2 sm:grid-cols-9">

                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-3/5 sm:col-span-3">
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
                    <div class="relative w-full sm:col-span-2">
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
                <div class="relative sm:col-span-1">
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
                <div class="flex gap-x-1 sm:col-span-5">
                    <div class="relative w-full">
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

                    <div class="relative w-full">
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
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-52 sm:col-span-3">
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
                    <div class="relative w-full sm:col-span-2">
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
                <div class="relative sm:col-span-3">
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
                <div class="relative  sm:col-span-3">
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
                <div class="relative sm:col-span-4">
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

                <div class="relative w-full sm:col-span-5">
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

            @if(!session("isdisabled"))
                <form
                    id="especialista"
                    wire:submit.prevent="submit"
                >
                    @csrf
                    <x-headerform.button-group>
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
                    </x-headerform.button-group>
                </form>
            @endif
        </div>
    </div>
    @livewire("personal.list-especialista", ["show" => false])
</div>
