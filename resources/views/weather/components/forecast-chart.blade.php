<div class="relative w-full h-24"
    x-data="{data: @json(array_map(fn($weather) => round($weather->temperature()->get()) ?: 0, $forecast))}">
    <canvas id="forecast-{{$key}}" class="absolute"
        x-init="setTimeout(() => loadForecastChart('forecast-{{$key}}', data, data), 1000)"></canvas>
</div>