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

        <!-- start:: Multiple Columns -->
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Datos Obra social
                    </h4>
                </div>
                <div
                    class="ml-2"
                    wire:loading
                    wire:target="insuraceQuery,openTypes"
                >
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>

            <form id="reobrasocial">
                @csrf
                <div class="mb-2 w-auto">
                    <div
                        x-data="{
                            selectedId: 'tab1',
                            select(id) {
                                this.selectedId = id
                            },
                            isSelected(id) {
                                return this.selectedId === id
                            },
                        }"
                    >
                        <div class="mt-3 grid grid-cols-3 gap-5">
                            <x-buttons.acordionbutton
                                iconname="document"
                                id="tab1"
                                @click="select($el.id)"
                                @focus="select($el.id)"
                            >
                                Datos básicos
                            </x-buttons.acordionbutton>
                            <x-buttons.acordionbutton
                                iconname="planes"
                                id="tab2"
                                @click="select($el.id)"
                                @focus="select($el.id)"
                            >
                                Planes
                            </x-buttons.acordionbutton>
                            <x-buttons.acordionbutton
                                iconname="calcular"
                                id="tab3"
                                @click="select($el.id)"
                                @focus="select($el.id)"
                            >
                                Facturación
                            </x-buttons.acordionbutton>
                        </div>
                        <div
                            class="mt-4 rounded border border-gray-100 bg-white p-3 font-light text-gray-500 shadow-xl"
                        >
                            <section
                                style="display: none"
                                x-show="isSelected('tab1')"
                                :aria-labelledby="isSelected('tab1') ? 'selected-tab' : 'not-selected-tab'"
                            >
                                <div
                                    x-data
                                    x-init="$refs.insurancename.focus()"
                                    class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9"
                                >
                                    <div class="relative sm:col-span-5">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Nombre"
                                                for="insurancename"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    x-ref="insurancename"
                                                    wire:model="form.dataobrasocial.insurance_name"
                                                    id="insurancename"
                                                    autocomplete="off"
                                                    maxlength="220"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_name')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_name")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-2">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Siglas"
                                                for="insurancesigla"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_acronym"
                                                    id="insurancesigla"
                                                    autocomplete="off"
                                                    maxlength="30"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_acronym')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_acronym")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div
                                        class="relative sm:col-span-2"
                                        x-data="{
                                            openselect: false,
                                            textselected: @entangle("typinsurance"),
                                            openSelect() {
                                                this.openselect = ! this.openselect
                                            },
                                            closeList() {
                                                this.openselect = false
                                            },
                                            setValuetext(value) {
                                                this.textselected = value
                                                this.openselect = false
                                            },
                                        }"
                                    >
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Tipo"
                                                for="insurancetype"
                                                required="yes"
                                            >
                                                <x-inputs.selexttext
                                                    x-on:click="openSelect()"
                                                    x-on:click.away="closeList()"
                                                    x-model="textselected"
                                                    @keydown.escape.prevent.stop="closeList()"
                                                    @keydown.tab.prevent.stop="closeList()"
                                                    id="insurancetype"
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_type_id')"
                                                ></x-inputs.selexttext>
                                            </x-inputs.textgroup>
                                            <x-inputs.ul-select
                                                style="display: none"
                                                x-show="openselect"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-90"
                                            >
                                                @foreach ($this->types as $types)
                                                    <x-inputs.li-select
                                                        index="0"
                                                        x-on:click="setValuetext('{{ $types->insuratype_name }}')"
                                                    >
                                                        {{ $types->insuratype_name }}
                                                    </x-inputs.li-select>
                                                @endforeach

                                                <x-inputs.li-select
                                                    index="2"
                                                    x-on:click="setValuetext('Hola')"
                                                    isbuton="true"
                                                >
                                                    <x-buttons.newsmall
                                                        wire:click="openTypes()"
                                                    >
                                                        Nuevo
                                                    </x-buttons.newsmall>
                                                </x-inputs.li-select>
                                            </x-inputs.ul-select>
                                        </div>
                                        @error("insurance_type_id")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div
                                    class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9"
                                >
                                    <div class="relative sm:col-span-3">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Código"
                                                for="insurancecode"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_code"
                                                    id="insurancecode"
                                                    autocomplete="off"
                                                    maxlength="30"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_code')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_code")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-3">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="CUIT"
                                                for="nsurancecuit"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_cuit"
                                                    x-mask="99999999999999999999"
                                                    id="nsurancecuit"
                                                    autocomplete="off"
                                                    maxlength="20"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_cuit')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_cuit")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-3">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Estatus"
                                                for="insurancestate"
                                                required="yes"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model="form.dataobrasocial.state_id"
                                                    id="insurancestate"
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('state_id')"
                                                >
                                                    @foreach ($listState as $state)
                                                        <option
                                                            value="{{ $state->id }}"
                                                        >
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
                                </div>
                                <div
                                    class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9"
                                >
                                    <div class="relative sm:col-span-4">
                                        <div class="relative">
                                            <x-inputs.containligroup
                                                tangleValue="showProvince"
                                                stringFind="stringProvince"
                                            >
                                                <x-inputs.autocomplegroup
                                                    label="Provincia"
                                                    id="cprovicia"
                                                    required="yes"
                                                    namerror="province_id"
                                                    wmodel="stringProvince"
                                                    wprevent="closeList()"
                                                    wdebounce="searchProvince"
                                                    wreset="resetProvince()"
                                                    isdisabled="{{$isdisabled}}"
                                                ></x-inputs.autocomplegroup>
                                                @if ($listProvince)
                                                    <x-inputs.ligroup>
                                                        @foreach ($listProvince as $provincies)
                                                            <x-inputs.lioption
                                                                wire:key="{{$provincies->id}}"
                                                                wire:target="searchProvince"
                                                                @click.enter.stop="selectValue('cprovicia','{{$provincies->province_name}}')"
                                                                wire:click="resetValuesProvince"
                                                                wire:click.prevent.stop="selectProvince({{$provincies->id}})"
                                                                id="{{'province-'.$loop->iteration}}"
                                                            >
                                                                {{ $provincies->province_name }}
                                                            </x-inputs.lioption>
                                                        @endforeach
                                                    </x-inputs.ligroup>
                                                @endif
                                            </x-inputs.containligroup>
                                        </div>
                                        @error("province_id")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-3">
                                        <div class="relative">
                                            <x-inputs.containligroup
                                                tangleValue="showCity"
                                                stringFind="stringCity"
                                            >
                                                <x-inputs.autocomplegroup
                                                    label="Ciudad"
                                                    id="cciudad"
                                                    required="yes"
                                                    namerror="city_id"
                                                    wmodel="stringCity"
                                                    wprevent="closeList()"
                                                    wdebounce="searchCity"
                                                    wreset="resetCity()"
                                                    isdisabled="{{$isdisabled}}"
                                                ></x-inputs.autocomplegroup>
                                                @if ($listCities)
                                                    <x-inputs.ligroup>
                                                        @foreach ($listCities as $city)
                                                            <x-inputs.lioption
                                                                wire:key="{{$city->id}}"
                                                                @click.enter.stop="selectValue('cprovicia','{{$city->city_name}}')"
                                                                wire:click.prevent.stop="selectCity({{$city->id}})"
                                                                id="{{'city-'.$loop->iteration}}"
                                                            >
                                                                {{ $city->city_name }}
                                                            </x-inputs.lioption>
                                                        @endforeach
                                                    </x-inputs.ligroup>
                                                @endif
                                            </x-inputs.containligroup>
                                        </div>
                                        @error("city_id")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-2">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="C.P."
                                                for="insurancecpostal"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_zipcode"
                                                    id="insurancecpostal"
                                                    autocomplete="off"
                                                    maxlength="6"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_zipcode')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_zipcode")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div
                                    class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9"
                                >
                                    <div class="relative sm:col-span-6">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Dirección"
                                                for="insuranceaddres"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_address"
                                                    id="insuranceaddres"
                                                    autocomplete="off"
                                                    maxlength="220"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_address')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_address")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-3">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Teléfono"
                                                for="insurancephone"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_phone"
                                                    x-mask="99999999999999999999"
                                                    id="insurancephone"
                                                    autocomplete="off"
                                                    maxlength="20"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_phone')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_phone")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div
                                    class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9"
                                >
                                    <div class="relative sm:col-span-5">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Web"
                                                for="insuranceweb"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_web"
                                                    id="insuranceweb"
                                                    autocomplete="off"
                                                    maxlength="200"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_web')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_web")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                    <div class="relative sm:col-span-4">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Correo"
                                                for="insuranceemail"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    wire:model="form.dataobrasocial.insurance_email"
                                                    id="insuranceemail"
                                                    autocomplete="off"
                                                    maxlength="150"
                                                    placeholder=" "
                                                    isdisabled="{{$isdisabled}}"
                                                    :error="$errors->first('insurance_email')"
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_email")
                                            <x-inputs.error-validate>
                                                {{ $message }}
                                            </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <x-headerform.button-group>
                                    <x-buttons.cancel
                                        wire:click="Namefunction"
                                        label="Cancelar"
                                    ></x-buttons.cancel>
                                    <x-buttons.save
                                        wire:submit.prevent="insuraceQuery"
                                        wire:click.prevent="insuraceQuery"
                                        label="Guardar"
                                        :error="count($errors)"
                                    ></x-buttons.save>
                                </x-headerform.button-group>
                            </section>

                            <section
                                style="display: none"
                                x-show="isSelected('tab2')"
                                :aria-labelledby="isSelected('tab2') ? 'selected-tab' : 'not-selected-tab'"
                            >
                                Aquí tab 2.
                            </section>
                            <section
                                style="display: none"
                                x-show="isSelected('tab3')"
                                :aria-labelledby="isSelected('tab3') ? 'selected-tab' : 'not-selected-tab'"
                            >
                                Aquí tab 3.
                            </section>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <livewire:gestion.obra-socail-tipo></livewire:gestion.obra-socail-tipo>
</div>
