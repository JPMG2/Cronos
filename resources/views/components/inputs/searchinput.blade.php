@props([
    "error" => false,
    "isdisabled" => false,
    "resetValues" => false,
])

@php
    $errorColor = $error ? "border-red-300" : "border-gray-300";

    if ($isdisabled) {
        $disableatributs = "disabled:cursor-not-allowed disabled:bg-gray-100";
    } else {
        $disableatributs = "";
    }
@endphp

<div>
    <input
        {{ $attributes }}
        {{ $isdisabled }}
        type="text"
        class="border-1 {{ $errorColor }} {{ $disableatributs }} peer block w-full appearance-none rounded-lg bg-transparent px-2.5 pb-2.5 py-2 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
    />

    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
        <svg
            type="button"
            x-show="show"
            @click="closeList();{{ $resetValues }}"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-1 h-4 w-4"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18 18 6M6 6l12 12"
            />
        </svg>

        <svg
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="pointer-events-none h-5 w-5"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
            />
        </svg>
    </div>
</div>
