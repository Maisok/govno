<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Purchase;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        // Проверка аутентификации пользователя
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Валидация данных
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'phone_number' => 'required|string', // Добавляем валидацию для номера телефона
        ]);

        // Создание записи о бронировании
        Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'phone_number' => $request->phone_number, // Добавляем номер телефона
        ]);

        return redirect()->back()->with('success', 'Модель успешно забронирована!');
    }

    public function purchase(Request $request)
    {
        // Проверка аутентификации пользователя
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Валидация данных
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'phone_number' => 'required|string', // Добавляем валидацию для номера телефона
        ]);

        // Создание записи о покупке
        Purchase::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'phone_number' => $request->phone_number, // Добавляем номер телефона
        ]);

        return redirect()->back()->with('success', 'Модель успешно забронирована на покупку!');
    }

    public function cancel(Booking $booking)
    {
        // Проверка, что пользователь имеет право отменять это бронирование
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'У вас нет прав на отмену этого бронирования.');
        }

        // Удаление бронирования
        $booking->delete();

        return redirect()->back()->with('success', 'Бронирование успешно отменено.');
    }

    public function cancelPurchase(Purchase $purchase)
    {
        // Проверка, что пользователь имеет право отменять это бронирование на покупку
        if ($purchase->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'У вас нет прав на отмену этого бронирования на покупку.');
        }

        // Удаление бронирования на покупку
        $purchase->delete();

        return redirect()->back()->with('success', 'Бронирование на покупку успешно отменено.');
    }
}