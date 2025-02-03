<form x-data="{ coordinates: @entangle('coordinates'), city: false, geolocation: @entangle('geolocation') }"
    x-effect="if ( coordinates && !city ) { city = await $wire.getLocationCity() }" class="w-full min-h-40 space-y-4"
    wire:submit="save">
    <livewire:weather.city-select />

    <div class="flex justify-center items-center gap-2">
        <div class="w-24 h-px bg-gray-300"></div>
        <p class="text-gray-400 uppercase text-xs">{{__("Or")}}</p>
        <div class="w-24 h-px bg-gray-300"></div>
    </div>

    <div class="w-full">
        <input type="checkbox" id="geolocation" value="true" wire:model="geolocation" class="hidden peer">
        <label for="geolocation" @click="city = false; getLocation((coords) => coordinates = coords)"
            class="w-full inline-flex items-center justify-center p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-purple-800 dark:peer-checked:border-purple-800 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div>
                {{__('Find my location')}}
            </div>
        </label>
    </div>

    <input id="coordinates" type="hidden" x-model="coordinates" wire:model="coordinates" />
    <template x-if="coordinates !== false && city !== false">
        <div x-cloak x-show="coordinates !== false"
            class="flex items-center justify-between shadow p-4 mt-6 text-sm bg-gray-50 rounded-lg">
            <div class="space-x-2 flex flex-row items-center">
                <x-hugeicons-location-04 class="text-gray-500" />
                <span x-text="city.name + ', ' + city.country"></span>
                <span x-text="city.coordinates" class="text-[8px] text-gray-500"></span>
            </div>
            <x-heroicon-o-x-mark @click="coordinates = false, city = {}, geolocation = false"
                class="cursor-pointer w-6 h-6 text-gray-900 hover:text-gray-500" />
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