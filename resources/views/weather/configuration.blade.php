<div class="flex justify-center items-center mb-4">
    <x-dynamic-component :component="$modulesIcons['weather']" class="text-gray-400 h-16" />
    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
        {{ __("Weather")}}
    </h2>
</div>
<livewire:weather.configuration-form />