@props(['typetext' => false])
@php
    $typetext = App\Enums\ColorType::tryFrom($typetext)->getName();

@endphp
<td
    {{ $attributes->merge(['class'=>'px-3 py-1 text-sm font-medium'.$typetext]) }}
>
    {{$slot}}
</td>
