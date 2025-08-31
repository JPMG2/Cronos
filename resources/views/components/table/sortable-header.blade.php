@props([
    'columns' => [],
    'columName' => null,
    'sortDirection' => true,
    'searchable' => true,
    'columnFilter' => []
])

<x-table.thead>
    <!-- Header Row -->
    <tr class="h-2 p-0">
        @foreach($columns as $column)
            @if($column['sortable'] ?? false)
                <x-table.th wire:click="orderColumBy('{{ $column['field'] }}')">
                    <x-table.sortcolumn 
                        currentColumn="{{ $column['field'] }}" 
                        :columName="$columName"
                        :sortDirection="$sortDirection"
                    >
                        <div>{{ $column['label'] }}</div>
                    </x-table.sortcolumn>
                </x-table.th>
            @else
                <x-table.th>
                    {{ $column['label'] }}
                </x-table.th>
            @endif
        @endforeach
    </tr>

    <!-- Filter Row -->
    @if($searchable)
        <tr class="h-1 p-0">
            @foreach($columns as $column)
                <td>
                    @if($column['searchable'] ?? false)
                        <x-table.input-table-search 
                            {!! isset($column['width']) ? "withd=\"{$column['width']}\"" : '' !!}
                            {!! isset($column['maxlength']) ? "maxlength=\"{$column['maxlength']}\"" : '' !!}
                            {!! isset($column['mask']) ? "x-mask=\"{$column['mask']}\"" : '' !!}
                            wire:model.live.debounce="columnFilter.{{ $column['field'] }}"
                        />
                    @endif
                </td>
            @endforeach
        </tr>
    @endif
</x-table.thead>