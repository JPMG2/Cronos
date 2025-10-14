@props(['background'=>false])
@php
    $background = App\Enums\ColorType::tryFrom($background)->getName();
@endphp
<span
    class="inline-flex h-6 w-6 items-center justify-center rounded-full  {{$background}}  text-xs font-semibold text-blue-600 shadow-sm ring-2 ring-gray-200 transition-all duration-200 hover:shadow-md hover:ring-blue-200">
      {{ $slot }}
</span>
