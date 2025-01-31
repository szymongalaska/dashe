<a href="{{$href}}" {{$attributes->merge(['class' => "inline-flex justify-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 dark:text-gray-100 focus:outline-none transition duration-150 ease-in-out"])}} wire:navigate wire:current="text-purple-800">
    {{ $slot }}
</a>
