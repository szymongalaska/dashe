<?php

namespace App\Livewire\Weather;

use Illuminate\Validation\Rule;
use Livewire\Component;

class Locations extends Component
{
    public $city = [];

    public function render()
    {
        return view('livewire.weather.locations', ['locations' => request()->user()->module('weather')->config['locations']]);
    }

    public function addLocation()
    {
        $config = request()->user()->module('weather')->config;
        $locations = $config['locations'];

        $this->validate([
            'city.coordinates' => Rule::notIn(array_column($locations, 'coordinates')),
        ]);

        $config['locations'][] = $this->city;

        request()->user()->module('weather')->update(['config' => $config]);
        $this->dispatch('refresh')->to(Weather::class);
    }

    public function removeLocation(int $location)
    {
        $config = request()->user()->module('weather')->config;

        if (isset($config['locations'][$location])) {
            unset($config['locations'][$location]);
        }

        request()->user()->module('weather')->update(['config' => $config]);
        $this->dispatch('refresh')->to(Weather::class);
    }
}
