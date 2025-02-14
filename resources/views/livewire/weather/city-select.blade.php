<div x-init="result = {{count($result)}}" x-data="{open: false, result: 0}" class="relative">
    <label for="city"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 dark:text-white">{{ __('Pick your location') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-mdi-magnify class="w-4 text-gray-500" />
        </div>
        <x-text-input class="w-full ps-8 text-sm" wire:model.live.debounce.500ms="city" @focus="open = true"
            @click.away="open = false" placeholder="{{ __('Search city...') }}" />
    </div>

    <div x-cloak x-show="open" x-transition
        class="absolute w-full bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg mt-1 h-36 overflow-y-auto">
        <div class="absolute bg-white dark:bg-gray-800 inset-0 flex items-center justify-center" wire:loading.flex>
            <x-loader class="w-12" />
        </div>
        @if(!empty($result))
            @foreach($result as $city)
                <div @click="geolocation = false, coordinates = '{{ $city['coordinates'] }}', city = {name: '{{ $city['name'] }}', country: '{{ $city['country'] }}', coordinates: '{{ $city['coordinates'] }}'} "
                    class="flex justify-between p-2 text-xs lg:text-sm hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-300 cursor-pointer">
                    {{implode(', ', array_filter([$city['name'], $city['state'], $city['country']]))}}<span
                        class="text-[8px] text-gray-500 truncate">{{ $city['coordinates'] }}</span>
                </div>
            @endforeach
        @else
            <div class="p-2 text-sm text-gray-500">{{ __('No results found') }}</div>
        @endif
    </div>

    <div id="error"></div>

</div>