<div
    class="max-w-xl min-h-96 mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <h4 class="mb-4">{{__('Manage locations')}}</h4>
    <form wire:submit="addLocation()" x-data="{city: @entangle('city')}">
        <livewire:weather.city-select />
        <div wire:model="city"></div>
        <button type="submit">sub</button>
    </form>
    <div class="border-2 border-gray-200 py-2 px-4 rounded-lg mt-2">
        <ul>
            @foreach($locations as $key => $location)
                <li class="text-sm py-2">
                    <form wire:submit="removeLocation({{$key}})" class="flex items-center justify-between ">
                        <span>{{$location['name']}}, {{$location['country']}} <span
                                class="text-[0.5rem] text-gray-400">{{$location['coordinates']}}</span></span><button
                            type="submit"><x-hugeicons-location-remove-01
                                class="cursor-pointer hover:text-gray-600" /></button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>