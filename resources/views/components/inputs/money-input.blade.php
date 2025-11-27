@props(['valuetext'=>false])
<input
    {{$attributes}}
    type="text"
    value="{{ $valuetext}}"
    class="font-bold w-full pl-4 pr-1 py-1 text-xs border border-slate-300 rounded
                focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                focus:outline-none disabled:bg-gray-50 disabled:text-blue-700 disabled:outline-gray-200"
/>
