@props([
    "error" => false,
    "isdisabled" => false,
])

@php
    $errorColor = $error ? "border-red-300" : "border-gray-300";
    if ($isdisabled) {
        $disableatributs = "disabled:cursor-not-allowed disabled:bg-gray-100";
    } else {
        $disableatributs = "";
    }
@endphp

<input
    {{ $attributes }}
    type="text"

    {{ $isdisabled }}
    class="border-1 {{ $errorColor }} {{ $disableatributs }}
    peer w-full appearance-none rounded-lg bg-transparent
    px-2.5 pb-1 pt-4 text-sm text-gray-900
    leading-none focus:border-blue-600 focus:outline-none focus:ring-0
    dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
/>
