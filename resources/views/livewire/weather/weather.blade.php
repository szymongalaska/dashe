<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="flex items-center">
        <img src="https://openweathermap.org/img/wn/{{$location->weather()->getIcon()}}@2x.png" />
        <div class="flex flex-col text-gray-800">
            <span
                class="text-5xl flex items-top font-semibold">{{ round($location->weather()->temperature()->get()) }}<span
                    class="text-base">°{{ $location->weather()->temperature()->getUnits() }}</span></span>
            <p class="text-base text-gray-600">{{ ucfirst($location->weather()->getDescription()) }}</p>
        </div>

    </div>

</div>