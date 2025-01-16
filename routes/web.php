<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RouteMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

Route::middleware(['auth', 'verified', RouteMiddleware::class])->group(function(){
    Route::get('/', function(){
        return to_route('dashboard');
    });
    Route::get('/dashboard', [ViewController::class, 'dashboard'])->name('dashboard');
    Route::resource('/weather', \App\Http\Controllers\WeatherController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
