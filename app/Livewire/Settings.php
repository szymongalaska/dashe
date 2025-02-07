<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Module;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Session;
use Livewire\Attributes\Layout;

class Settings extends Component
{
    #[Session(key: 'modules')]
    public $modulesToInstall = [];

    #[Layout('layouts.configuration')]
    public function render()
    {
        $modules = request()->user()->notInstalledModules()->get();

        if ($modules->isEmpty()) {
            session()->flash('message', 'No modules to install');
            $this->redirectRoute('dashboard');
        }

        $this->modulesToInstall = [];

        return view('livewire.settings.install', ['modules' => $modules]);
    }

    public function configure()
    {
        $user = User::find(request()->user()->id);
        $modules = $user->notInstalledModules()->get();

        $this->validate(
            [
            'modulesToInstall' => [
                'required',
                'array',
                'min:1',
            ],
            'modulesToInstall.*' => Rule::in($modules->pluck('id')->toArray()),
        ],
            [
            'modulesToInstall.required' => 'Please select at least one module to install.',
            'modulesToInstall.*.in' => 'Invalid modules selected.',
        ]
        );

        $modules = [];
        foreach ($this->modulesToInstall as $moduleId) {
            $modules[$moduleId] = Module::find($moduleId)->value('name');
        }

        $this->modulesToInstall = $modules;

        return to_route('configure');
    }
}
