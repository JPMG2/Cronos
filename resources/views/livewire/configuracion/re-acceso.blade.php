<div>
    <x-breadcrum breadcrumbs="Accesos"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Accesos
                    </h4>
                </div>
                <div class="ml-2" wire:loading
                     wire:target="queryActionAccion,loadMenus">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>

            <!-- start::Inbox -->
            <div class="w-full bg-white shadow-xl rounded-lg flex overflow-x-auto custom-scrollbar">
                <div class="w-64 px-4">

                    <div class="px-2 pt-4 pb-8 border-r border-gray-300">
                        <div class="space-y-2">
                            <div class="relative sm:col-span-3 ">
                                <div class="relative">
                                    <x-inputs.selectgroup
                                        label="Role"
                                        for="accionrole"
                                        required="yes"
                                    >
                                        <x-inputs.selectinput
                                            wire:model="accesoForm.dataacceso.role_id"
                                            id="accionrole"
                                            x-ref="ini"
                                            :error="$errors->first('role_id')"
                                            @change="$wire.loadMenus"
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
                            <div class="relative sm:col-span-3 ">
                                <x-menu-actions></x-menu-actions>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 px-2">
                    @if(count($listOptionMenu)>0)
                        <div class="flex justify-between items-center text-gray-800 font-bold pb-1 mb-2 border-b-2">
                            <h4 class="text-lg mt-0.5">{{$nameMenu}}</h4>

                        </div>
                        <div
                            class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
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
                                            Menú
                                        </x-table.th>
                                        <div wire:key="{{$idMenu}}">
                                            <x-table.th

                                            >
                                                <x-table.check-all
                                                    :idMenu="$idMenu"
                                                    :idOptionMenu="$idOptionMenu"


                                                ></x-table.check-all>
                                            </x-table.th>
                                        </div>
                                    </tr>
                                </x-table.thead>
                                <x-table.tablebody>
                                    @foreach ($listOptionMenu as $menuoption)

                                        <tr
                                            class="hover:bg-blue-50 transition-colors duration-150 even:bg-gray-50 dark:even:bg-gray-700 dark:hover:bg-gray-600"
                                            wire:key="{{ $menuoption->id }}"
                                        >
                                            <x-table.tdtable typetext="txtimportant">
                                                {{ $loop->iteration }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant">
                                                {{ $menuoption->grup_menu }}
                                            </x-table.tdtable>
                                            <x-table.tdtable typetext="txtimportant">
                                                <div x-data="checkItem({{$idMenu}},{{ json_encode($idOptionMenu) }})">
                                                    <label for="{{'menurole'.$menuoption->id}}">
                                                        <input
                                                            wire:model="accesoForm.dataacceso.menu_options"
                                                            id="{{'menurole'.$menuoption->id}}" type="checkbox"
                                                            @change="valueCheck"
                                                            value="{{ $menuoption->id }}"/>
                                                    </label>
                                                </div>
                                            </x-table.tdtable>
                                        </tr>
                                    @endforeach
                                </x-table.tablebody>
                            </table>
                        </div>
                        @error("menu_options")
                        <x-inputs.error-validate>
                            {{ $message }}
                        </x-inputs.error-validate>
                        @enderror
                    @endif
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

                        <x-buttons.save
                            wire:submit.prevent="queryActionAccion"
                            wire:click.prevent="queryActionAccion"
                            namefucion="queryActionAccion"
                            label="Guardar"

                            :error="count($errors)"
                        ></x-buttons.save>

                    </x-headerform.button-group>
                </form>
            @endif

        </div>
    </div>
</div>
@script
<script>
    Alpine.data('checkItem', (idMenu, optionMenu) => {

        return {
            optionMenu: Object.values(optionMenu),
            checkValue: 0,
            valueCheck(e) {
                this.checkValue = e.target.value
                this.CheckAllitem()
            },
            CheckAllitem() {
                let statusckeck = false
                this.optionMenu.forEach(item => {
                    let ischecked = document.getElementById('menurole' + item).checked
                    if (ischecked) {
                        statusckeck = true
                    }
                })
                if (statusckeck) {
                    if (this.$wire.accesoForm.dataacceso.menu_id.map(Number).includes(idMenu)) return
                    this.$wire.accesoForm.dataacceso.menu_id.push(idMenu)

                    if (this.$wire.accesoForm.dataacceso.menu_options.map(Number).includes(this.checkValue)) return
                    this.$wire.accesoForm.dataacceso.menu_options.push(this.checkValue)


                } else {
                    this.$wire.accesoForm.dataacceso.menu_id = this.$wire.accesoForm.dataacceso.menu_id.filter(
                        item => item !== idMenu
                    )
                    this.$wire.accesoForm.dataacceso.menu_options = this.$wire.accesoForm.dataacceso.menu_options.filter(
                        item => item !== this.checkValue
                    )
                }


            }
        }
    })
</script>
@endscript
