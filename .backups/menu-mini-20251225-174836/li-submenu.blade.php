@props([
    "routname" => false,
])
<li
    class="cursor-pointer py-2 transition duration-200 hover:bg-black hover:bg-opacity-30 hover:text-gray-100"
    :class="$parent && $parent.classList.contains('py-2') ? 'px-4' : 'pl-10 pr-6'"
>
    <a href="{{ $routname }}" class="flex items-center text-gray-400 hover:text-gray-100" wire:navigate>
        <span class="mr-2 text-sm">&bull;</span>
        <span class="overflow-ellipsis">{{ $slot }}</span>
    </a>
</li>
