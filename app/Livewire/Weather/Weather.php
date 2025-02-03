<?php

namespace App\Livewire\Weather;

use Livewire\Component;
use Bejblade\OpenWeather\OpenWeather;
use Illuminate\Support\Facades\Cache;

class Weather extends Component
{
    public $locationIndex = 0;

    public $coordinates;

    public $geolocation;

    public function mount()
    {
        $config = request()->user()->module('weather')->config;
        $this->geolocation = $config['geolocation'];
    }

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
        $cacheKey = request()->user()->id . 'weatherLocation-' . $this->locationIndex;

        if (Cache::has($cacheKey)) {
            $location = Cache::get($cacheKey);

            if ($location->weather()->isUpdateAvailable()) {
                $api->getAllData($location);
                $nextUpdate = new \DateTime('@' . $location->weather()->getTimestamp()->getTimestamp() + 600);
                Cache::put($cacheKey, $location, $nextUpdate);
            }
        } else {
            $location = explode(', ', $config['locations'][$this->locationIndex]);
            $location = $api->findLocationByCoords($location[0], $location[1]);
            $api->getAllData($location);
            $nextUpdate = new \DateTime('@' . $location->weather()->getTimestamp()->getTimestamp() + 600);
            Cache::put($cacheKey, $location, $nextUpdate);
        }

        $this->coordinates = $location->getCoordinates();
        return $location;
    }

    /**
     * Update geolocation coordinates
     * @param string $coordinates Coordinates of new location
     * @return null|void
     */
    public function updateLocation(string $coordinates)
    {
        if ($this->geolocation == false) {
            return null;
        }

        $config = request()->user()->module('weather')->config;
        $config['locations'][0] = $coordinates;

        request()->user()->module('weather')->update(['config' => $config]);
        $this->dispatch('refresh');
    }

}
