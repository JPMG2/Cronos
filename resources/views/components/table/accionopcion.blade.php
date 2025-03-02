@props(["iconname" => false,
"isDelete" => false,])
@php
    $iconname = App\Enums\Iconos::tryFrom($iconname)->getName();
    $colorhover = $isDelete ? 'hover:text-red-700' : 'hover:text-purple-500';
@endphp

<div class="mr-2 w-4 transform hover:scale-110 {{$colorhover}}">
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
