<div>
    <x-breadcrum breadcrumbs="Horario"></x-breadcrum>
    <x-company-watcher></x-company-watcher>
    <div
        class="relative mx-1.5 mt-4 grid grid-cols-1 gap-1 rounded-lg bg-white p-4 shadow-xl"
    >
        <x-headerform.borderheader></x-headerform.borderheader>
        <div>
            <div class="flex items-center">
                <div>
                    <h4 class="font-titles text-xl text-blue-950">
                        Horario
                    </h4>
                </div>
                <div class="ml-2" wire:loading wire:target="querySchedule">
                    <span class="loading loading-bars loading-xs"></span>
                </div>
            </div>
            <div class="overflow-y-auto p-4">
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
                                    Día
                                </x-table.th>
                                <x-table.th>
                                    Atiende
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Inicio
                                        <span class="block">Mañana</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Fin
                                        <span class="block">Mañana</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Inicio
                                        <span class="block">Tarde</span>
                                    </div>
                                </x-table.th>
                                <x-table.th>
                                    <div class="text-center -ml-20">
                                        Hora Fin
                                        <span class="block">Tarde</span>
                                    </div>
                                </x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tablebody

                        >

                            @foreach ($this->days as $day)
                                <tr
                                    class="even:bg-gray-100"
                                    wire:key="{{ $loop->iteration }}"
                                >
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        {{ $day->getName() }}
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant">

                                        <label for="{{'horaio'.$loop->index}}">
                                            <input
                                                x-data="checkDay('{{$loop->index}}')"
                                                @click="activeDay($event.target.checked)"
                                                x-init="checkInitialState($el.checked)"
                                                id="{{'horaio'.$loop->index}}" type="checkbox"
                                                value="{{ $day->getName() }}"/>
                                        </label>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <x-inputs.timeinput
                                                x-ref="{{'starmorning'.$loop->index}}"
                                                nameinput="{{ $day->getName().'startm' }}"
                                                idinput="{{ $day->getName().'startm' }}"
                                            />
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <x-inputs.timeinput
                                                x-ref="{{'endmorning'.$loop->index}}"
                                                nameinput="{{ $day->getName().'endm' }}"
                                                idinput="{{ $day->getName().'endm' }}"
                                            />
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <x-inputs.timeinput
                                                x-ref="{{'starafter'.$loop->index}}"
                                                nameinput="{{ $day->getName().'starta' }}"
                                                idinput="{{ $day->getName().'starta' }}"
                                            />
                                        </div>
                                    </x-table.tdtable>
                                    <x-table.tdtable typetext="txtimportant" whitespace-nowrap>
                                        <div

                                            class="relative flex-1 w-24 flex items-center"
                                        >
                                            <x-inputs.timeinput
                                                x-ref="{{'endafter'.$loop->index}}"
                                                nameinput="{{ $day->getName().'enda' }}"
                                                idinput="{{ $day->getName().'enda' }}"
                                            />
                                        </div>

                                    </x-table.tdtable>
                                </tr>
                            @endforeach

                        </x-table.tablebody>
                        </thead>
                    </table>
                </div>
                <form
                    id="scheduleForm"
                    wire:submit.prevent="submit"

                >
                    @csrf
                    <x-headerform.button-group>
                        <x-buttons.cancel
                            wire:click="clearForm"
                            label="Cancelar"
                        ></x-buttons.cancel>

                        <x-buttons.save
                            wire:submit.prevent="querySchedule"
                            wire:click.prevent="querySchedule"
                            namefucion=""
                            label="Guardar"
                            isdisabled=""
                            :error="count($errors)"
                        ></x-buttons.save>

                    </x-headerform.button-group>
                </form>
            </div>


        </div>
    </div>
</div>
@script
<script>
    Alpine.data('checkDay', (numberDay) => {
        return {
            checkInitialState(isChecked) {

                if (!isChecked) {
                    const inputms = document.querySelector(`[x-ref="starmorning${numberDay}"]`);
                    const inputme = document.querySelector(`[x-ref="endmorning${numberDay}"]`);
                    const inputas = document.querySelector(`[x-ref="starafter${numberDay}"]`);
                    const inputae = document.querySelector(`[x-ref="endafter${numberDay}"]`);


                    if (inputms && inputme && inputas && inputae) {
                        inputms.disabled = !isChecked;
                        inputme.disabled = !isChecked;
                        inputas.disabled = !isChecked;
                        inputae.disabled = !isChecked;
                    }

                }
            },

            activeDay: function (ischecked) {
                const inputms = document.querySelector(`[x-ref="starmorning${numberDay}"]`);
                const inputme = document.querySelector(`[x-ref="endmorning${numberDay}"]`);
                const inputas = document.querySelector(`[x-ref="starafter${numberDay}"]`);
                const inputae = document.querySelector(`[x-ref="endafter${numberDay}"]`);
                inputms.disabled = !ischecked;
                inputme.disabled = !ischecked;
                inputas.disabled = !ischecked;
                inputae.disabled = !ischecked;
                if (ischecked) {
                    inputms.focus();
                } else {
                    inputms.value = '';
                    inputme.value = '';
                    inputas.value = '';
                    inputae.value = '';
                }
            }
        }
    })
</script>
@endscript
