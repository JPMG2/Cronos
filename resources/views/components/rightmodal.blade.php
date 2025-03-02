@props(["closemodal" => false,
'clearform'=>false])
<div
    {{ $attributes }}
    class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center bg-black bg-opacity-70"
>
    <div
        id="drawer-right-example"
        class="fixed right-0 top-0 z-40 h-screen w-96 bg-white p-4 transition-transform"
        tabindex="-1"
        aria-labelledby="drawer-right-label"
    >
        <h5
            id="drawer-right-label"
            class="mb-4 inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400"
        >
            <span class="text-gray-900">{{ $title }}</span>
        </h5>
        <button
            wire:click="$set('{{ $closemodal }}', false)"
            @if($clearform)
                @click="$wire.{{$clearform}}"
            @endif
            type="button"
            data-drawer-hide="drawer-right-example"
            aria-controls="drawer-right-example"
            class="absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
        >
            <svg
                class="h-3 w-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
