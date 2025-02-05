<?php

namespace App\Livewire\Weather;

use Livewire\Component;
use Bejblade\OpenWeather\OpenWeather;
use Illuminate\Support\Facades\Cache;

class Weather extends Component
{
    public $locationIndex = 0;

    public $locations;

    public $coordinates;

    public $geolocation;

    public function mount(array $locations)
    {
        $this->locations = $locations;
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
        $api = new OpenWeather(['timezone' => 'Europe/Warsaw', 'units' => $config['units']]);
        $cacheKey = 'weather_' . $config['units'] . '_' . $config['locations'][$this->locationIndex]['coordinates'];

        if (Cache::has($cacheKey)) {
            $location = Cache::get($cacheKey);

            if ($location->weather()->isUpdateAvailable()) {
                $api->getAllData($location);
                $nextUpdate = new \DateTime('@' . $location->weather()->getTimestamp()->getTimestamp() + 600);
                Cache::put($cacheKey, $location, $nextUpdate);
            }
        } else {
            $location = explode(', ', $config['locations'][$this->locationIndex]['coordinates']);
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

        $api = new OpenWeather();
        $coords = explode(', ', $coordinates);
        $location = $api->findLocationByCoords($coords[0], $coords[1]);
        $config['locations'][0] = ['name' => $location->getName(), 'country' => $location->getCountry(), 'coordinates' => $coordinates];

        request()->user()->module('weather')->update(['config' => $config]);
        $this->dispatch('refresh');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="max-w-7xl animate-pulse mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gray-100 to-transparent opacity-50 animate-shimmer"></div>
        </div>
        HTML;
    }
}
