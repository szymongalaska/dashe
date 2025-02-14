<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Weather\WeatherWidgetForm;

class WidgetConfiguration extends Component
{
    protected $listeners = [
        'weather-update' => 'refresh'
    ];

    public $config;

    public WidgetForm $form;
    public $module;

    public function mount(string $module)
    {
        $this->module = $module;
    }

    public function boot()
    {
        $this->form = new WeatherWidgetForm($this, 'form');
        $this->config = request()->user()->module($this->module)->config;
    }

    public function render()
    {
        return view("livewire.{$this->module}.widget-configuration");
    }

    public function save()
    {
        $this->form->validate();
        $data = $this->form->all();

        request()->user()->module($this->module)->widgets()->create([
            'user_module_id' => request()->user()->module($this->module)->value('id'),
            'size' => $data['size'],
            'configuration' => $data['configuration'],
            'position' => '',
        ]);

        $this->dispatch('message', 'Widget saved')->to(Messages::class);
    }
}
