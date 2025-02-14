<div class="small bg-white dark:bg-gray-800 shadow-sm rounded-lg sm:px-6 lg:px-8 flex flex-col items-center justify-center py-2 relative">
<p class="absolute top-1 left-1 mt-1 ml-2 text-xs text-gray-300 dark:text-gray-600">{{ $location->getName() }}</p>
    <div class="flex items-center">
        <div class="w-36">
            <img class="mr-2" alt="{{$location->weather()->getDescription()}}"
                src="https://openweathermap.org/img/wn/{{$location->weather()->getIcon()}}@4x.png" />
        </div>
        <div class="flex flex-col text-gray-800 dark:text-gray-200">
            <span
                class="text-5xl flex items-top font-semibold">{{ round($location->weather()->temperature()->get()) ?: 0 }}<span
                    class="text-base">°{{ $location->weather()->temperature()->getUnits() }}</span></span>
            <p class="text-base text-gray-600 dark:text-gray-200">
                {{ ucfirst($location->weather()->getDescription()) }}
            </p>
        </div>
    </div>
</div>