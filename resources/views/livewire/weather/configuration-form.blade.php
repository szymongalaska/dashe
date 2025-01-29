<form x-data="{ coordinates: @entangle('coordinates') }" class="w-full min-h-40 space-y-4" wire:submit="save">
    <livewire:weather.city-select />
    <input id="coordinates" type="hidden" x-model="coordinates" wire:model="coordinates" />
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
</form>