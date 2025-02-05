@props(["type" => false])
@php
    $bgColor = App\Enums\ColorType::tryFrom($type)->getName();
@endphp

<div class="{{ $bgColor }} flex py-2.5 shadow-md sm:px-3.5">
    <p class="text-sm text-gray-800">
        {{ $slot }}
    </p>
</div>
