<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Module;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Module::create([
            'name' => 'weather',
            'icon' => 'mdi-weather-partly-snowy-rainy'
        ]);
    }
}
