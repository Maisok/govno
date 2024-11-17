<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class catalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Cars::query();

        // Поиск по марке и модели
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('mark', 'like', '%' . $search . '%')
                  ->orWhere('model', 'like', '%' . $search . '%');
            });
        }

        // Фильтрация по году
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->input('year_from'));
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->input('year_to'));
        }

        // Фильтрация по пробегу
        if ($request->filled('mileage_from')) {
            $query->where('mileage', '>=', $request->input('mileage_from'));
        }
        if ($request->filled('mileage_to')) {
            $query->where('mileage', '<=', $request->input('mileage_to'));
        }

        // Исключаем автомобили, которые проданы или недоступны
        $query->where('sold', false)
              ->where('availability', 1);

        $cars = $query->get();

        return view('catalog', compact('cars'));
    }
}