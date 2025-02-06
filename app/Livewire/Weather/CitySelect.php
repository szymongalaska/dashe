<?php

namespace App\Livewire\Weather;

use Livewire\Component;
use Bejblade\OpenWeather\OpenWeather;

class CitySelect extends Component
{
    public $city = '';
    public $result = [];

    public function render()
    {
        $this->getLocations();
        return view('livewire.weather.city-select');
    }

    private function getLocations()
    {
        if (strlen($this->city) > 2) {
            $api = new OpenWeather();
            $result = $api->findLocationByName($this->city, 10);
            $this->result = array_map(function ($city) {
                return ['name' => $city->getName(), 'state' => $city->getState(), 'country' => $city->getCountry(), 'coordinates' => $city->getCoordinates()];
            }, $result);
        }
    }
}
