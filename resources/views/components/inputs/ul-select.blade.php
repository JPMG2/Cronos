<ul
    {{ $attributes }}
    class="absolute z-30 mt-1 max-h-60 w-full divide-y divide-gray-200 overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
    tabindex="-1"
    role="listbox"
    aria-labelledby="listbox-label"
>
    {{ $slot }}
</ul>
