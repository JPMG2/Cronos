@props([
    "iconname" => false,
])
@php
    $icon = App\Enums\Iconos::tryFrom($iconname)->getName();
@endphp

<button
    {{ $attributes }}
    type="button"
    class="flex items-center justify-center rounded p-3 shadow-md"
    :class="isSelected($el.id) ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500'"
    :aria-selected="isSelected($el.id)"
>
    <svg
        class="mr-2 h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
    </svg>
    {{ $slot }}
</button>
