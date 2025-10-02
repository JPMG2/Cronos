<div wire:show="show">

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm overflow-auto p-4"
    >
        <div class="m-3 mx-auto size-4/5">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-2xl dark:border-gray-600 dark:bg-gray-800 dark:shadow-2xl "
            >
                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-2 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl dark:border-gray-600 dark:from-gray-700 dark:to-gray-600"
                >
                    <x-formcomponent.modaltitle>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                  clip-rule="evenodd"/>
                        </svg>
                        Plan.
                    </x-formcomponent.modaltitle>

                    <button
                        wire:click="$set('show', false);$dispatch('clearColorOpcionMenu')"
                        type="button"
                        class="flex size-7 items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <x-close-modal></x-close-modal>
                    </button>
                </div>
                <div class="overflow-y-auto p-4">
                    <div class="space-y-3">
                        <!-- Personal Information Section -->
                        <x-formcomponent.formdivcontent
                            dstyle="from-slate-50  ring-slate-200  hover:from-slate-100 hover:to-slate-50 focus-within:from-slate-100 focus-within:to-slate-50">
                            <x-formcomponent.h3divtitle iconname="planes">
                                Información Plan
                            </x-formcomponent.h3divtitle>
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-10 xl:gap-4">
                                <div class="relative w-full col-span-3">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Código"
                                                for="codiplan"
                                                required="yes"
                                            >
                                                <x-inputs.textinput

                                                    wire:model="form.dataPrestadorPlan.insurance_plan_code"
                                                    id="codiplan"
                                                    autocomplete="off"
                                                    maxlength="220"
                                                    placeholder=" "
                                                    isdisabled=""
                                                    :error="$errors->first('insurance_plan_code')"
                                                    required
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_plan_code")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-5">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Nombre"
                                                for="nameplan"
                                                required="yes"
                                            >
                                                <x-inputs.textinput

                                                    wire:model="form.dataPrestadorPlan.insurance_plan_name"
                                                    id="nameplan"
                                                    autocomplete="off"
                                                    maxlength="220"
                                                    placeholder=" "
                                                    isdisabled=""
                                                    :error="$errors->first('insurance_plan_name')"
                                                    required
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_plan_name")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-2">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.selectgroup
                                                label="Estatus"
                                                for="prestaplanesta"
                                                required="yes"
                                            >
                                                <x-inputs.selectinput
                                                    wire:model.defer="form.dataPrestadorPlan.state_id"
                                                    id="prestaplanesta"
                                                    isdisabled=""
                                                >
                                                    @foreach ($this->states as $state)
                                                        <option value="{{ $state->id }}">
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
                                <div class="relative w-full col-span-4">
                                    <div class="relative"
                                         x-data="autocomplete()"
                                         x-init="isOpen = {{ count($listPrestadores) > 0 ? 'true' : 'false' }}"
                                         @click.away="close()"
                                    >
                                        <div class="relative">
                                            <x-simple-label label="Prestador">
                                                <div class="relative">
                                                    <input
                                                        type="text"
                                                        placeholder="buscar..."
                                                        autocomplete="off"
                                                        wire:model.live.debounce.300ms="form.dataPrestadorPlan.insurance_name"
                                                        @keydown="handleKeydown($event, {{ count($listPrestadores) }})"
                                                        @focus="isOpen = {{ count($listPrestadores) > 0 ? 'true' : 'false' }}"

                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                        <svg
                                                            type="button"
                                                            @click="clear('form.dataPrestadorPlan.insurance_name', 'form.dataPrestadorPlan.insurance_id')"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                            class="mr-1 h-4 w-4 cursor-pointer hover:text-red-500 transition-colors"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M6 18 18 6M6 6l12 12"
                                                            />
                                                        </svg>
                                                        <svg
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                            class="pointer-events-none h-5 w-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </x-simple-label>
                                            <div x-show="isOpen && {{ count($listPrestadores) }} > 0" x-cloak>
                                                <x-autocomplete.ulautocomplete>
                                                    @foreach ($listPrestadores as $index => $prestador)
                                                        <x-autocomplete.liautocomplete
                                                            @click="selectItem('{{ $prestador->id }}', '{{ $prestador->insurance_name }}', 'form.dataPrestadorPlan.insurance_id', 'form.dataPrestadorPlan.insurance_name')"
                                                            @mouseenter="selectedIndex = {{ $index }}"
                                                            ::class="isSelected({{ $index }}) ? 'bg-indigo-600 text-white' : 'text-gray-900 hover:bg-indigo-100'"
                                                        >
                                                            {{ $prestador->insurance_name }}
                                                        </x-autocomplete.liautocomplete>
                                                    @endforeach
                                                </x-autocomplete.ulautocomplete>
                                            </div>
                                        </div>
                                        @error("insurance_id")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-2">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Fecha inicio"
                                                for="planstart"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    x-data
                                                    autocomplete="off"
                                                    x-init="flatpickr($el, {
                                                        dateFormat: 'd-m-Y',
                                                        static: true,
                                                        theme: 'light',
                                                        monthSelectorType: 'static',
                                                        onReady: function(selectedDates, dateStr, instance) {
                                                            instance.calendarContainer.style.fontSize = '12px';
                                                            instance.calendarContainer.style.width = '305px';
                                                        }
                                                    })"
                                                    wire:model="form.dataPrestadorPlan.insurance_start_date"
                                                    id="planstart"
                                                    autocomplete="off"
                                                    maxlength="200"
                                                    placeholder=" "
                                                    isdisabled=""
                                                    :error="$errors->first('insurance_start_date')"
                                                    required
                                                ></x-inputs.textinput>

                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_start_date")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-2">
                                    <div class="relative">
                                        <div class="relative">
                                            <x-inputs.textgroup
                                                label="Fecha fin"
                                                for="planends"
                                                required="yes"
                                            >
                                                <x-inputs.textinput
                                                    x-data
                                                    autocomplete="off"
                                                    x-init="flatpickr($el, {
                                                        dateFormat: 'd-m-Y',
                                                        minDate: 'today',
                                                        static: true,
                                                        theme: 'light',
                                                        monthSelectorType: 'static',
                                                        onReady: function(selectedDates, dateStr, instance) {
                                                            instance.calendarContainer.style.fontSize = '12px';
                                                            instance.calendarContainer.style.width = '305px';
                                                        }
                                                    })"
                                                    wire:model="form.dataPrestadorPlan.insurance_end_date"
                                                    id="planends"
                                                    autocomplete="off"
                                                    maxlength="200"
                                                    placeholder=" "
                                                    isdisabled=""
                                                    :error="$errors->first('insurance_end_date')"
                                                    required
                                                ></x-inputs.textinput>
                                            </x-inputs.textgroup>
                                        </div>
                                        @error("insurance_end_date")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-2">
                                    <div class="flex flex-col">
                                        <x-simple-label label="Requiere Autorización"></x-simple-label>

                                        <div class="relative mt-4">
                                            <input
                                                wire:model="form.dataPrestadorPlan.authorisation"
                                                id="autrization"
                                                type="checkbox"
                                                value="">
                                        </div>

                                        @error("insurance_name")
                                        <x-inputs.error-validate>
                                            {{ $message }}
                                        </x-inputs.error-validate>
                                        @enderror
                                    </div>
                                </div>
                                <div class="relative w-full col-span-10">
                                    <x-inputs.labeltextarea
                                        label="Descripción"
                                        for="descriplan"
                                        required="yes"
                                    >
                                        <x-inputs.textarea
                                            wire:model="form.dataPrestadorPlan.insurance_plan_description"
                                            id="descriplan"
                                            rows="3"
                                        ></x-inputs.textarea>
                                    </x-inputs.labeltextarea>

                                </div>
                                <div class="relative w-full col-span-10">
                                    <x-inputs.labeltextarea
                                        label="Condiciones especiales"
                                        for="concicioplan"
                                        required="yes"
                                    >
                                        <x-inputs.textarea
                                            wire:model="form.dataPrestadorPlan.insurance_plan_condition"
                                            id="concicioplan"
                                            rows="3"
                                        ></x-inputs.textarea>
                                    </x-inputs.labeltextarea>

                                </div>
                            </div>
                        </x-formcomponent.formdivcontent>
                    </div>
                    <br>
                    <form
                        id="prestadorplan"
                        wire:submit.prevent="submit"
                    >
                        @csrf
                        <div
                            class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700"
                        >
                            <x-buttons.close
                                wire:click="$set('show', false);$dispatch('clearColorOpcionMenu')"
                            >
                                {{ __("Cerrar") }}
                            </x-buttons.close>
                            <x-buttons.save
                                wire:submit.prevent="submitPrestadorPlan"
                                wire:click.prevent="submitPrestadorPlan"
                                namefucion=""
                                label="Guardar"
                                isdisabled=""
                                :error="count($errors)"
                            ></x-buttons.save>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
