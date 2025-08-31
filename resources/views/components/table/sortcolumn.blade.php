@props([
    'currentColumn',
    'sortField',
    'sortDirection'
])
<div class="flex items-center gap-2 group cursor-pointer group">
    {{ $slot }}
    @if($sortField === $currentColumn)
        <div>
            @if($sortDirection)
                <x-table.sortdown></x-table.sortdown>
            @else
                <x-table.sortup></x-table.sortup>
            @endif
        </div>
    @else
        <x-table.sorticon></x-table.sorticon>
    @endif
</div>
