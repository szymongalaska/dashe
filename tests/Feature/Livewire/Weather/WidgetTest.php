<?php

namespace Tests\Feature\Livewire\Weather;

use App\Livewire\Weather\Widget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class WidgetTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Widget::class)
            ->assertStatus(200);
    }
}
