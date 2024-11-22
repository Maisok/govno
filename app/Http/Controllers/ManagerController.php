<?php
namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\SuccessSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index(Request $request)
    
    {

        if (!Auth::user()->isManager()) {
            return redirect('/');
        }
        $query = Cars::query();

        // Поиск по марке и модели
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('mark', 'like', '%' . $search . '%')
                  ->orWhere('model', 'like', '%' . $search . '%');
            });
        }

        $cars = $query->get();

        return view('manager.index', compact('cars'));
    }

    public function updateAvailability(Request $request, $id)
    {

        if (!Auth::user()->isManager()) {
            return redirect('/');
        }
        $car = Cars::findOrFail($id);
        $car->availability = $request->input('availability') == 'available' ? 1 : 0;

        // Если выбран статус "Доступен", сбрасываем статус sold на false
        if ($car->availability == 1) {
            $car->sold = false;
        }

        $car->save();

        return redirect()->route('manager.index')->with('success', 'Статус автомобиля обновлен.');
    }

    public function markAsSold(Request $request, $id)
    {

        if (!Auth::user()->isManager()) {
            return redirect('/');
        }
        $car = Cars::findOrFail($id);
        $car->sold = true;
        $car->availability = 0; // Устанавливаем статус availability в 0, так как автомобиль продан
        $car->save();

        // Создаем запись в таблице successsales
        SuccessSale::create(['car_id' => $car->id]);

        return redirect()->route('manager.index')->with('success', 'Автомобиль помечен как проданный.');
    }
}