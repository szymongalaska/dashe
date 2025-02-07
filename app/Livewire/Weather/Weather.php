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

    public $config;


    protected $listeners = [
        'weather-update' => 'locationsUpdate'
    ];

    public function mount()
    {
        $this->config = request()->user()->module('weather')->config;
        $this->locations = $this->config['locations'];
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
        $api = new OpenWeather(['timezone' => 'Europe/Warsaw', 'units' => $this->config['units']]);
        $cacheKey = 'weather_' . $this->config['units'] . '_' . $this->config['locations'][$this->locationIndex]['coordinates'];

        if (Cache::has($cacheKey)) {
            $location = Cache::get($cacheKey);

            if ($location->weather()->isUpdateAvailable()) {
                $api->getAllData($location);
                $nextUpdate = new \DateTime('@' . $location->weather()->getTimestamp()->getTimestamp() + 600);
                Cache::put($cacheKey, $location, $nextUpdate);
            }
        } else {
            $location = explode(', ', $this->locations[$this->locationIndex]['coordinates']);
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

        $api = new OpenWeather();
        $coords = explode(', ', $coordinates);
        $location = $api->findLocationByCoords($coords[0], $coords[1]);
        $this->config['locations'][0] = ['name' => $location->getName(), 'country' => $location->getCountry(), 'coordinates' => $coordinates];

        request()->user()->module('weather')->update(['config' => $this->config]);
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="max-w-7xl animate-pulse mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gray-100 dark:via-gray-900 to-transparent opacity-50 animate-shimmer"></div>
        </div>
        HTML;
    }

    public function locationsUpdate()
    {
        $this->config = request()->user()->module('weather')->config;
        $this->locations = $this->config['locations'];
        if (!in_array($this->locationIndex, array_keys($this->locations))) {
            end($this->locations);
            $this->locationIndex = key($this->locations);
        }
    }
}
