<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
    x-init="if($wire.geolocation == true) getLocation((coords) => { if($wire.coordinates !== coords) $wire.updateLocation(coords); })">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center">
                <img src="https://openweathermap.org/img/wn/{{$location->weather()->getIcon()}}@2x.png" />
                <div class="flex flex-col text-gray-800">
                    <span
                        class="text-5xl flex items-top font-semibold">{{ round($location->weather()->temperature()->get()) }}<span
                            class="text-base">°{{ $location->weather()->temperature()->getUnits() }}</span></span>
                </div>
            </div>
            <p class="text-base text-gray-600">{{ ucfirst($location->weather()->getDescription()) }}</p>
        </div>
        <div class="flex flex-wrap justify-center items-center">
            @if($location->weather()->temperature()->getFeelsLike())
                <x-weather.condition>
                    <p>{{__('Feels like: ')}}</p>
                    <p>{{$location->weather()->temperature()->getFeelsLike()}}°{{$location->weather()->temperature()->getUnits()}}
                    </p>
                </x-weather.condition>
            @endif
            @if($location->weather()->getHumidity())
                <x-weather.condition>
                    <p>{{__('Humidity: ')}}</p>
                    <p>{{$location->weather()->getHumidity()}}</p>
                </x-weather.condition>
            @endif
            @if($location->weather()->getClouds())
                <x-weather.condition>
                    <p>{{__('Cloudiness: ')}}</p>
                    <p>{{$location->weather()->getClouds()}}%</p>
                </x-weather.condition>
            @endif
            @if($location->weather()->wind())
                <x-weather.condition>
                    <p>{{__('Wind: ')}}</p>
                    <p class="flex"><x-heroicon-o-arrow-long-down
                            class="w-4 rotate-[{{$location->weather()->wind()->getDirection()}}deg]" />
                        {{$location->weather()->wind()->getSpeed()}} m/s</p>
                </x-weather.condition>
            @endif
            @if($location->weather()->getVisibility())
                <x-weather.condition>
                    <p>{{__('Visiblity: ')}}</p>
                    <p>{{$location->weather()->getVisibility()}}</p>
                </x-weather.condition>
            @endif
            @if($location->airPollution())
                <x-weather.condition>
                    <p>{{__('Air quality: ')}}</p>
                    <p>{{__($location->airPollution()->getAirQualityIndexDescription())}}</p>
                </x-weather.condition>
            @endif
        </div>
        <div class="text-center">
            <p class="font-bold text-xl">{{$location->getName()}}</p>
            <p class="text-xs text-gray-300">{{$location->getCoordinates()}}</p>
        </div>
    </div>
</div>