<?php

namespace App\Http\Controllers;
use App\Models\Cars;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularCars = Cars::inRandomOrder()->limit(4)->get();
        $randomCars = Cars::inRandomOrder()->limit(4)->get();
        return view('welcome', compact('popularCars', 'randomCars'));
    }
}
