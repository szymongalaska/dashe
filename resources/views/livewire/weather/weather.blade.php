<div x-data="{locationIndex: @entangle('locationIndex')}">
    <div class="max-w-7xl flex mx-auto overflow-hidden px-4">
        @foreach($locations as $key => $locationInfo)
            <div class="max-w-36 bg-white dark:bg-gray-800 shadow-sm text-center px-4 py-2 cursor-pointer"
                @click="locationIndex = {{$key}}; $wire.$refresh()"
                x-bind:class="locationIndex == {{$key}} ? 'text-slate-800 font-semibold' : ''">
                <span class="inline-flex">
                    @if($geolocation == true && $key == 0)
                        <x-hugeicons-location-share-01 class="w-8" />
                    @endif
                    {{$locationInfo['name']}}
                </span>
            </div>
        @endforeach
    </div>
    <div class="max-w-7xl relative mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        x-init="if($wire.geolocation == true) getLocation((coords) => { if($wire.coordinates !== coords) $wire.updateLocation(coords); })"
        wire:poll.600s>
        <div wire:loading
            class="absolute inset-0 bg-gradient-to-r from-transparent via-gray-100 to-transparent opacity-50 animate-shimmer">
        </div>
        <x-dropdown align="left">
            <x-slot name="trigger">
                <span class="flex gap-2 cursor-pointer hover:text-gray-600 text-center">
                    {{$location->getName() }}
                    <x-heroicon-o-chevron-down class="w-6" />
                </span>
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col">
                    @foreach ($locations as $key => $locationInfo)
                        <span class="p-1 text-sm text-center cursor-pointer hover:bg-gray-100"
                            @click="locationIndex = {{$key}}; $wire.$refresh()">{{$locationInfo['name']}}</span>
                    @endforeach
                </div>
            </x-slot>
        </x-dropdown>
        <div class="flex flex-col md:flex-row items-center gap-2">
            <div class="flex flex-col items-center justify-center">
                <div class="flex items-center">
                    <div class="w-36">
                        <img class="object-none" alt="{{$location->weather()->getDescription()}}"
                            src="https://openweathermap.org/img/wn/{{$location->weather()->getIcon()}}@4x.png" />
                    </div>
                    <div class="flex flex-col text-gray-800">
                        <span
                            class="text-5xl flex items-top font-semibold">{{ round($location->weather()->temperature()->get()) ?: 0 }}<span
                                class="text-base">°{{ $location->weather()->temperature()->getUnits() }}</span></span>
                        <p class="text-base text-gray-600">
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
                    @if($location->weather()->isRaining())
                        <x-weather.condition>
                            <p>{{__('Rain: ')}}</p>
                            <p class="font-semibold">{{$location->weather()->getRain()}}</p>
                        </x-weather.condition>
                    @endif
                    @if($location->weather()->isSnowing())
                        <x-weather.condition>
                            <p>{{__('Snow: ')}}</p>
                            <p class="font-semibold">{{$location->weather()->getSnow()}}</p>
                        </x-weather.condition>
                    @endif
                    @if($location->weather()->getHumidity())
                        <x-weather.condition>
                            <p>{{__('Humidity: ')}}</p>
                            <p class="font-semibold">{{$location->weather()->getHumidity()}}</p>
                        </x-weather.condition>
                    @endif
                    @if($location->weather()->getClouds())
                        <x-weather.condition>
                            <p>{{__('Cloudiness: ')}}</p>
                            <p class="font-semibold">{{$location->weather()->getClouds()}}%</p>
                        </x-weather.condition>
                    @endif
                    @if($location->weather()->wind())
                        <x-weather.condition>
                            <p>{{__('Wind: ')}}</p>
                            <p class="flex justify-center font-semibold"><x-heroicon-o-arrow-long-down
                                    class="w-4 rotate-[{{$location->weather()->wind()->getDirection()}}deg]" />
                                {{$location->weather()->wind()->getSpeed()}} m/s</p>
                        </x-weather.condition>
                    @endif
                    @if($location->weather()->getVisibility())
                        <x-weather.condition>
                            <p>{{__('Visiblity: ')}}</p>
                            <p class="font-semibold">{{$location->weather()->getVisibility() / 1000}} km</p>
                        </x-weather.condition>
                    @endif
                    @if($location->airPollution())
                        <x-weather.condition>
                            <p>{{__('Air quality: ')}}</p>
                            <p class="font-semibold">{{__($location->airPollution()->getAirQualityIndexDescription())}}</p>
                        </x-weather.condition>
                    @endif
                </div>
                <div
                    class="flex flex-col max-w-xs md:max-w-3xl p-2 border border-gray-100 shadow-sm rounded-lg overflow-x-auto">
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