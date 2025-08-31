@props([
    'table' => null,
    'columName' => null,
    'sortDirection' => true,
    'searchable' => true,
    'columnFilter' => []
])

@php
    $columns = config("table_columns.{$table}", []);
@endphp

<x-table.sortable-header 
    :columns="$columns"
    :columName="$columName"
    :sortDirection="$sortDirection"
    :searchable="$searchable"
    :columnFilter="$columnFilter"
/>