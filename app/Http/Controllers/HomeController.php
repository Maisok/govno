<?php

namespace App\Http\Controllers;
use App\Models\Cars;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularCars = Cars::whereHas('images')->inRandomOrder()->limit(4)->get();

        // Получаем случайные автомобили с картинками
        $randomCars = Cars::whereHas('images')->inRandomOrder()->limit(4)->get();

        $additionalCars = Cars::whereHas('images')->inRandomOrder()->limit(4)->get();

    return view('welcome', compact('popularCars', 'randomCars', 'additionalCars'));
    }
}
