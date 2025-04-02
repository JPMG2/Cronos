@props([
    'placeholder' => false,
])
<input
    x-init="$refs.inputFilet.focus();"
    type="text"
    x-ref="inputFilet"
    x-model="filterText"
    placeholder="{{ $placeholder }}"
    {{ $attributes }}
    class="w-full border-1 rounded px-2 py-1 text-sm focus:border-blue-600
           focus:outline-none focus:ring-0 dark:border-gray-600"
    @click.stop
>
