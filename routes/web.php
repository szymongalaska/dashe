<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Livewire\Settings;
use App\Livewire\Configuration;
use Illuminate\Support\Facades\Route;
use App\Livewire\App;
use App\Middleware\FirstConfiguration;

Route::middleware(['auth', 'verified', FirstConfiguration::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['widgets' => request()->user()->widgets()]);
    })->name('dashboard');

    Route::resource('/weather', \App\Http\Controllers\WeatherController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::delete('/settings', [SettingsController::class, 'uninstall'])->name('settings.uninstall');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/install', Settings::class)->name('install');
    Route::get('/configure', Configuration::class)->name('configure');

    Route::get('/welcome', function () {
        if (!request()->user()->hasAnyModules()) {
            return view('welcome');
        }

        return to_route('dashboard');
    })->name('first-configuration');
});

Route::get('/', function () {
    return view('dashe');
})->middleware('guest');

require __DIR__.'/auth.php';
