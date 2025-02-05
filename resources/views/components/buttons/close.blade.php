<div>
    <button
        {{ $attributes }}
        type="button"
        class="rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold text-white shadow-lg shadow-shw_cerrar hover:bg-orange-400"
        data-hs-overlay="#hs-basic-modal"
    >
        {{ $slot }}
    </button>
</div>
