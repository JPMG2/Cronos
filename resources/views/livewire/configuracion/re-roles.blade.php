<div>
    <x-breadcrum breadcrumbs="Roles"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Roles
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="openRoles;roleQuery">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                @if ($this->countRoles > 0)
                    <div
                        class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
                    >
                        <table
                            class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <x-table.thead>
                                <tr>
                                    <x-table.th>
                                        ID
                                    </x-table.th>
                                    <x-table.th>
                                        Rol
                                    </x-table.th>
                                    <x-table.th>
                                        Descripción
                                    </x-table.th>
                                    <x-table.th></x-table.th>
                                </tr>
                            </x-table.thead>
                            </thead>
                            <x-table.tablebody>
                                @foreach ($listRoles as $role)
                                    <tr
                                        class="hover:bg-blue-50 transition-colors duration-150 even:bg-gray-50 dark:even:bg-gray-700 dark:hover:bg-gray-600"
                                        wire:key="{{ $role->id }}"
                                    >
                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            {{ $loop->iteration }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                            {{ $role->name_role }}
                                        </x-table.tdtable>
                                        <x-table.tdtable typetext="txtnormal" break-words>
                                            {{ $role->description  }}
                                        </x-table.tdtable>
                                        <td
                                            class="flex items-center break-words px-3 py-1.5 text-sm text-gray-500 dark:text-gray-300"
                                        >
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $role->id }}"
                                                    wire:click.prevent="editRoles({{ $role->id }})"
                                                    wire:target="editRoles"
                                                    iconname="edit"
                                                ></x-table.accionopcion>
                                            </div>
                                            <div>
                                                <x-table.accionopcion
                                                    wire:key="{{ $role->id }}"
                                                    wire:click.prevent="deleteRole({{ $role->id }})"
                                                    wire:target="deleteRole"
                                                    iconname="delete"
                                                    isDelete="isDelete"
                                                ></x-table.accionopcion>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table.tablebody>
                        </table>
                    </div>

                @else
                    <x-alert windowtype="error">
                        No existen roles registrados.
                    </x-alert>
                @endif
            </div>
            @if(!session("isdisabled"))
                <x-butonbutton
                    wire:click="$toggle('showRoleModal')"
                ></x-butonbutton>
                <div>
                    <div x-data="{ open: @entangle("showRoleModal") }">
                        <x-rightmodal
                            style="display: none"
                            x-show="open"
                            closemodal="showRoleModal"
                            clearform="clearForm()"
                        >
                            <x-slot:title>Registro</x-slot>

                            <div class="mt-2 grid grid-cols-1 gap-4">
                                <div class="relative sm:col-span-1">
                                    <div class="relative">
                                        <x-inputs.textgroup
                                            label="Rol"
                                            for="namrole"
                                            required="yes"
                                        >
                                            <x-inputs.textinput
                                                wire:model="roleForm.dataRole.name_role"
                                                id="namrole"
                                                autocomplete="off"
                                                maxlength="100"
                                                placeholder=" "
                                                isdisabled=""
                                                :error="$errors->first('name_role')"
                                            ></x-inputs.textinput>
                                        </x-inputs.textgroup>
                                    </div>
                                    @error("name_role")
                                    <x-inputs.error-validate>
                                        {{ $message }}
                                    </x-inputs.error-validate>
                                    @enderror
                                </div>

                                <div class="relative w-full ">
                                    <x-inputs.labeltextarea
                                        label="Descripción"
                                        for="descriprole"
                                        required="yes"
                                    >
                                        <x-inputs.textarea
                                            wire:model="roleForm.dataRole.description"
                                            id="descriprole"
                                            rows="5"
                                        ></x-inputs.textarea>
                                    </x-inputs.labeltextarea>

                                </div>


                            </div>
                            <x-slot:buttons>
                                <form id="departamento" wire:submit.prevent="submit">
                                    @csrf

                                    <x-headerform.button-group>
                                        <x-buttons.close wire:click="$toggle('showRoleModal')"
                                                         @click="$wire.clearForm()"
                                        >
                                            {{ __("Cerrar") }}
                                        </x-buttons.close>
                                        <x-buttons.cancel
                                            wire:click="clearForm"
                                            label="Cancelar"
                                        ></x-buttons.cancel>
                                        <x-buttons.save
                                            wire:submit.prevent="roleQuery"
                                            wire:click.prevent="roleQuery"
                                            namefucion="roleQuery"
                                            label="Guardar"
                                            isdisabled=""
                                            :error="count($errors)"
                                        ></x-buttons.save>
                                    </x-headerform.button-group>

                                </form>
                            </x-slot:buttons>
                        </x-rightmodal>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
