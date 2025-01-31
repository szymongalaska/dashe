<x-install-card :id="'weather'">
    <div class="flex flex-row items-center gap-4">
        <x-dynamic-component :component="$modulesIcons['weather']" class="text-gray-400 h-16" />
        <div>
            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                {{ __("Weather")}}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Check current weather and forecasts') }}
            </p>
        </div>
    </div>
</x-install-card>