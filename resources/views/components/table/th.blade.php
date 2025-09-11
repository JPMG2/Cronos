@props(['style' => false])
<th
    {{
    $attributes->merge(['class' => 'px-1.5 py-2 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400 '.$style])
    }}
    scope="col"

>
    {{ $slot }}
</th>
