<div x-init="result = {{count($result)}}" x-data="{open: false, result: 0}" class="relative">
    <label for="city"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pick your location') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-mdi-magnify class="w-4 text-gray-500" />
        </div>
        <input type="text" wire:model.live.debounce.500ms="city" @focus="open = true" @click.away="open = false"
            placeholder="{{ __('Search city...') }}"
            class="block w-full p-2 ps-8 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    </div>

    <div x-cloak x-show="open" x-transition
        class="absolute w-full bg-white border rounded-lg mt-1 h-36 overflow-y-auto">
        <div class="absolute bg-white inset-0 flex items-center justify-center" wire:loading.flex>
            <x-loader class="w-12" />
        </div>
            @foreach($result as $city)
                <div @click="geolocation = false, coordinates = '{{ $city['coordinates'] }}', city = {name: '{{ $city['name'] }}', country: '{{ $city['country'] }}', coordinates: '{{ $city['coordinates'] }}'} "
                    class="flex justify-between p-2 text-sm hover:bg-gray-50 cursor-pointer">{{implode(', ', [$city['name'], $city['state'], $city['country']])}}<span class="text-[8px] text-gray-500">{{ $city['coordinates'] }}</span>
                </div>
            @endforeach
    </div>

    <div id="error"></div>

</div>