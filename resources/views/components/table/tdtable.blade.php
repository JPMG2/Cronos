@props(['typetext' => false])
@php

    $typetext = ($typetext) ?  App\Enums\ColorType::tryFrom($typetext)->getName() : 'text-gray-500';

@endphp
<td
    {{ $attributes->merge(['class'=>'px-3 py-1 text-sm font-medium '.$typetext]) }}
>
    {{$slot}}
</td>
