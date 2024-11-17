<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Models;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function show($id)
    {
        $cars = Cars::findOrFail($id);
        return view('card', compact('cars'));
    }
}
