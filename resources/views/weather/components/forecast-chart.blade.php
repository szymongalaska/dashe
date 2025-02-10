@php
    // Need this to update canvas
    $uniqid = uniqid();
@endphp
<div class="relative w-full h-24"
    x-data="{data: @json(array_map(fn($weather) => round($weather->temperature()->get()) ?: 0, $forecast))}">
    <canvas id="forecast-{{$key}}-{{$uniqid}}" class="absolute"
        x-init="setTimeout(() => loadForecastChart('forecast-{{$key}}-{{$uniqid}}', data, data), 1000)"></canvas>
</div>