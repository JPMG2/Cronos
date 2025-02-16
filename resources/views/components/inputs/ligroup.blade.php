<div>
    <ul
        x-show="open"
        style="display: none"
        class="absolute z-20 mt-1 max-h-60 w-full divide-y overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-2 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        tabindex="-1"
        role="listbox"
        aria-labelledby="listbox-label"
    >
        {{ $slot }}
    </ul>
</div>
