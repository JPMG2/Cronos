@props(
    ['icon' => null]
)
<div
    @mouseover="linkHover = true"
    @click.outside="linkHover = false"

    class="flex cursor-pointer items-center justify-between px-6 py-2 text-gray-600 "

>
    <div class="flex items-center">
        <svg
            class="h-4 w-4 transition duration-200"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="{{ $icon }}"
            />
        </svg>
        <span class="ml-3">{{ $slot }}</span>
    </div>
    <svg
        class="h-3 w-3 transition duration-300"
        :class="linkActive ? 'rotate-90' : ''"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"
        ></path>
    </svg>
</div>
