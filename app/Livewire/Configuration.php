<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Session;
use Livewire\Attributes\Layout;

class Configuration extends Component
{
    #[Session(key: 'modules')]
    public $modules = [];

    #[Layout('layouts.configuration')]
    public function render()
    {

        if (count($this->modules) > 0) {
            foreach ($this->modules as $moduleId => $module) {
                $result = request()->user()->disabledModules()->where('module_id', $moduleId)->update(['enabled' => true]);
                if ($result) {
                    unset($this->modules[$moduleId]);
                }
            }
        }

        if (count($this->modules) == 0) {
            $this->redirectRoute('dashboard');
        }

        $this->modules = array_values($this->modules);

        return view('livewire.settings.configuration');
    }
}
