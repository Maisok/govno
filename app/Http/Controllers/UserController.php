<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController
{
    public function show()
    {
        // Получаем аутентифицированного пользователя
        $user = Auth::user();

        if ($user) {
            $user = Auth::user();
            $bookings = Booking::with('cars')->where('user_id', $user->id)->get();
            $purchases = Purchase::with('cars')->where('user_id', $user->id)->get();


            return view('account',  compact('user', 'bookings', 'purchases'));
        } else {
            // Если пользователь не аутентифицирован, перенаправляем на страницу входа
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showEditForm()
    {
        $user = Auth::user();
        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('edit')->with('success', 'Profile updated successfully.');
    }
}