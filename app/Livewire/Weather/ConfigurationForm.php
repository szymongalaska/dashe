<?php

namespace App\Livewire\Weather;

use Livewire\Component;
use Bejblade\OpenWeather\OpenWeather;

class ConfigurationForm extends Component
{
    public $coordinates = false;

    public $units = '';

    public $geolocation = false;

    public function render()
    {
        return view('livewire.weather.configuration-form');
    }

    public function save()
    {
        $this->validate(
            [
                'coordinates' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
                'units' => 'required|in:metric,imperial',
                'geolocation' => 'boolean',
            ],
            [
                'coordinates' => 'Please select a valid location.',
                'units' => 'Please select a unit.',
                'geolocation' => 'Invalid geolocation value.'
            ]
        );

        request()->user()->modules()->create([
            'module_id' => 1, // Weather module ID
            'user_id' => request()->user()->id,
            'config' => [
                'geolocation' => $this->geolocation,
                'locations' => [0 => $this->getLocationCity()],
                'units' => $this->units,
            ],
            'position' => ''
        ]);
    }

    public function getLocationCity()
    {
        $api = new OpenWeather();
        $coords = explode(', ', $this->coordinates);
        $location = $api->findLocationByCoords($coords[0], $coords[1]);
        return ['name' => $location->getName(), 'country' => $location->getCountry(), 'coordinates' => $this->coordinates];
    }
}
