@props([
    "routname" => false,
])
<li
    class="cursor-pointer py-2 pl-10 pr-6 transition duration-200 hover:bg-black hover:bg-opacity-30 hover:text-gray-100"
>
    <a href="{{ $routname }}" class="flex items-center" wire:navigate>
        <span class="mr-2 text-sm">&bull;</span>
        <span class="overflow-ellipsis">{{ $slot }}</span>
    </a>
</li>
