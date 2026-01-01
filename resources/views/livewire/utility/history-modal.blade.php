<div>
    <x-modal name="history-modal" :show>
        <x-slot:heading>
            {{ $historyTitle }}
        </x-slot>

        @if (! is_null($listHistoryData) && ! empty($listHistoryData) && count($listHistoryData->log) > 0)
            <div
                class="overflow-hidden border border-gray-200 md:rounded-lg"
            >
                <table
                    class="table-xs min-w-full divide-y divide-gray-200"
                >
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right"
                            >
                                ID
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right"
                            >
                                Usuario
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right"
                            >
                                Acción
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right"
                            >
                                Registro
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right"
                            >
                                Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white"
                    >

                        @foreach ($listHistoryData->log as $data)
                            <tr class="even:bg-gray-100:bg-gray-800">
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700"
                                >
                                    <div
                                        class="inline-flex items-center gap-x-3"
                                    >
                                        <span>
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700"
                                >
                                    {{ $data->user->full_name }}
                                </td>
                                <td
                                    class="break-words px-3 py-2 text-sm text-gray-500"
                                >
                                    {{ $data->action->action_inpass }}
                                </td>

                                <td
                                    wire:key="{{ $data->id }}"
                                    class="break-words px-3 py-2 text-sm text-gray-500"
                                >
                                    <x-model-update
                                        queryaccion="{{$data->action->id}}"
                                        modelObj="{{$data->model_type}}"
                                        modelId="{{$data->model_id}}"
                                        logId="{{$data->id}}"
                                    />
                                </td>
                                <td
                                    class="break-words px-3 py-2 text-sm text-gray-500"
                                >
                                    {{ $data->created_at->format("d/m/Y H:i:s") }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <x-alert windowtype="error">No existen datos.</x-alert>
        @endif
    </x-modal>
</div>
