<x-app-layout>
    <div class="py-12 space-y-6">
        <livewire:weather.weather :locations="$weatherConfig['locations']" lazy />
        <livewire:weather.locations />
    </div>
</x-app-layout>