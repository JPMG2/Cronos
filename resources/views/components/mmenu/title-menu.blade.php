@props(
    ['icon' => null]
)
<div
    @mouseover="linkHover = true"
    @click.outside="linkHover = false"
    @click="linkActive = !linkActive"
    class="flex cursor-pointer items-center justify-between px-4 py-2.5 mx-2 rounded-lg text-slate-700 transition-all duration-300 ease-in-out hover:bg-primary-50 hover:text-primary-700 hover:shadow-sm hover:translate-x-1"
    :class=" linkActive ? 'bg-gradient-to-r from-primary-50 to-transparent text-primary-700 border-l-4 border-primary-600 font-semibold shadow-sm' : ''"
>
    <div class="flex items-center">
        <svg
            class="h-5 w-5 transition-all duration-300 ease-in-out text-slate-500"
            :class=" linkHover || linkActive ? 'text-primary-600 scale-110' : ''"
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
        class="h-3 w-3 transition-all duration-300 ease-in-out"
        :class="linkActive ? 'rotate-90 text-primary-600' : 'text-slate-400'"
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
