<div>
    <x-breadcrum breadcrumbs="Sucursales"></x-breadcrum>

    <x-company-watcher></x-company-watcher>

    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        @if(!session("isdisabled"))
            @if ($this->branchs > 0)
                @livewire("utility.opcion-menu", ["namecomponent" => "branch"])
            @endif
        @endif

        <x-headerform.borderheader></x-headerform.borderheader>

        <!-- start:: Multiple Columns -->
        <div>
            <div class="flex items-center">
                <x-formcomponent.titleform>Datos de sucursal</x-formcomponent.titleform>
                <x-formcomponent.titleindicator
                    wire:loading
                    wire:target="queryBranch, branchShow, branchHistory"></x-formcomponent.titleindicator>
            </div>

            <div class="mt-3 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Empresa"
                            for="companyid"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                x-ref="ini"
                                wire:model="form.databranch.company_id"
                                id="companyid"
                                isdisabled="disabled"
                                :error="$errors->first('company_id')"
                            >
                                @foreach ($listCompanies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("company_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-4">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Sucursal"
                            for="brname"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_name"
                                id="brname"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_name')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_name")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Código"
                            for="brcucode"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_code"
                                id="brcucode"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_code')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_code")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="flex gap-x-1 sm:col-span-3">
                    <div class="relative w-2/5 sm:col-span-3">
                        <div class="relative">
                            <x-inputs.selectgroup
                                label="Estatus"
                                for="brstate"
                                required="yes"
                            >
                                <x-inputs.selectinput
                                    wire:model.defer="form.databranch.state_id"
                                    id="brstate"
                                    isdisabled="{{$isdisabled}}"
                                >
                                    @foreach ($listState as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->state_name }}
                                        </option>
                                    @endforeach
                                </x-inputs.selectinput>
                            </x-inputs.selectgroup>
                        </div>
                        <x-inputs.error-validate></x-inputs.error-validate>
                    </div>
                    <div class="relative w-3/5 sm:col-span-2">
                        <div class="relative">
                            <x-inputs.textgroup
                                label="Teléfono"
                                for="brtelefono"
                                required="yes"
                            >
                                <x-inputs.textinput
                                    wire:model="form.databranch.branch_phone"
                                    x-mask="99999999999999999999"
                                    id="brtelefono"
                                    autocomplete="off"
                                    maxlength="20"
                                    placeholder=" "
                                    isdisabled="{{$isdisabled}}"
                                    :error="$errors->first('branch_phone')"
                                ></x-inputs.textinput>
                            </x-inputs.textgroup>
                        </div>
                        @error("branch_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    </div>
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Correo"
                            for="brcorreo"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_email"
                                id="brcorreo"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_email')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_email")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup label="Web" for="brweb">
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_web"
                                id="brweb"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_web')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_web")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
            </div>
            <div class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-6">
                <div class="relative sm:col-span-3">
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
            </div>
            <div class="mt-3 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-6">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Dirección"
                            for="brdireccion"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_address"
                                id="brdireccion"
                                autocomplete="off"
                                maxlength="220"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_address')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_address")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="C.P."
                            for="brcpostal"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_zipcode"
                                id="brcpostal"
                                autocomplete="off"
                                maxlength="6"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_zipcode')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_zipcode")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
            </div>
            <div class="mt-1.5">
                <h4 class="font-titles text-xl text-blue-950">
                    Datos de contacto
                </h4>
            </div>
            <div class="mt-1 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Contacto"
                            for="brpersoncontact"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_person_contact"
                                id="brpersoncontact"
                                autocomplete="off"
                                maxlength="220"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_person_contact')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_person_contact")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Teléfono"
                            for="brtelefonocon"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_person_phone"
                                x-mask="99999999999999999999"
                                id="brtelefonocon"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_person_phone')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_person_phone")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Correo"
                            for="brcorreocon"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.databranch.branch_person_email"
                                id="brcorreocon"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('branch_person_email')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("branch_person_email")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
            </div>
            @if(!session("isdisabled"))
                <form
                    id="sucursal"
                    wire:submit.prevent="submit"
                    x-init="$refs.ini.focus()"
                >
                    @csrf
                    <x-headerform.button-group>
                        <x-buttons.cancel
                            wire:click="clearForm"
                            label="Cancelar"
                        ></x-buttons.cancel>
                        @can("created", $this->actions)
                            <x-buttons.save
                                wire:submit.prevent="queryBranch"
                                wire:click.prevent="queryBranch"
                                namefucion="queryBranch"
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
    @livewire("registro.list-branch", ["show" => false])
</div>
