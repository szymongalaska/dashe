<form x-data="{ loading: false, coordinates: @entangle('coordinates'), city: false}"
    x-effect="if ( coordinates && !city ) { city = await $wire.getLocationCity(); loading = false }" class="w-full min-h-40 space-y-4"
    wire:submit="save">
    <p class="text-sm text-gray-600">To use the weather module you must give your permission to locate your position.
    </p>
    <div class="w-full">
        <input type="checkbox" id="geolocation" class="hidden peer">
        <label for="geolocation" @click="loading = true; city = false; getLocation((coords) => coordinates = coords)"
        x-bind:class="loading ? 'animate-pulse' : ''"
            class="w-full inline-flex items-center justify-center p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-purple-800 dark:peer-checked:border-purple-800 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="inline-flex gap-2 items-center"><x-mdi-crosshairs-gps class="w-4" />
                {{__('Find my location')}}
            </div>
        </label>
    </div>

    <input id="coordinates" type="hidden" x-model="coordinates" wire:model="coordinates" />
    <template x-if="coordinates !== false && city !== false">
        <div x-cloak x-show="coordinates !== false"
            class="flex items-center justify-between shadow p-4 mt-6 text-sm bg-gray-50 rounded-lg">
            <div class="space-x-2 flex flex-row items-center">
                <x-mdi-map-marker-radius class="w-8 text-gray-500" />
                <div>
                    <p class="text-gray-400 text-xs">{{__('Your current location')}}</p>
                <div>
                    <span x-text="city.name + ', ' + city.country"></span>
                    <span x-text="city.coordinates" class="text-[8px] text-gray-500"></span>
                </div>
                </div>
            </div>
        </div>
    </template>

    <div>
        <label for="units" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your preferred
            temperature units</label>
        <select wire:model="units" id="units"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>{{ __('Units') }}</option>
            <option value="metric">{{ __('Celsius') }}</option>
            <option value="imperial">{{ __('Fahrenehit') }}</option>
        </select>
    </div>
    <x-input-error :messages="$errors->all()" />

    <button class="hidden" type="submit"></button>
</form>