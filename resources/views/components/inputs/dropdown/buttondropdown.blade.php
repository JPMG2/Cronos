@props([
    "isdisabled" => false,
])

@php
    $buttondisable='';
      if ($isdisabled) {
          $disableatributs = "bg-gray-100";
            $buttondisable = 'disabled';
      } else {
          $disableatributs = "bg-white";
      }
@endphp

<button
    {{$buttondisable}}
    type="button"
    @click="showoption()"
    class="relative grid w-full {{$disableatributs}} cursor-default grid-cols-1 rounded-md   py-2 pl-3 pr-2 text-left text-gray-900 outline
               outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-1
               focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
    <template x-if="selected === null">
        <span class="col-start-1 row-start-1 truncate pr-6"> &nbsp;</span>
    </template>
    <template x-if="selected !== null">
       <span class="col-start-1 row-start-1 truncate pr-6 translate-y-1"
             x-text="valuedText">
       </span>
    </template>
    <svg
        class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
        <path fill-rule="evenodd"
              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
              clip-rule="evenodd"/>
    </svg>
</button>
