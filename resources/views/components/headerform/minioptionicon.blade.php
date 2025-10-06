@props([
    "icon"=> false
])
<?php
if ($icon) {
    $icon = App\Enums\Iconos::tryFrom($icon)->getName();
}
?>
<svg
    {{ $attributes }}
    type="button"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
>
    @if ($icon)
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
        />
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="{{ $icon }}"
        />
    @endif
</svg>
