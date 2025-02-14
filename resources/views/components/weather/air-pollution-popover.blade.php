<div
    class="absolute hidden invisible lg:left-1/2 transform -translate-x-1/2 top-8 bg-gray-200/20 backdrop-blur-md group-hover:opacity-100 group-hover:visible group-hover:block z-50 max-w-64 md:max-w-80 inline-block text-sm text-gray-500 transition-opacity duration-300 border border-gray-200 rounded-lg shadow-md opacity-0 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800/20">
    <div class="px-3 pt-4 pb-2 flex gap-2 justify-between overflow-x-auto">
        @foreach ($airPollution->all() as $name => $pollution)
            <x-weather.pollution :value="$pollution['value']" :name="$name"
                :index="$pollution['index'] ?? ''" />
        @endforeach
    </div>
    <div class="px-3 py-1 border-t border-gray-200 rounded-b-lg dark:border-gray-800">
        <p class="font-semibold text-[0.5rem] text-gray-300 dark:text-white">Updated: {{$airPollution->getDate()}}
        </p>
    </div>
</div>