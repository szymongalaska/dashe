<?php

namespace App\Livewire\Weather;

use Livewire\Attributes\Lazy;

#[Lazy]
class Widget extends Weather
{
    public $size;

    public $locationIndex;

    public function mount(string $size, array $configuration)
    {
        $this->size = $size;
        $this->locationIndex = $configuration['location'];
    }

    public function boot()
    {
        parent::boot();
    }

    public function render()
    {
        return view('livewire.weather.widgets.'.$this->size, ['location' => $this->getLocation()]);
    }

    public function placeholder()
    {
        return view('livewire.widgets-skeletons.'.$this->size);
    }
}
