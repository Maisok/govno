<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CarsExport;

class CarsExportController extends Controller
{
    public function export()
    {
        return Excel::download(new CarsExport, 'cars.xlsx');
    }
}