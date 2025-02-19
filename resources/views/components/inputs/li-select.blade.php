@props(["index" => false, "isbuton" => false])
@php
    $hovercolor = $isbuton ? "" : "hover:bg-indigo-600 hover:text-white";
@endphp

<li
    {{ $attributes }}
    class="{{ $hovercolor }} relative cursor-default select-none py-1 pl-3 pr-9 text-gray-900 text-xs"
    id="listbox-option-{{ $index }}"
    role="option"
>
    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
    <span class="block truncate font-normal">
        {{ $slot }}
    </span>
</li>
