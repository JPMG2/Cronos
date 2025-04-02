@props([
    'ulname'=>false
])
<ul
    x-show="open"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.outside="close()"
    @mouseleave="close()"
    style="display: none;"
    class="absolute z-30 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1
                              text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
    tabindex="-1" role="listbox" aria-labelledby="listbox-label"
    aria-activedescendant="listbox-{{$ulname}}">
    {{$slot}}
</ul>
