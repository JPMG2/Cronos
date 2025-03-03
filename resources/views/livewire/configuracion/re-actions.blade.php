<div>
    <x-breadcrum breadcrumbs="Permisos"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Permisos
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="queryActionRole">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
                <div class="relative sm:col-span-3 w-2/5">
                    <div class="relative">
                        <x-inputs.selectgroup
                            label="Role"
                            for="actionrole"
                            required="yes"
                        >
                            <x-inputs.selectinput
                                wire:model="actionForm.dataaction.role_id"
                                wire:change="roleValue"
                                id="actionrole"
                                x-ref="ini"
                                :error="$errors->first('role_id')"
                            >
                                <option label=" "></option>
                                @foreach ($listRoles as $role)
                                    <option class="pt-1.5" value="{{ $role->id }}">
                                        {{ $role->name_role }}
                                    </option>
                                @endforeach

                            </x-inputs.selectinput>
                        </x-inputs.selectgroup>
                    </div>
                    @error("role_id")
                    <x-inputs.error-validate>
                        {{ $message }}
                    </x-inputs.error-validate>
                    @enderror
                </div>
                <div
                    class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700 mt-1"
                >
                    <table
                        class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <x-table.thead>
                            <tr>
                                <x-table.th>
                                    ID
                                </x-table.th>
                                <x-table.th>
                                    Permiso
                                </x-table.th>
                                <x-table.th>
                                    Acción
                                </x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tablebody>
                            @foreach ($listActions as $action)
                                <tr
                                    class="even:bg-gray-100"
                                    wire:key="{{ $action->id }}"
                                >
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        {{ $loop->iteration }}
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        {{ $action->action_sp }}
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <label for="{{'action'.$action->id}}">
                                            <input
                                                wire:model="actionForm.dataaction.action_id"
                                                id="{{'action'.$action->id}}" type="checkbox"
                                                value="{{ $action->id }}"/>
                                        </label>
                                    </x-table.tdtable>
                                </tr>
                            @endforeach
                        </x-table.tablebody>
                    </table>

                </div>
                @error("action_id")
                <x-inputs.error-validate>
                    {{ $message }}
                </x-inputs.error-validate>
                @enderror
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

                            <x-buttons.save
                                wire:submit.prevent="queryActionRole"
                                wire:click.prevent="queryActionRole"
                                namefucion="queryActionRole"
                                label="Guardar"
                                isdisabled="{{$isdisabled}}"
                                :error="count($errors)"
                            ></x-buttons.save>

                        </x-headerform.button-group>
                    </form>
                @endif
            </div>

        </div>
    </div>
</div>
