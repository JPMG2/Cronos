<div>
    <x-breadcrum breadcrumbs="Registro"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        @if(!session("isdisabled"))
            @if($this->countInsurance > 0)
                @livewire("utility.opcion-menu", ["namecomponent" => "obrasocial"])
            @endif
        @endif
        <x-headerform.borderheader></x-headerform.borderheader>
        <div class="flex items-center">
            <x-formcomponent.titleform>Datos Obra social</x-formcomponent.titleform>
            <x-formcomponent.titleindicator
                wire:loading
                wire:target="insuraceQuery,openTypes"></x-formcomponent.titleindicator>
        </div>


        <div
            x-data
            x-init="$refs.insurancename.focus()"
            class="mt-3 grid grid-cols-1 gap-x-2  gap-y-2 sm:grid-cols-9"
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
                         textselected: @entangle("form.dataobrasocial.insurance_type_name"),
                         idTypeInsurance: @entangle("form.dataobrasocial.insurance_type_id"),
                         openSelect() {
                                  this.openselect = ! this.openselect
                         },
                         closeList() {
                                this.openselect = false
                         },
                         setValuetext(name,id) {
                                 this.textselected = name
                                 this.idTypeInsurance = id
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

                            wire:model="form.dataobrasocial.insurance_type_name"
                            wire:click="getTypesProperty"
                            x-on:click="openSelect()"
                            x-on:click.away="closeList()"
                            x-model="textselected"
                            @keydown.escape.prevent.stop="closeList()"
                            @keydown.tab.prevent.stop="closeList()"
                            id="insurancetype"
                            isdisabled="{{$isdisabled}}"
                            autocomplete="off"
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
                        x-on:mouseleave="closeList()"
                    >
                        @if(count($this->types) > 0)
                            @foreach ($this->types as $types)
                                <x-inputs.li-select
                                    index="{{ $loop->iteration }}"
                                    x-on:click="setValuetext('{{ $types->insuratype_name }}','{{ $types->id }}')"
                                >
                                    {{ $types->insuratype_name }}
                                </x-inputs.li-select>
                            @endforeach
                        @else
                            <x-inputs.li-select
                                index="0"
                            >
                                Sin datos
                            </x-inputs.li-select>
                        @endif
                        @can("created", $this->actions)
                            <x-inputs.li-select
                                isbuton="true"
                            >
                                <x-buttons.newsmall
                                    wire:click="openTypes()"
                                >
                                    Nuevo
                                </x-buttons.newsmall>
                            </x-inputs.li-select>
                        @endcan
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
                    <x-inputs.textgroup
                        label="Código de registro"
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
                            isdisabled="{{$isdisabled}}"
                            @click.away="closeAway()"
                            @click="seeValues()"
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
                @error("province_id")
                <x-inputs.error-validate>
                    {{ $message }}
                </x-inputs.error-validate>
                @enderror
            </div>
            <div class="relative sm:col-span-3">
                <x-inputs.containautocomplete
                    modelString="stringCity"
                    showModel="showCity"
                    modelId="id_city"
                >
                    <div class="relative">
                        <x-inputs.searchinput
                            :error="$errors->first('city_id')"
                            x-on:keyup="findCity()"
                            wire:model="stringCity"
                            @keydown.escape.prevent.stop="closeList()"
                            isdisabled="{{$isdisabled}}"
                            @click.away="closeAway()"
                            placeholder="buscar..."
                            @click="seeValues()"
                        ></x-inputs.searchinput>
                        <x-inputs.labelsearch required="yes">
                            Ciudad
                        </x-inputs.labelsearch>
                        @if (count($listCities) > 0)
                            <x-inputs.ligroup>
                                @foreach ($listCities as $city)
                                    <x-inputs.lioption
                                        x-on:click="setValuesCity('{{$city->id}}','{{$city->city_name}}')"
                                    >
                                        {{ $city->city_name }}
                                    </x-inputs.lioption>
                                @endforeach
                            </x-inputs.ligroup>
                        @endif
                    </div>
                </x-inputs.containautocomplete>
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
        @if(!session("isdisabled"))
            <form
                id="obrasocial"
                wire:submit.prevent="submit"
            >
                @csrf
                <x-headerform.button-group>
                    <x-buttons.cancel
                        wire:click="clearForm"
                        label="Cancelar"
                    ></x-buttons.cancel>
                    @can("created", $this->actions)
                        <x-buttons.save
                            wire:submit.prevent="insuraceQuery"
                            wire:click.prevent="insuraceQuery"
                            label="Guardar"
                            :error="count($errors)"
                        ></x-buttons.save>
                    @endcan
                </x-headerform.button-group>
            </form>
        @endif
    </div>
    @livewire("gestion.obra-social-tipo")
    @livewire("gestion.list-obra-social", ["show" => false])

</div>
