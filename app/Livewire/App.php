<?php

namespace App\Livewire;

use Livewire\Component;
use Route;

class App extends Component
{
    public function render()
    {
        return view('livewire.app')->with('view', Route::currentRouteName());
    }
}
