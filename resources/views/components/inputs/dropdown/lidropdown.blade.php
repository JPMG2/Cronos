@props([
    'optionname'=>false,
])
<li
    @click="select(index)"
    :id="'option-' + {{$optionname}}.id"
    @mouseenter="isUsingKeyboard = false; activeIndex = index"
    @mouseleave="isUsingKeyboard = true"
    :class="{
            'bg-indigo-600 text-white': isUsingKeyboard && activeIndex === index,
            'hover:bg-indigo-600 hover:text-white': !isUsingKeyboard
        }"
    class="py-1 pl-3 pr-9 text-gray-900"
    role="option"
>
    <span class="block truncate font-normal" x-text="{{$optionname}}.name"></span>
</li>
