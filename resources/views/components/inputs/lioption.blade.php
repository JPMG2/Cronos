<div>
    <li
        {{ $attributes }}
        class="relative cursor-default select-none py-2 pl-3 pr-9 text-slate-900 hover:bg-primary-500 hover:text-white transition-colors"
        role="option"
    >
        <div class="flex items-center">
            <span
                class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400"
                aria-hidden="true"
            ></span>
            <span class="ml-3 block truncate font-normal">{{ $slot }}</span>
        </div>
    </li>
</div>
