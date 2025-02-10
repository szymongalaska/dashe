@props(['value', 'name'])

<p class="flex flex-col">
        <span {{$attributes->merge(['class' => 'text-xs'])}}>{{$value}}</span>
        <span class="text-[0.5rem] uppercase">{{$name}}</span>
</p>