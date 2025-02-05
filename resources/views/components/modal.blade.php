@props([
    "show" => false,
])

<div x-data="{ show: $wire.entangle('show') }">
    <div
        x-show="show"
        x-transition.opacity
        x-transition:enter.duration.100ms
        x-transition:leave.duration.300ms
        x-cloak
        class="fixed left-0 top-0 z-50 h-screen w-full items-center justify-center overflow-y-auto bg-black bg-opacity-70"
    >
        <div class="m-3 mx-auto mt-11 size-4/5">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70"
            >
                <div
                    class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700"
                >
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        {{ $heading }}
                    </h3>
                    <button
                        wire:click="$set('show', false)"
                        type="button"
                        class="flex size-7 items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <span class="sr-only">Close</span>
                        <svg
                            class="size-4 flex-shrink-0"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="overflow-y-auto p-4">
                    <div class="overflow-y-auto p-4">
                        {{ $slot }}
                    </div>
                </div>
                <div
                    class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700"
                >
                    <x-buttons.close wire:click="$set('show', false)">
                        {{ __("Cerrar") }}
                    </x-buttons.close>
                </div>
            </div>
        </div>
    </div>
</div>
