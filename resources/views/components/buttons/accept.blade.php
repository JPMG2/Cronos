@props([
    "label",
    "icon"=> false
])
<?php
if ($icon) {
    $icon = App\Enums\Iconos::tryFrom($icon)->getName();
}
?>
<div>
    <button
        {{ $attributes }}
        type="button"
        class="inline-flex items-center rounded-md bg-blue-700 px-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-blue-200 hover:bg-blue-400"
    >
        @if($icon)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
            </svg>
        @endif

        {{ $label }}
    </button>
</div>
