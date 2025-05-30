@props(["isdisabled" => false, "error" => false])
@php
    $errorColor = $error ? "border-red-300" : "border-gray-300";
    if ($isdisabled) {
        $disableatributs = "disabled:cursor-not-allowed disabled:bg-gray-100";
    } else {
        $disableatributs = "";
    }
@endphp

<div>
    <select
        {{ $attributes }}
        {{ $isdisabled }}

        class="{{ $disableatributs }} {{ $errorColor }}
            block border-1 w-full appearance-none rounded-lg bg-transparent
            px-2.5 pt-2 pb-2 text-sm   {{ $isdisabled ? 'disabled:text-gray-950 opacity-100' : 'text-gray-900' }}
            focus:outline-none focus:ring-0 dark:text-white"

    >

        {{ $slot }}
    </select>
</div>
