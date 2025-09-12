<div
    {{ $attributes->merge(['class' => 'rounded-xl bg-gradient-to-r to-white p-4 ring-1 transition-all duration-300 hover:shadow-md focus-within:shadow-md '.$dstyle]) }}
>
    {{ $slot }}
</div>
