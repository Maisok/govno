<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class catalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Cars::query();

        // Применение фильтров
        if ($request->has('search')) {
            $query->where('mark', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
        }

        if ($request->has('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }

        if ($request->has('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        if ($request->has('mileage_from')) {
            $query->where('mileage', '>=', $request->mileage_from);
        }

        if ($request->has('mileage_to')) {
            $query->where('mileage', '<=', $request->mileage_to);
        }

        // Фильтрация по наличию картинок
        $cars = $query->whereHas('images')->get();

        return view('catalog', compact('cars'));
    }
}