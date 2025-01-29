<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Configuration extends Component
{

    #[Layout('layouts.configuration')]
    public function render()
    {   
        $modules = session()->get('modules');
        $modules = ['weather'];
        return view('livewire.settings.configuration')->with('modules', $modules);
    }
}