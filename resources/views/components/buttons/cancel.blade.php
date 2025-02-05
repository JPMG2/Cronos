@props([
    "label",
])
<div>
    <button
        {{ $attributes }}
        type="button"
        class="rounded-md bg-btn_danger px-3 py-1.5 text-sm font-semibold text-white shadow-lg shadow-shw_danger hover:bg-red-400"
    >
        {{ $label }}
    </button>
</div>
