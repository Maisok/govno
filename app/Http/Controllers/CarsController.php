<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

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
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $request->validate([
            'mark' => 'required|string|max:30',
            'model' => 'required|string|max:30',
            'year' => 'required|integer|max:9999',
            'vin' => 'required|string|max:30',
            'color' => 'required|string|max:30',
            'mileage' => 'required|integer|max:999999',
            'price' => 'required|numeric|max:999999999.99',
            'availability' => 'required|boolean',
            'body_type' => 'required|string|max:30',
            'equipment' => 'required|integer|max:9999',
            'engine' => 'required|string|max:30',
            'tax' => 'required|numeric|max:999999999.99',
            'transmission' => 'required|string|max:30',
            'drive_type' => 'required|string|max:30',
            'delivery_location' => 'nullable|string|max:30',
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
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $car = Cars::with('images')->findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }
        $request->validate([
            'mark' => 'required|string|max:30',
            'model' => 'required|string|max:30',
            'year' => 'required|integer|max:9999',
            'vin' => 'required|string|max:30',
            'color' => 'required|string|max:30',
            'mileage' => 'required|integer|max:999999',
            'price' => 'required|numeric|max:999999999.99',
            'availability' => 'required|boolean',
            'body_type' => 'required|string|max:30',
            'equipment' => 'required|integer|max:9999',
            'engine' => 'required|string|max:30',
            'tax' => 'required|numeric|max:999999999.99',
            'transmission' => 'required|string|max:30',
            'drive_type' => 'required|string|max:30',
            'delivery_location' => 'nullable|string|max:30',
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
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }
        $car = Cars::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car model deleted successfully.');
    }

    public function deleteImage($carId, $imageId)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }
        $image = CarImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('cars.edit', $carId)->with('success', 'Image deleted successfully.');
    }
}