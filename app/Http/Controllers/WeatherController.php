<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bejblade\OpenWeather\OpenWeather;
use Bejblade\OpenWeather\Entity\Location;

class WeatherController extends Controller
{
    /**
     * OpenWeather API instance
     * @var OpenWeather
     */
    private OpenWeather $api;

    /**
     * Location object
     * @var Location
     */
    private Location $location;

    public function __construct()
    {
        $config = request()->user()->module('weather')->config;
        $this->api = new OpenWeather(['language' => 'pl', 'timezone' => 'Europe/Warsaw', 'units' => $config['units']]);
        $location = explode(', ', $config['coordinates']);
        $this->location = $this->api->findLocationByCoords($location[0], $location[1]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weather = $this->api->getWeather($this->location);
        return view('weather.index', ['weather' => $weather]);
    }
}
