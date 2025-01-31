<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserModule;
use App\Models\Module;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_not_installed_modules_returns_correct_data(): void
    {
        User::factory()->has(UserModule::factory()->has(Module::factory()), 'modules')->create();
        User::factory()->create();

        $this->assertEmpty(User::find(1)->notInstalledModules()->get());
        $this->assertNotEmpty(User::find(2)->notInstalledModules()->get());
    }

    public function test_installed_modules_returns_correct_data(): void
    {
        User::factory()->has(UserModule::factory()->has(Module::factory()), 'modules')->create();
        User::factory()->create();

        $this->assertEmpty(User::find(2)->installedModules()->get());
        $this->assertNotEmpty(User::find(1)->installedModules()->get());
    }

    public function test_is_module_installed_returns_correct_value(): void
    {
        User::factory()->has(UserModule::factory()->has(Module::factory()), 'modules')->create();
        User::factory()->create();

        $this->assertTrue(User::find(1)->isModuleInstalled(Module::find(1)->name));
        $this->assertFalse(User::find(2)->isModuleInstalled(Module::find(1)->name));
    }
}
