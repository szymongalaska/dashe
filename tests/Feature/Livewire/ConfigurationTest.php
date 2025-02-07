<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Configuration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Configuration::class)
            ->assertStatus(200);
    }
}
