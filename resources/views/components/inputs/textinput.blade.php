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
    class="border-1 {{ $errorColor }} {{ $disableatributs }} peer block w-full appearance-none rounded-lg bg-transparent px-2.5 pb-2.5 py-2 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
/>
