<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class catalogController extends Controller
{
    public function index(Request $request)
    {

        $query = Cars::where('availability', 1)->get();



      
        $hasFilters = $request->hasAny(['search', 'year_from', 'year_to', 'mileage_from', 'mileage_to']);

        if ($hasFilters) {

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

        //$cars = $query->whereHas('images')->get();

        $cars=$query;

        return view('catalog', compact('cars'));
    }
}