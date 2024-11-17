<?php
namespace App\Imports;

use App\Models\Cars;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Cars([
            'mark' => $row['mark'],
            'model' => $row['model'],
            'year' => $row['year'],
            'vin' => $row['vin'],
            'color' => $row['color'],
            'mileage' => $row['mileage'],
            'price' => $row['price'],
            'availability' => $row['availability'] ?? null,
            'body_type' => $row['body_type'] ?? null,
            'equipment' => $row['equipment'] ?? null,
            'engine' => $row['engine'] ?? null,
            'tax' => $row['tax'] ?? null,
            'transmission' => $row['transmission'] ?? null,
            'drive_type' => $row['drive_type'] ?? null,
            'delivery_location' => $row['delivery_location'] ?? null,
        ]);
    }
}