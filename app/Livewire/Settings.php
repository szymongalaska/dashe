<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

class Settings extends Component
{
    public $modulesToInstall = [];

    #[Layout('layouts.configuration')]
    public function render()
    {
        $modules = request()->user()->notInstalledModules()->get();

        if($modules->isEmpty()){
            session()->flash('message', 'No modules to install');
            $this->redirectRoute('dashboard');
        }

        return view('livewire.settings.install', ['modules' => $modules]);
    }

    public function configure()
    {
        $user = User::find(request()->user()->id);
        $modules = $user->notInstalledModules()->get();

        $this->validate([
            'modulesToInstall' => [
                'required',
                'array',
                'min:1',
            ],
            'modulesToInstall.*' => Rule::in($modules->pluck('name')->toArray()),
        ],
        [
            'modulesToInstall.required' => 'Please select at least one module to install.',
            'modulesToInstall.*.in' => 'Invalid modules selected.',
        ]);

        session()->flash('modules', $this->modulesToInstall);
        return to_route('configure');
    }
}