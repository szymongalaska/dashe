<div class="max-w-xl mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Widgets")}}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{__('Add widgets to your dashboard')}}
        </p>
    </header>
    <form class="mt-6 space-y-4" wire:submit="save" wire:loading.class="animate-pulse">
        <div>
            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Location')}}</label>
            <select id="location" wire:model="form.location"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                <option>{{ __('Location') }}</option>
                @foreach($config['locations'] as $key => $location)
                    <option value="{{ $key }}">{{ implode(', ', [$location['name'], $location['country']]) }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Widget size') }}</label>
            <ul class="flex place-content-center p-2 gap-2">
                <li>
                    <input type="radio" id="small" wire:model="form.size" class="hidden peer" value="small" />
                    <label for="small"
                        class="inline-flex items-center justify-between w-full p-2 text-gray-500 cursor-pointer hover:text-gray-300 peer-checked:text-purple-800">
                    <x-icon name="small" class="h-8" />
                    </label>
                </li>
                <li>
                    <input type="radio" id="medium-row" wire:model="form.size" class="hidden peer" value="medium-row" />
                    <label for="medium-row"
                        class="inline-flex items-center justify-between w-full p-2 text-gray-500 cursor-pointer hover:text-gray-300 peer-checked:text-purple-800">
                    <x-icon name="medium-row" class="h-8" />
                    </label>
                </li>
                <li>
                    <input type="radio" id="medium-col" wire:model="form.size" class="hidden peer" value="medium-col" />
                    <label for="medium-col"
                        class="inline-flex items-center justify-between w-full p-2 text-gray-500 cursor-pointer hover:text-gray-300 peer-checked:text-purple-800">
                    <x-icon name="medium-col" class="h-8" />
                    </label>
                </li>
                <li>
                    <input type="radio" id="big" wire:model="form.size" class="hidden peer" value="big" />
                    <label for="big"
                        class="inline-flex items-center justify-between w-full p-2 text-gray-500 cursor-pointer hover:text-gray-300 peer-checked:text-purple-800">
                    <x-icon name="big" class="h-8" />
                    </label>
                </li>
            </ul>
        </div>
        <x-primary-button>{{ __('Add widget') }}</x-primary-button>
    </form>
</div>