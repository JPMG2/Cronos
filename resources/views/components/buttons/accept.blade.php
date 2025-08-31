@props([
    "label",
])
<div>
    <button
        {{ $attributes }}
        type="button"
        class="rounded-md bg-blue-700 px-3 py-1.5 text-sm font-semibold text-white shadow-lg shadow-blue-200 hover:bg-blue-400"
    >
        {{ $label }}
    </button>
</div>
