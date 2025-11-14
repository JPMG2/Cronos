@props(['type'=>false])
@php
    $background = '';
    $textfill = '';
    $icon = '';
  if($type){
    $stylearray = App\Enums\ModalAlert::tryFrom($type)->getName();
    $background = $stylearray['background'];
    $textfill = $stylearray['textfield'];
    $icon = $stylearray['icon'];
  }
@endphp
<div
    class="mx-auto  flex size-12 shrink-0 items-center justify-center rounded-full {{$background}} sm:mx-0 sm:size-10">
    <svg class="size-6 {{$textfill}}" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
         stroke="currentColor" aria-hidden="true" data-slot="icon">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="{{$icon}}"/>
    </svg>
</div>
