<div
    class="max-w-xl mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Configuration")}}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{__('Change configuration')}}
        </p>
    </header>
    <form class="mt-6" wire:submit="update">
    <div>
        <label for="units" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temperature units</label>
        <select wire:change="update" wire:model="units" id="units"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
            <option value="metric">{{ __('Celsius') }}</option>
            <option value="imperial">{{ __('Fahrenehit') }}</option>
        </select>
    </div>
    <x-input-error :messages="$errors->all()" />
    </form>
</div>