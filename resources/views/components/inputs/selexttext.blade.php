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
    class="border-1 {{ $errorColor }} {{ $disableatributs }} peer block w-full
    appearance-none rounded-lg bg-transparent px-2.5 pb-1 pt-3.5 text-sm text-gray-900
    focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white
    dark:focus:border-blue-500 "
    aria-haspopup="listbox"
    aria-expanded="true"
    aria-labelledby="listbox-label"
/>
<span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
    <svg
        class="h-5 w-5 text-gray-400"
        viewBox="0 0 20 20"
        fill="currentColor"
        aria-hidden="true"
    >
        <path
            fill-rule="evenodd"
            d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
            clip-rule="evenodd"
        />
    </svg>
</span>
