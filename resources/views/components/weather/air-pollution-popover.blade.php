<div
    class="absolute hidden invisible left-1/2 transform -translate-x-1/2 top-8 group-hover:opacity-100 group-hover:visible group-hover:block z-10 inline-block w-80 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
    <div class="px-3 pt-4 pb-2 flex gap-2 justify-between">
        @foreach ($airPollution->all() as $name => $pollution)
            <x-weather.pollution :value="$pollution['value']" :name="$name"
                class="{{ isset($pollution['index']) ? airPollutionText($pollution['index']) : '' }}" />
        @endforeach
    </div>
    <div class="px-3 py-1 border-t border-gray-200 rounded-b-lg dark:border-gray-800">
        <p class="font-semibold text-[0.5rem] text-gray-300 dark:text-white">Updated: {{$airPollution->getDate()}}
        </p>
    </div>
</div>