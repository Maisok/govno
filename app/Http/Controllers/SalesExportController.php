<?php

namespace App\Http\Controllers;

use App\Models\SuccessSale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

class SalesExportController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SalesExport($startDate, $endDate), 'sales.xlsx');
    }
}