<div>
    <x-modal name="history-modal" :show>
        <x-slot:heading>
            {{ $historyTitle }}
        </x-slot>

        @if (! is_null($listHistoryData) && ! empty($listHistoryData) && count($listHistoryData->log) > 0)
            <div
                class="overflow-hidden border border-gray-200 md:rounded-lg dark:border-gray-700"
            >
                <table
                    class="table-xs min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            >
                                ID
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            >
                                Usuario
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            >
                                Acción
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            >
                                Registro
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            >
                                Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900"
                    >

                        @foreach ($listHistoryData->log as $data)
                            <tr class="even:bg-gray-100">
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200"
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
                                    class="break-words px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                >
                                    {{ $data->action->action_inpass }}
                                </td>

                                <td
                                    wire:key="{{ $data->id }}"
                                    class="break-words px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
                                >
                                    <x-model-update
                                        queryaccion="{{$data->action->id}}"
                                        modelObj="{{$data->model_type}}"
                                        modelId="{{$data->model_id}}"
                                        logId="{{$data->id}}"
                                    />
                                </td>
                                <td
                                    class="break-words px-3 py-2 text-sm text-gray-500 dark:text-gray-300"
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
