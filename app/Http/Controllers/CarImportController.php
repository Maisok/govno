<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CarsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class CarImportController extends Controller
{

    public function index(Request $request){
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }

        return view('cars.import');
    }
    public function import(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/');
        }
        
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new CarsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Данные успешно импортированы.');
    }
}