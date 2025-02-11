@props(['value', 'name', 'index'])

<p class="flex flex-col">
        <span class="text-xs @airPollutionTextColor($index)">{{$value}}</span>
        <span class="text-[0.5rem] uppercase">{{$name}}</span>
</p>