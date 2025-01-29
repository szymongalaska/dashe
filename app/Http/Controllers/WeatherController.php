<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use Bejblade\OpenWeather\OpenWeather;

class WeatherController extends Controller
{
    /**
     * OpenWeather API instance
     * @var OpenWeather
     */
    private OpenWeather $api;

    public function __construct()
    {
        $this->api = new OpenWeather(['language' => 'pl', 'timezone' => 'Europe/Warsaw']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = $this->api->findLocationByName('Warsaw');
        $weather = $this->api->getWeather($location);
        return view('weather.index', ['weather' => $weather]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Weather $weather)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weather $weather)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Weather $weather)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weather $weather)
    {
        //
    }
}
