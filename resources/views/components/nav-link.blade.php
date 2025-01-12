@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex justify-center px-1 pt-1 text-sm font-medium leading-5 text-orange-600 dark:text-gray-100 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex justify-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
