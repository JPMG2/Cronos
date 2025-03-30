@props([
    "label",
    "required" => false,
])
{{ $slot }}
@php
    $underline = $required
        ? "peer-focus:text-blue-900"
        : "peer-focus:text-blue-600";
    $textcolor = $required ? "text-gray-700" : "text-gray-500";
@endphp

<label
    {{ $attributes }}
    class="{{ $textcolor }} {{ $underline }} absolute start-0.5 top-2 z-10 origin-[0] -translate-y-3 scale-75 transform bg-transparent opacity-95 px-2 text-sm font-bold duration-300 peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-focus:top-2 peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:px-2 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:bg-gray-900 dark:text-gray-400 peer-focus:dark:text-blue-500"
>
    {{ $label }}
</label>
