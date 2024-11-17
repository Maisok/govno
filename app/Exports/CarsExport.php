<?php

namespace App\Exports;

use App\Models\Cars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cars::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Mark',
            'Model',
            'Year',
            'VIN',
            'Color',
            'Mileage',
            'Price',
            'Availability',
            'Body Type',
            'Equipment',
            'Engine',
            'Tax',
            'Transmission',
            'Drive Type',
            'Delivery Location',
            'Created At',
            'Updated At',
        ];
    }
}