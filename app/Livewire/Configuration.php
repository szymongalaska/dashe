<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Configuration extends Component
{
    #[Layout('layouts.configuration')]
    public function render()
    {
        $modules = session()->get('modules', []);

        if (count($modules) > 0) {
            foreach ($modules as $key => $moduleId) {
                $result = request()->user()->disabledModules()->where('module_id', $moduleId)->update(['enabled' => true]);
                if ($result) {
                    unset($modules[$key]);
                }
            }
        }

        if (count($modules) == 0) {
            $this->redirectRoute('dashboard');
        }

        return view('livewire.settings.configuration')->with('modules', $modules);
    }
}
