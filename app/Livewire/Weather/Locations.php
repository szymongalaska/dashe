<?php

namespace App\Livewire\Weather;

use Illuminate\Validation\Rule;
use Livewire\Component;

class Locations extends Component
{
    public $city = [];

    public $config;

    public $location;

    public function mount()
    {
        $this->config = request()->user()->module('weather')->config;
    }

    public function render()
    {
        return view('livewire.weather.locations', ['locations' => $this->config['locations']]);
    }

    public function addLocation()
    {
        $this->validate([
            'city.coordinates' => Rule::notIn(array_column($this->config['locations'], 'coordinates')),
        ]);

        $this->config['locations'][] = $this->city;

        request()->user()->module('weather')->update(['config' => $this->config]);
        $this->dispatch('weather-update');
    }

    public function removeLocation(int $location)
    {
        $this->location = $location;

        $this->validate(
            [
                'location' => [
                    'gt:0',
                    Rule::in(array_keys($this->config['locations']))
                ]
            ],
            [
                'location' => 'This location can not be removed'
            ]
        );

        if (isset($this->config['locations'][$location])) {
            unset($this->config['locations'][$location]);
        }

        request()->user()->module('weather')->update(['config' => $this->config]);
        request()->user()->module('weather')->widgets()->where('configuration->location', $this->location)->delete();

        $this->dispatch('weather-update');
    }
}
