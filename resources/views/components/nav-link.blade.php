@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-500 dark:border-primary-600 text-sm font-medium leading-5 text-primary-700 dark:text-gray-100 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-600 dark:text-gray-400 hover:text-primary-700 dark:hover:text-gray-300 hover:border-primary-300 dark:hover:border-gray-700 focus:outline-none focus:text-primary-700 dark:focus:text-gray-300 focus:border-primary-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
