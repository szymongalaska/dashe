<?php

namespace App\Livewire\Weather;

use Livewire\Component;

class Configuration extends Component
{
    public $config;
    public $units;

    public function mount()
    {
        $this->config = request()->user()->module('weather')->config;
        $this->units = $this->config['units'];
    }

    public function render()
    {
        return view('livewire.weather.configuration');
    }

    public function update()
    {
        $this->validate([
            'units' => 'required|in:metric,imperial',
        ], [
            'units' => 'Invalid units selected'
        ]);

        $this->config['units'] = $this->units;
        request()->user()->module('weather')->update(['config' => $this->config]);
        $this->dispatch('weather-update')->to(Weather::class);
    }
}
