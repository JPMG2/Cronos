@props(['iconname'=>false])
@php
    $iconname = App\Enums\Iconos::tryFrom($iconname)->getName();
@endphp
<h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-slate-800">
    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="{{$iconname}}"></path>
    </svg>
    {{$slot}}
</h3>
