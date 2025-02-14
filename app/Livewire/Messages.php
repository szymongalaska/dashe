<?php

namespace App\Livewire;

use Livewire\Component;

class Messages extends Component
{
    protected $listeners = [
        'message' => 'showMessage',
    ];

    public $message;

    public function mount()
    {
        if (session()->has('message')) {
            $this->dispatch('message', session()->get('message'))->self();
        }
    }

    public function render()
    {
        return view('livewire.message');
    }

    public function showMessage(string $message)
    {
        $this->message = $message;
        $this->dispatch('show-message');
    }
}