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
                                    wire:model.defer="pacienteForm.pacienteData.document_id"
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
                                    wire:model="pacienteForm.pacienteData.num_document"
                                    x-mask="99999999999999999999"
                                    id="pacient_numdocument"

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
                                wire:model="pacienteForm.pacienteData.patient_name"
                                id="pacient_name"

                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('patient_name')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("patient_name")
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
                                wire:model="pacienteForm.pacienteData.patient_lastname"
                                id="pacient_lastname"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('patient_lastname')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("patient_lastname")
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
                                wire:model.defer="pacienteForm.pacienteData.gender_id"
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
                                wire:model="pacienteForm.pacienteData.patient_datebirth"
                                id="pacient_datebirth"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('patient_datebirth')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>

                    </div>
                    @error("patient_datebirth")
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
                                wire:model.defer="pacienteForm.pacienteData.marital_status_id"
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
                    <div

                        x-data="{
                            open: false,
                            activeIndex: 0,
                            selected: null,
                            index: 0,
                            isUsingKeyboard: true,
                            numberitem: {{$this->ocupacion->count()}},
                            showoption(){
                                this.open = !this.open;
                            },
                            close() {
                                this.open = false;
                                this.isUsingKeyboard = true;
                            },
                            keyDown(){
                                this.isUsingKeyboard = true;
                                this.activeIndex =  (this.activeIndex + 1) % this.numberitem;
                            },
                            keyUp(){
                                this.isUsingKeyboard = true;
                                this.activeIndex =  (this.activeIndex - 1 + this.numberitem) % this.numberitem;
                            },
                             select(index) {
                                this.selected = index;
                                this.close();
                             },
                        }"
                        @keydown.escape.prevent.stop="close()"
                        @keydown.arrow-down.prevent="keyDown()"
                        @keydown.arrow-up.prevent="keyUp()"
                    >
                        <x-inputs.textgroup
                            label="Ocupación"
                            for="pacient_datebirth"
                            required="yes"
                        >
                            <button type="button"
                                    @click="showoption()"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-2 pl-3 pr-2 text-left text-gray-900 outline
                                outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2
                                focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <template x-if="selected === null">
                                    <span class="col-start-1 row-start-1 truncate pr-6"> &nbsp;</span>
                                </template>
                                <template x-if="selected !== null">
                                <span class="col-start-1 row-start-1 truncate pr-6"
                                      x-text="$el.innerText = document.getElementById('option-' + selected)?.innerText || ''">
                                </span>
                                </template>

                                <svg
                                    class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                    viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-inputs.textgroup>
                        <ul
                            x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.outside="close()"
                            style="display: none;"
                            class="absolute z-30 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1
                              text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                            aria-activedescendant="listbox-ocupacion">
                            @foreach($this->ocupacion as $ocupacion)

                                <li
                                    @click="select({{$loop->index}})"
                                    :id="'option-' + {{$loop->index}}"
                                    @mouseenter="isUsingKeyboard = false; activeIndex = {{$loop->index}}"
                                    @mouseleave="isUsingKeyboard = true"
                                    :class="{
                    'bg-indigo-600 text-white': isUsingKeyboard && activeIndex === {{$loop->index}},
                    'hover:bg-indigo-600 hover:text-white': !isUsingKeyboard
                }"
                                    class="py-1 pl-3 pr-9 text-gray-900"
                                    role="option">

                                    <span class="block truncate font-normal">{{$ocupacion->occupation_name}}</span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
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
                                    wire:model="pacienteForm.pacienteData.patient_phone"
                                    x-mask="99999999999999999999"
                                    id="patien_phone"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled=""
                                    :error="$errors->first('patient_phone')"

                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("patient_phone")
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
                                    wire:model="pacienteForm.pacienteData.patient_email"
                                    id="patien_email"
                                    autocomplete="off"
                                    maxlength="150"
                                    placeholder=" "
                                    isdisabled=""
                                    :error="$errors->first('patient_email')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("patient_email")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Nacionalidad"
                            for="patien_nation"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="pacienteForm.pacienteData.nationality_id"
                                id="patien_nation"
                                isdisabled=""
                                :error="$errors->first('nationality_id')"
                            >
                                <option label=" "></option>

                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
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
                                wire:model="pacienteForm.pacienteData.patient_address"
                                id="patien_addres"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled=""
                                :error="$errors->first('patient_address')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("patient_address")
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
</div>
