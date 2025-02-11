<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Module;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('airPollutionTextColor', function ($value) {
            return "<?php
                echo match($value) {
                    'Good' => 'text-green-600',
                    'Fair' => 'text-lime-500',
                    'Moderate' => 'text-yellow-400',
                    'Poor' => 'text-orange-500',
                    'Very Poor' => 'text-red-600',
                    default => 'text-gray-500'
                };
            ?>";
        });
        
        View::share('modulesIcons', Module::icons());
    }
}
