@props(['iconname'=>false])
@php
    $iconname = App\Enums\Iconos::tryFrom($iconname)->getName();
@endphp
<div class="flex items-center gap-4">
    <div
        class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 ring-4 ring-blue-50">
        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="{{$iconname}}"></path>
        </svg>
    </div>
    <div class="flex-1">
        <x-formcomponent.titleform><span>{{$title}}</span></x-formcomponent.titleform>
        <p class="mt-1 text-sm text-slate-600"><span>{{$subtitle}}</span></p>
    </div>
    {{ $slot }}
</div>
