@props([
    'icon' => false,
    'buttoname'=> false
])

@php
    $icon = App\Enums\Iconos::tryFrom($icon)->getName();
@endphp

<button
    {{ $attributes }}
    :class="activeTab === '{{ $buttoname }}'
                                ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 ring-1 ring-blue-300'
                                : 'bg-gradient-to-r from-slate-50 to-white hover:from-slate-100 hover:to-slate-50 text-slate-600'"
    class="flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-300 flex items-center justify-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="{{ $icon }}"></path>
    </svg>
    {{ $slot }}
</button>
