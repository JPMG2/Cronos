@props(["closemodal" => false,
'clearform'=>false])
<div
    {{ $attributes }}
    class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center bg-black bg-opacity-45"
>
    <div
        id="drawer-right-example"
        class="fixed right-0 top-0 z-40 h-screen w-96 overflow-hidden bg-gradient-to-br from-slate-50 to-blue-50 shadow-2xl ring-1 ring-blue-200"
        tabindex="-1"
        aria-labelledby="drawer-right-label"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
    >
        <!-- Enhanced Header Section -->
        <div class="relative bg-gradient-to-r from-blue-100 to-blue-200 px-6 py-4 shadow-lg ring-1 ring-blue-300">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-50/30 to-transparent"></div>
            <h5
                id="drawer-right-label"
                class="relative flex items-center text-lg font-semibold text-blue-700"
            >
                <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-200/50 backdrop-blur-sm">
                    <svg class="h-4 w-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <span class="font-titles">{{ $title }}</span>
            </h5>

            <!-- Close Button -->
            <button
                wire:click="$set('{{ $closemodal }}', false)"
                @if($clearform)
                    @click="$wire.{{$clearform}}"
                @endif
                type="button"
                data-drawer-hide="drawer-right-example"
                aria-controls="drawer-right-example"
                class="absolute right-4 top-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-200/30 text-blue-700 transition-all duration-200 hover:bg-blue-200/50 hover:rotate-90"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>

        <!-- Content Section -->
        <div class="flex-1 overflow-y-auto px-6 py-6 pb-20">
            <div class="rounded-lg bg-white/60 backdrop-blur-sm p-4 shadow-sm ring-1 ring-white/20">
                {{ $slot }}
            </div>
        </div>

        <!-- Bottom Button Section -->
        <div
            class="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-blue-100 to-blue-50 px-6 py-4 shadow-lg ring-1 ring-blue-200">
            {{ $buttons ?? '' }}
        </div>
    </div>
</div>
