<div
    class="big bg-white dark:bg-gray-800 shadow-sm rounded-lg sm:px-6 lg:px-8 p-4 flex flex-col items-center justify-center relative">
    <p class="absolute top-1 left-1 mt-1 ml-2 text-xs text-gray-300 dark:text-gray-600">{{ $location->getName() }}</p>
    <div class="w-full flex flex-col lg:flex-row justify-between items-center gap-2">
        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center">
                <div class="w-36">
                    <img class="mr-2" alt="{{$location->weather()->getDescription()}}"
                        src="https://openweathermap.org/img/wn/{{$location->weather()->getIcon()}}@4x.png" />
                </div>
                <div class="flex flex-col text-gray-800 dark:text-gray-200">
                    <span
                        class="text-5xl flex items-top font-semibold">{{ round($location->weather()->temperature()->get()) ?: 0 }}<span
                            class="text-base">°{{ $location->weather()->temperature()->getUnits() }}</span></span>
                    <p class="text-base text-gray-600 dark:text-gray-200">
                        {{ ucfirst($location->weather()->getDescription()) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center flex-1 py-2">
            <div class="flex flex-wrap lg:flex-nowrap lg:max-w-xl 2xl:max-w-3xl justify-center items-center">
                @if($location->weather()->temperature()->getFeelsLike())
                    <x-weather.condition>
                        <p>{{__('Feels like: ')}}</p>
                        <p class="font-semibold">
                            {{round($location->weather()->temperature()->getFeelsLike()) ?: 0}}°{{$location->weather()->temperature()->getUnits()}}
                        </p>
                    </x-weather.condition>
                @endif
                @if($location->airPollution())
                    <x-weather.condition
                        class="relative group cursor-pointer hover:bg-gray-100/60 dark:hover:bg-gray-900/40 ">
                        <x-weather.air-pollution-popover :airPollution="$location->airPollution()" />
                        <p>{{__('Air quality: ')}}</p>
                        <p
                            class="font-semibold @airPollutionTextColor($location->airPollution()->getAirQualityIndexDescription())">
                            {{__($location->airPollution()->getAirQualityIndexDescription())}}
                        </p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->isRaining())
                    <x-weather.condition>
                        <p>{{__('Rain: ')}}</p>
                        <p class="font-semibold">{{$location->weather()->getRain()}} mm</p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->isSnowing())
                    <x-weather.condition>
                        <p>{{__('Snow: ')}}</p>
                        <p class="font-semibold">{{$location->weather()->getSnow()}} mm</p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->getPressure())
                    <x-weather.condition>
                        <p>{{__('Pressure')}}</p>
                        <p class="font-semibold">{{$location->weather()->getPressure()}} hPa</p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->getHumidity())
                    <x-weather.condition>
                        <p>{{__('Humidity: ')}}</p>
                        <p class="font-semibold">{{$location->weather()->getHumidity()}}%</p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->getClouds())
                    <x-weather.condition>
                        <p>{{__('Clouds: ')}}</p>
                        <p class="font-semibold">{{$location->weather()->getClouds()}}%</p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->wind())
                    <x-weather.condition>
                        <p>{{__('Wind: ')}}</p>
                        <p class="flex justify-center font-semibold"><x-mdi-arrow-down-thin class="w-4"
                                @style(["--tw-rotate:" . $location->weather()->wind()->getDirection() . "deg", "rotate:" . $location->weather()->wind()->getDirection() . "deg"]) />
                            {{$location->weather()->wind()->getSpeed()}}
                            {{$location->weather()->getUnits() == 'metric' ? 'm/s' : 'm/h'}}
                        </p>
                    </x-weather.condition>
                @endif
                @if($location->weather()->getVisibility())
                    <x-weather.condition>
                        <p>{{__('Visiblity: ')}}</p>
                        <p class="font-semibold">{{$location->weather()->getVisibility() / 1000}} km</p>
                    </x-weather.condition>
                @endif
            </div>
            <div
                class="flex flex-col max-w-3xs sm:max-w-xl 2xl:max-w-3xl p-2 bg-gray-100/20 border-gray-100/50 dark:bg-gray-900/80 dark:border-gray-900/50 shadow-md rounded-lg scroll-smooth overflow-x-auto">
                @include('weather.components.forecast-chart', ['forecast' => $location->forecast()->all(), 'key' => $locationIndex])
                <div class="inline-flex w-full">
                    @foreach($location->forecast()->all() as $forecast)
                        @include('weather.components.forecast', [$forecast])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>