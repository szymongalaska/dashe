<x-app-layout>
    <div class="py-16 md:py-12 space-y-6">
        <livewire:weather.weather lazy />
        <div class="justify-center flex flex-col gap-6 lg:flex-row lg:items-start lg:max-w-6xl lg:mx-auto">
            <livewire:weather.locations />
            <livewire:weather.configuration />
        </div>
        <livewire:widget-configuration module="weather" />
    </div>
</x-app-layout>