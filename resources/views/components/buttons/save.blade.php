@props([
    "label",
    "namefucion" => false,
    "error" => false,
    "isdisabled" => false,
])
@php
    if (! empty($isdisabled)) {
        $mousepointer = "cursor-not-allowed";
    } else {
        $mousepointer = "";
    }
@endphp

<div>
    <button
        {{ $attributes }}
        type="button"
        {{ $isdisabled ? "disabled" : "" }}
        class="{{ $mousepointer }} inline-flex items-center rounded-md bg-btn_succes px-3 py-1.5 text-sm font-semibold text-white shadow-lg shadow-shw_succes hover:bg-green-400"
    >
        <div
            wire:loading
            wire:target="{{ $namefucion }}"
            style="display: none"
            class="flex items-center justify-center"
        >
            <svg
                class="-ml-1 mr-3 h-5 w-5 animate-spin text-white"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
            </svg>
        </div>
        <div wire:loading.remove wire:target="{{ $namefucion }}">
            {{ $label }}
        </div>
        <div
            wire:loading
            wire:target="{{ $namefucion }}"
            style="display: none"
        >
            {{ "Un momento.." }}
        </div>
        @if ($error > 0)
            <svg
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="ml-1.5 h-4 w-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
        @endif
    </button>
</div>
