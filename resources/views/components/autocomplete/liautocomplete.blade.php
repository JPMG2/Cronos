<li
    {{ $attributes }}
    data-autocomplete-item
    class="relative cursor-pointer select-none py-2 pl-3 pr-9 transition-colors"
    role="option"
>
    <div class="flex items-center">
             <span
                 class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400"
                 aria-hidden="true"
             ></span>
        <span
            class="ml-3 block truncate font-normal text-xs"> {{ $slot }}
            </span>
    </div>
</li>

