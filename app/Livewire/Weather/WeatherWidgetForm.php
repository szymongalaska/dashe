<?php

namespace App\Livewire\Weather;

use App\Livewire\WidgetForm;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class WeatherWidgetForm extends WidgetForm
{
    #[Validate]
    public ?int $location;

    #[Validate]
    public ?string $size;

    protected function rules()
    {
        $locationsIds = array_values(array_keys(request()->user()->module('weather')->config['locations']));

        return [
            'location' => [
                'required', 
                Rule::in($locationsIds)
            ],
            'size' => 'required|in:small,medium-row,medium-col,big'
        ];
    }

    public function all()
    {
        return [
            'size' => $this->size,
            'configuration' => ['location' => $this->location]
        ];
    }
}