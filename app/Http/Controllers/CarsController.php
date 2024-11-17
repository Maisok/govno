<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        $query = Cars::with('images');

        // Поиск по названию авто
        if ($request->has('search')) {
            $query->where('model', 'like', '%' . $request->search . '%');
        }

        // Сортировка
        if ($request->has('sort')) {
            $sortField = $request->sort;
            $sortDirection = $request->has('direction') && $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sortField, $sortDirection);
        }

        $cars = $query->get();

        return view('cars.createcar', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mark' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:cars',
            'color' => 'required|string',
            'mileage' => 'required|integer',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'body_type' => 'required|string',
            'equipment' => 'required|string',
            'engine' => 'required|string',
            'tax' => 'required|numeric',
            'transmission' => 'required|string',
            'drive_type' => 'required|string',
            'delivery_location' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $car = Cars::create($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('car_images', 'public');
                $car->images()->create(['image_path' => $imagePath]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car model added successfully.');
    }

    public function edit($id)
    {
        $car = Cars::with('images')->findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mark' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:cars,vin,' . $id,
            'color' => 'required|string',
            'mileage' => 'required|integer',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'body_type' => 'required|string',
            'equipment' => 'required|string',
            'engine' => 'required|string',
            'tax' => 'required|numeric',
            'transmission' => 'required|string',
            'drive_type' => 'required|string',
            'delivery_location' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $car = Cars::findOrFail($id);
        $car->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('car_images', 'public');
                $car->images()->create(['image_path' => $imagePath]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car model updated successfully.');
    }

    public function destroy($id)
    {
        $car = Cars::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car model deleted successfully.');
    }

    public function deleteImage($carId, $imageId)
    {
        $image = CarImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('cars.edit', $carId)->with('success', 'Image deleted successfully.');
    }
}