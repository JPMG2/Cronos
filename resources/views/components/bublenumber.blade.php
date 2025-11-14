@props(['background'=>false])
@php
    $background = App\Enums\ColorType::tryFrom($background)->getName();
@endphp
<span
    class="items-center px-1.5 py-0.5 rounded text-xs font-medium  {{$background}}  font-semibold text-blue-600 shadow-sm ring-2 ring-gray-200 transition-all duration-200 hover:shadow-md hover:ring-blue-200">
      {{ $slot }}
</span>
