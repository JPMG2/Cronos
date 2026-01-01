@props([
    "routname" => false,
])
<li class="-ml-6 group">
    <a href="{{ $routname }}" class="flex items-center pl-12 pr-4 py-2 text-slate-600 cursor-pointer transition-all duration-300 ease-in-out hover:bg-gradient-to-r hover:from-primary-50 hover:to-transparent hover:text-primary-700 hover:translate-x-2 rounded-r-lg" wire:navigate>
        <span class="mr-3 text-xs text-slate-400 transition-all duration-300 group-hover:text-primary-500 group-hover:scale-125">&bull;</span>
        <span class="overflow-ellipsis text-sm transition-all duration-300">{{ $slot }}</span>
    </a>
</li>
