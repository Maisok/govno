<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $search = $request->input('search');

        if ($search) {
            $users = User::where('email', 'like', '%' . $search . '%')->get();
        } else {
            $users = User::all();
        }

        return view('admin.admin', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'employee' => 'manager',
        ]);

        return redirect()->route('admin')->with('success', 'Manager added successfully.');
    }

    public function edit(User $user)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin')->with('success', 'Manager updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $user->delete();
        return redirect()->route('admin')->with('success', 'Manager deleted successfully.');
    }
}