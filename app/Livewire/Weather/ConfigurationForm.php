<?php

namespace App\Livewire\Weather;

use Livewire\Component;

class ConfigurationForm extends Component
{
    public $coordinates = false;

    public $units = '';

    public function render()
    {
        return view('livewire.weather.configuration-form');
    }

    public function save()
    {
        $this->validate(
            [
                'coordinates' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
                'units' => 'required|in:metric,imperial'
            ],
            [
                'coordinates' => 'Please select a valid location.',
                'units' => 'Please select a unit.'
            ]
        );


    }
}