<?php
 
namespace App\Livewire;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
 
class WidgetForm extends Form
{
    #[Validate('required')]
    public ?string $size;
}