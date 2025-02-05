@props(["iconname" => false])
@php
    $iconname = App\Enums\Iconos::tryFrom($iconname)->getName();
@endphp

<div class="mr-2 w-4 transform hover:scale-110 hover:text-purple-500">
    <svg
        {{ $attributes }}
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="{{ $iconname }}"
        />
    </svg>
</div>
