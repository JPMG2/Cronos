<div
    @mouseover="linkHover = true"
    @click.outside="linkHover = false"
    @click="linkActive = !linkActive"
    class="flex cursor-pointer items-center justify-between px-6 py-3 text-gray-400 transition duration-200 hover:bg-black hover:bg-opacity-30 hover:text-gray-100"
    :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
>
    <div class="flex items-center">
        <svg
            class="h-5 w-5 transition duration-200"
            :class=" linkHover || linkActive ? 'text-gray-100' : ''"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
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
