<div
    class="max-w-xl min-h-72 mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <h4 class="mb-4">{{__('Manage locations')}}</h4>
    <form wire:submit="addLocation()" x-data="{city: @entangle('city')}" wire:loading.class="animate-pulse">
        <livewire:weather.city-select />
        <div wire:model="city"></div>
        <button type="submit" class="hidden" x-effect="if (city.coordinates) $el.click()"></button>
    </form>
    <div class="border-2 border-gray-200 py-2 px-4 rounded-lg mt-2">
        <ul>
            @if(empty($locations))
                <li class="text-sm p-4 mx-auto text-gray-400">{{__('No locations yet')}}</li>
            @endif
            @foreach($locations as $key => $location)
                <li class="text-sm py-2">
                    @if($loop->first)
                        <span class="inline-flex gap-2"><x-mdi-crosshairs-gps class="w-4" />{{$location['name']}},
                            {{$location['country']}} <span
                                class="text-[0.5rem] text-gray-400">{{$location['coordinates']}}</span></span>
                    @else
                        <form wire:submit="removeLocation({{$key}})" class="flex items-center justify-between"
                            wire:loading.class.delay="animate-pulse">
                            <span class="inline-flex gap-2">{{implode(', ', [$location['name'], $location['country']])}}<span
                                    class="text-[0.5rem] text-gray-400">{{$location['coordinates']}}</span></span><button
                                type="submit">
                                <x-mdi-map-marker-remove
                                    class="w-6 text-gray-800 cursor-pointer hover:text-gray-600 transition duration-150 ease-in-out" /></button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <x-input-error class="p-2" :messages="$errors->get('location')" />
</div>