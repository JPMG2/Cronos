@props([
    "label",
    "icon"=> false
])
<?php
if ($icon) {
    $icon = App\Enums\Iconos::tryFrom($icon)->getName();
}
?>
<button
    type="button"
    {{$attributes}}
    class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500 transition-all duration-200 shadow-sm whitespace-nowrap"
>
    @if($icon)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor"
             class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
        </svg>
    @endif
    <span>{{ $label }}</span>
</button>
