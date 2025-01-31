<?php

namespace App\Livewire\Weather;

use Livewire\Component;
use Bejblade\OpenWeather\OpenWeather;
use Illuminate\Support\Facades\Cache;


class Weather extends Component
{
    public $locationIndex = 0;
    public function render()
    {

        return view('livewire.weather.weather', ['location' => $this->getLocation()]);
    }

    /** 
     * @var \Bejblade\OpenWeather\Entity\Location $location 
     * */
    private function getLocation()
    {
        $config = request()->user()->module('weather')->config;
        $api = new OpenWeather(['language' => 'pl', 'timezone' => 'Europe/Warsaw', 'units' => $config['units']]);
        $cacheKey = request()->user()->id . 'weatherLocation-'.$this->locationIndex;

        if (Cache::has($cacheKey)) {
            var_dump('jest!');
            $location = Cache::get($cacheKey);

            if ($location->weather()->isUpdateAvailable()) {
                var_dump('aktualizuje');
                $api->getWeather($location);
                $nextUpdate = new \DateTime('@'.$location->weather()->getTimestamp()->getTimestamp() + 600);
                Cache::put($cacheKey, $location, $nextUpdate);
            }
        } else {
            var_dump('nie ma!');
            $location = explode(', ', $config['locations'][$this->location]['coordinates']);
            $location = $api->findLocationByCoords($location[0], $location[1]);
            $api->getWeather($location);
            $nextUpdate = new \DateTime('@'.$location->weather()->getTimestamp()->getTimestamp() + 600);
            Cache::put($cacheKey, $location, $nextUpdate);
        }

        return $location;
    }

}
