@props(["idstatecolor" => false])

@php
    if ($idstatecolor == 1) {
        $stycolor = "bg-green-300 text-green-800 ";
    }
    if ($idstatecolor == 2) {
        $stycolor = "bg-red-400 text-red-800";
    }
@endphp

<div
    class="{{ $stycolor }} inline-flex items-center gap-x-2 rounded-full px-3 py-1 dark:bg-gray-800"
>
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
        <path
            d="M10 3L4.5 8.5L2 6"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
    </svg>

    <h2 class="text-sm font-normal">
        {{ $slot }}
    </h2>
</div>
