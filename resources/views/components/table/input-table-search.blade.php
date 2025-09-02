@props(['withd'=>false])


<div class="relative">
    <input
        {{$attributes}}
        type="text" id="small-input" autocomplete="off"
        class="block {{$withd}} p-1 pr-8 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm leading-none
        focus:border-blue-600 focus:outline-none focus:ring-0
        dark:border-gray-600 dark:text-white dark:focus:border-blue-500"/>

    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-400 dark:text-neutral-500"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
        </svg>
    </div>
</div>

