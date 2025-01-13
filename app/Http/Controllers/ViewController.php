<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ViewEvent;

class ViewController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
