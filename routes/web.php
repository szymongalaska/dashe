<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Livewire\Settings;
use App\Livewire\Configuration;
use Illuminate\Support\Facades\Route;
use App\Livewire\App;

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', function(){
        return to_route('dashboard');
    });
    
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/weather', \App\Http\Controllers\WeatherController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::get('/install', Settings::class)->name('install');
    Route::get('/configure', Configuration::class)->name('configure');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
