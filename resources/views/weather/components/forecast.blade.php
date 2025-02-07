@php
    /** @var Bejblade\OpenWeather\Entity\Weather $forecast
     */
@endphp
<div class="flex-none p-2 text-xs w-20 mx-2 text-gray-800 dark:text-gray-300">
    <div class="flex flex-col items-center">
        <div class="flex items-center">
            <img class="w-8" src="https://openweathermap.org/img/wn/{{$forecast->getIcon()}}.png" />
            <span class="text-lg font-semibold flex items-top">{{round($forecast->temperature()->get()) ?: 0}}<span
                    class="text-xs">°</span></span>
        </div>
        <span>
            {{$forecast->getTimestamp()->format('l')}}
        </span>
        <span>{{$forecast->getTimestamp()->format('H:i')}}</span>
    </div>
</div>