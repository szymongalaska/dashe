<div x-data="{locationIndex: @entangle('locationIndex')}">
    <div class="max-w-xs lg:max-w-7xl flex overflow-x-auto no-scrollbar mx-auto lg:px-4 rounded-t-lg">
        @foreach($locations as $key => $locationInfo)
                <div @class([
                    'bg-white dark:bg-gray-800 dark:text-gray-300 shadow-sm text-center text-sm px-4 py-1 cursor-pointer hover:text-gray-600 hover:dark:text-gray-100 transition duration-150 ease-in-out',
                    'rounded-tl-lg' => $loop->first,
                    'rounded-tr-lg' => $loop->last,
                ]) @click="locationIndex = {{$key}}; $wire.$refresh()"
                    x-bind:class="locationIndex == {{$key}} ? 'text-slate-800 dark:text-slate-100 font-semibold' : ''">
                    <span class="inline-flex justify-center align-middle items-center text-center gap-1 whitespace-nowrap">
                        @if($loop->first)
                            <x-mdi-near-me class="w-4" />
                        @endif
                        {{$locationInfo['name']}}
                    </span>
                </div>
        @endforeach
    </div>
    <div class="max-w-7xl relative mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        wire:poll.600s>
        <div wire:loading
            class="absolute z-10 inset-0 bg-gradient-to-r from-transparent via-gray-100 dark:via-gray-900 to-transparent opacity-50 animate-shimmer">
        </div>
        @if($locationIndex == 0)
            <p class="flex lg:absolute justify-center max-w-xs mx-auto text-sm text-gray-100 hover:text-white cursor-pointer bg-slate-600 rounded-md px-2 py-1"
                @click="getLocation((coords) => { if($wire.coordinates !== coords) $wire.updateLocation(coords); })">
                <x-mdi-crosshairs-gps class="me-2 w-4" />
                {{__('Refresh location')}}
            </p>
        @endif
        <div class="flex flex-col lg:flex-row items-center gap-2">
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
            <div class="flex flex-col items-center flex-1">
                <div class="flex flex-wrap justify-center items-center">
                    @if($location->weather()->temperature()->getFeelsLike())
                        <x-weather.condition>
                            <p>{{__('Feels like: ')}}</p>
                            <p class="font-semibold">
                                {{round($location->weather()->temperature()->getFeelsLike()) ?: 0}}°{{$location->weather()->temperature()->getUnits()}}
                            </p>
                        </x-weather.condition>
                    @endif
                    @if($location->airPollution())
                        <x-weather.condition class="relative group cursor-pointer hover:bg-gray-100/60 dark:hover:bg-gray-900/40 ">
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
                    class="flex flex-col max-w-3xs sm:max-w-xl xl:max-w-3xl p-2 bg-gray-100/20 border-gray-100/50 dark:bg-gray-900/80 dark:border-gray-900/50 shadow-md rounded-lg scroll-smooth overflow-x-auto">
                    @include('weather.components.forecast-chart', ['forecast' => $location->forecast()->all(), 'key' => $locationIndex])
                    <div class="inline-flex w-full">
                        @foreach($location->forecast()->all() as $forecast)
                            @include('weather.components.forecast', [$forecast])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right h-2">
            <p class="text-[0.5rem] text-gray-300 mt-2">{{__('Updated: ') . $location->weather()->getDate()}}</p>
        </div>
    </div>
</div>