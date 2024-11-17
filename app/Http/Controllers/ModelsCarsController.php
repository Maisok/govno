<?php
namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class ModelsCarsController extends Controller
{
    public function create()
    {
        $cars = Cars::all();
        return view('cars.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mark' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'vin' => 'required|string|max:255|unique:cars',
            'color' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Cars::create($request->all());

        return redirect()->route('cars.create')->with('success', 'Car model created successfully.');
    }

    public function destroy(Cars $car)
    {
        $car->delete();

        return redirect()->route('cars.create')->with('success', 'Car model deleted successfully.');
    }
    
}