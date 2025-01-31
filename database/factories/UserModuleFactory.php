<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Module;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModule>
 */
class UserModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'module_id' => Module::factory(),
            'config' => json_encode(['key' => 'value']),
            'enabled' => true,
            'position' => fake()->randomNumber()
        ];
    }

    public function disabled(): static
    {
        return $this->state(fn (array $attributes) => [
            'enabled' => false,
        ]);
    }
}
