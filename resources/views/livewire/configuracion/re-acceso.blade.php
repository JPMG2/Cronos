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
            </div>
        </div>
    </div>
</div>
