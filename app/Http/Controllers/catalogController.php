<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class catalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Cars::query();

        // Проверка, есть ли хотя бы один параметр для фильтрации
        $hasFilters = $request->hasAny(['search', 'year_from', 'year_to', 'mileage_from', 'mileage_to']);

        if ($hasFilters) {
            // Применение фильтров только по тем параметрам, которые заполнены
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('mark', 'like', '%' . $request->search . '%')
                      ->orWhere('model', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->filled('year_from')) {
                $query->where('year', '>=', $request->year_from);
            }

            if ($request->filled('year_to')) {
                $query->where('year', '<=', $request->year_to);
            }

            if ($request->filled('mileage_from')) {
                $query->where('mileage', '>=', $request->mileage_from);
            }

            if ($request->filled('mileage_to')) {
                $query->where('mileage', '<=', $request->mileage_to);
            }
        }

        // Фильтрация по наличию картинок
        $cars = $query->whereHas('images')->get();

        return view('catalog', compact('cars'));
    }
}