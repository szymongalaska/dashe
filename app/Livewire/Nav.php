<?php

namespace App\Livewire;

use Livewire\Component;

class Nav extends Component
{
    public function render()
    {
        $modules = request()->user()->installedModules()->get();
        return view('livewire.nav')->with('modules', $modules);
    }
}
