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
                        Datos de empresa
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryCompany">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>

            <div class="mt-3 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-4">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Empresa"
                            for="cempresa"
                            required="yes"
                        >
                            <x-inputs.textinput
                                x-ref="ini"
                                wire:model="form.datacompany.company_name"
                                id="cempresa"
                                autocomplete="off"
                                maxlength="200"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('company_name')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_name")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="CUIT"
                            for="ccuit"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_cuit"
                                x-mask="999999999999999999"
                                id="ccuit"
                                autocomplete="off"
                                maxlength="18"
                                placeholder=" "
                                isdisabled="{{$isdisabled}}"
                                :error="$errors->first('company_cuit')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_cuit")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Estatus"
                            for="rounded_select"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model.defer="form.datacompany.state_id"
                                id="rounded_select"
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
            </div>
            <div class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Teléfono"
                            for="ctelefono"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_phone"
                                x-mask="999999999999999999"
                                id="ctelefono"
                                autocomplete="off"
                                maxlength="18"
                                placeholder=" "
                                :error="$errors->first('company_phone')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Correo"
                            for="ccorreo"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_email"
                                id="ccorreo"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                :error="$errors->first('company_email')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_email")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-4">
                    <div class="relative">
                        <x-inputs.textgroup label="Web" for="cweb">
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_web"
                                id="cweb"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                :error="$errors->first('company_web')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_web")
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
            <div class="mt-2 grid grid-cols-1 gap-x-2 gap-y-2 sm:grid-cols-6">
                <div class="relative sm:col-span-4">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Dirección"
                            for="cdireccion"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_address"
                                id="cdireccion"
                                autocomplete="off"
                                maxlength="220"
                                placeholder=" "
                                :error="$errors->first('company_address')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_address")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-2">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="C.P."
                            for="ccpostal"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_zipcode"
                                id="ccpostal"
                                autocomplete="off"
                                maxlength="6"
                                placeholder=" "
                                :error="$errors->first('company_zipcode')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_zipcode")
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
                            for="cpersoncontact"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_person_contact"
                                id="cpersoncontact"
                                autocomplete="off"
                                maxlength="220"
                                placeholder=" "
                                :error="$errors->first('company_person_contact')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_person_contact")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Teléfono"
                            for="ctelefonocon"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_person_phone"
                                x-mask="99999999999999999999"
                                id="ctelefonocon"
                                autocomplete="off"
                                maxlength="20"
                                placeholder=" "
                                :error="$errors->first('company_person_phone')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_person_phone")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
                <div class="relative sm:col-span-3">
                    <div class="relative">
                        <x-inputs.textgroup
                            label="Correo"
                            for="ccorreocon"
                            required="yes"
                        >
                            <x-inputs.textinput
                                wire:model="form.datacompany.company_person_email"
                                id="ccorreocon"
                                autocomplete="off"
                                maxlength="150"
                                placeholder=" "
                                :error="$errors->first('company_person_email')"
                            ></x-inputs.textinput>
                        </x-inputs.textgroup>
                    </div>
                    @error("company_person_email")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                    @enderror
                </div>
            </div>
            <form
                id="company"
                wire:submit.prevent="submit"
                x-init="$refs.ini.focus()"
            >
                @csrf
                <x-headerform.button-group>
                    <x-buttons.cancel
                        wire:click="cleanForm"
                        label="Cancelar"
                    ></x-buttons.cancel>
                    <x-buttons.save
                        wire:submit.prevent="queryCompany"
                        wire:click.prevent="queryCompany"
                        namefucion="queryCompany"
                        label="Guardar"
                        :error="count($errors)"
                    ></x-buttons.save>
                </x-headerform.button-group>
            </form>
        </div>
    </div>
    <!-- end:Page content -->
</div>
